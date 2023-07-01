<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Konnco\ImageCast\Casts\Image as Blur;
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
        $img->blur(30);
        $blurredName = 'blurred_' . $posterName;
        $img->save(Faq::POSTER_PATH . '/blurred' . $blurredName);

        $encoded_image = $img->encode('jpg');
        if ($encoded_image === false) {
            \Log::error("Error encoding blurred image");
            return redirect()->route('faqs.index', $faqs)->with('error', 'Error encoding blurred image');
        }

        $blurhash = base64_encode($encoded_image);
        if ($blurhash === false) {
            \Log::error("Error encoding blurhash");
            return redirect()->route('faqs.index', $faqs)->with('error', 'Error encoding blurhash');
        }

        $faqs->blurhash = $blurhash;
    }
    return redirect()->route('faqs.index',$faqs)->with('success','Faqs created successfully.');
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
