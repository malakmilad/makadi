<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Konnco\ImageCast\Casts\Image as Blur;
use kornrunner\Blurhash\Blurhash;
class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs=Faq::orderBy('id','DESC')->paginate(5);
        return view('admins.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    request()->validate([
        'question'=>'required',
        'answer'=>'required'
    ]);
    $faqs=Faq::create([
        'question'=>$request->question,
        'answer'=>$request->answer
    ]);
    if ($request->file('img')) {
        $request->validate([
            'img' => 'image|mimes:png,jpg,jpeg,svg'
        ]);
        $posterName = $request->file('img')->getClientOriginalName();
        $request->img->move(Faq::POSTER_PATH, $posterName);
        $faqs->img = $posterName;
        $faqs->save();

        // Generate blurred version of image
        $img = Image::make(Faq::POSTER_PATH . '/' . $posterName);
        $width = $img->width();
        $height = $img->height();
        $pixels = [];
        for ($y = 0; $y < $height; ++$y) {
       $row = [];
    for ($x = 0; $x < $width; ++$x) {
        $colors = $img->pickColor($x, $y);

        $row[] = [$colors[0], $colors[1], $colors[2]];
    }
    $pixels[] = $row;
}

$components_x = 4;
$components_y = 3;
$blurhash = Blurhash::encode($pixels, $components_x, $components_y);
$imgpixels = Blurhash::decode($blurhash, 300, 300);
$image  = imagecreatetruecolor(300, 300);
for ($y = 0; $y < 300; ++$y) {
    for ($x = 0; $x < 300; ++$x) {
        [$r, $g, $b] = $imgpixels[$y][$x];
        imagesetpixel($image, $x, $y, imagecolorallocate($image, $r, $g, $b));
    }
}
$result_image=imagepng($image, 'blurhash.png');
$result = base64_encode($result_image);
dd($blurhash);

}
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('admins.faqs.show',compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admins.faqs.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Faq $faq)
    {
        request()->validate([
            'question'=>'required',
            'answer'=>'required'
        ]);
        $faq->update($request->all());
        return redirect()->route('faqs.index',$faq)->with('success','Faqs Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')
        ->with('success','Faq deleted successfully');
    }
}
///////////////////////////////////////////my resource///////////////
<?php

namespace App\Http\Resources;

use App\Models\Admin\Faq;
use Illuminate\Http\Resources\Json\JsonResource;
use Intervention\Image\ImageManagerStatic as Image;
use kornrunner\Blurhash\Blurhash;
// use Bepsvpt\Blurhash\BlurHash;

class FaqsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $blurhash = null;
        if ($this->img) {
            $imgPath = Faq::POSTER_PATH . '/' . $this->img;
            $img = Image::make($imgPath);
            $width = $img->width();
            $height = $img->height();
            $pixels = [];
            for ($y = 0; $y < $height; ++$y) {
                $row = [];
                for ($x = 0; $x < $width; ++$x) {
                    $colors = $img->pickColor($x, $y);

                    $row[] = [$colors[0], $colors[1], $colors[2]];
                }
                $pixels[] = $row;
            }

            $components_x = 4;
            $components_y = 3;
            $blurhashdecode = Blurhash::encode($pixels, $components_x, $components_y);
            $imgpixels = Blurhash::decode($blurhashdecode, 300, 300);
            $image  = imagecreatetruecolor(300, 300);
            for ($y = 0; $y < 300; ++$y) {
                for ($x = 0; $x < 300; ++$x) {
                    [$r, $g, $b] = $imgpixels[$y][$x];
                    imagesetpixel($image, $x, $y, imagecolorallocate($image, $r, $g, $b));
                }
            }

            //  $img->blur(30);
            $img = Image::make($image);

            // $img->save();
            $encodedImg = $img->encode('jpg');
            if ($encodedImg) {
                $blurhash = base64_encode($encodedImg);
            } else {
                Log::error("Error encoding image for blurhash: " . $imgPath);
            }
        }
        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'img' => asset('upload/' . $this->img),
            'blurred_img' => asset('upload/blurredblurred_' . $this->img),
            'blurhash' => $blurhash,
        ];
    }
}
