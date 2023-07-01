<?php

namespace App\Http\Resources;

use App\Models\Admin\Faq;
use Illuminate\Http\Resources\Json\JsonResource;
use Intervention\Image\ImageManagerStatic as Image;
// use kornrunner\Blurhash\Blurhash;
use Bepsvpt\Blurhash\BlurHash;

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
            //  $img->blur(30);
             $img->save();
             $encodedImg = $img->encode('jpg');
             if ($encodedImg) {
                 $blurhash = base64_encode($encodedImg);
             } else {
                 Log::error("Error encoding image for blurhash: " . $imgPath);
             }
         }
         return [
             'id'=>$this->id,
             'question'=>$this->question,
             'answer'=>$this->answer,
             'img'=>asset('upload/'.$this->img),
             'blurred_img'=>asset('upload/blurredblurred_'.$this->img),
             'blurhash' =>$blurhash,
         ];
     }

}

