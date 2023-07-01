<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Payment;
use App\Models\User;
use App\Notifications\CreatePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:payment-list|payment-create|payment-edit|payment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payment-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('user')->latest()->paginate(5);
        return view('admins.payments.index',compact('payments'));
            // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view('admins.payments.create',compact('users'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number'=>'required',
            'email'=>'required',
            'personal_id'=>'required',
            'unit_unique_reference'=>'required',
            'total_unit_price'=>'required',
            'down_payment'=>'required',
            'valid_hours'=>'required',
            'address'=>'required',
            'address2'=>'required',
            'city'=>'required',
            'country'=>'required',
            'user_id'=>'required',
        ]);

        $payment = Payment::create($request->all());
        /////////////////////////---notification---////////////////////////
        $users=User::where('id','!=',auth()->user()->id)->get();
        $username=auth()->user()->name;
        Notification::send($users,new CreatePayment($payment->id,$username,$payment->first_name));

        return redirect()->route('payments.edit',$payment->id)
                        ->with('success','Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $users=User::all();
        return view('admins.payments.show',compact('payment','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        if ($payment->status == "1"){
            abort(404);
        }
        $users=User::all();
        return view('admins.payments.edit',compact('payment','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Payment $payment)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number'=>'required',
            'email'=>'required',
            'personal_id'=>'required',
            'unit_unique_reference'=>'required',
            'total_unit_price'=>'required',
            'down_payment'=>'required',
            'valid_hours'=>'required',
            'address'=>'required',
            'address2'=>'required',
            'city'=>'required',
            'country'=>'required',
            'user_id'=>'required',
        ]);

        $payment->update($request->all());
        return redirect()->route('payments.index')
                        ->with('success','Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
                        ->with('success','Payment deleted successfully');
    }
    public function search(){
        $search=$_GET['search'];
        if($search !=""){
        $payments=Payment::where('first_name','LIKE','%'.$search.'%')->paginate(5)->setPath('');
        $pagination=$payments->appends(array('search'=>$_GET['search']));
        if(count($payments)>0)
        return view('admins.payments.index',compact('payments'))->withDetails($payments)->withQuery($search);
        }
        return view('admins.payments.index',compact('payments'))->with('success','no details found');
        // $payments=Payment::where('first_name','LIKE','%'.$search.'%')->paginate(5);
        // return view('admins.payments.index',compact('payments'));
    }
    public function shownotification(Payment $payment){
        $users=User::all();
        ////////////notification///////////
        $getid=DB::table('notifications')->where('data->payment_id',$payment->id)->pluck('id');
        DB::table('notifications')->where('id',$getid)->update(['read_at'=>now()]);
        return view('admins.payments.show',compact('payment','users'));
    }
    // public function back(){
    //     return redirect()->back();
    // }
}
