<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqsResource;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class faqscontroller extends Controller
{
    public function index(){
        $faqs=FaqsResource::collection(Faq::all());
        // return response($posts,200,['ok']);
        $array=[
            'data'=>$faqs,
            'msg'=>'ok',
            'status'=>200
        ];
        return response($array);
    }
}
