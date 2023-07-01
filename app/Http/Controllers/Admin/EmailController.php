<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\PaymentMail;
use App\Models\Admin\Payment;

class EmailController extends Controller
{
    public function sendemailHelper($email,$payment,$url){
        // dd($email);
        $send_email=Mail::to($email)->send(new PaymentMail($payment, $url));
        if($send_email){
            return view('admins.emails.index')
                        ->with('success','Payment sended successfully');
        }
    }

    public function sendEmail($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $url = URL::signedRoute('changestatus',['payment'=>$payment]);
        $this->sendemailHelper($payment->email,$payment, $url);
        return redirect()->back()->with('success','send payment link sucessfully');
    }
    public function ChangeStatus(Request $request){
        $payment = Payment::findOrFail($request->payment);
        return view('admins.emails.pay', compact('payment'));
    }
    public function status(Request $request,Payment $payment){
        // $payment=Payment::findOrFail($request->payment);
        $payment->update($request->all());
        return redirect()->back()->with('success','payment status change');
    }
}
