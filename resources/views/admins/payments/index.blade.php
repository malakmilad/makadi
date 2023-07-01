@extends('layouts.navbar')
@section('content')
@if ($message = Session::get('success'))
<p class="text-primary">{{ $message }}</p>
@endif
<form action="{{ route('search') }}" method="GET" class="d-flex">
    <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{request('search')}}">
    <button class="btn btn-success" type="submit"><img src="{{ asset('icons/magnifying-glass.png') }}" alt="search" width="20px"></button>&nbsp;&nbsp;
    <a href="{{ route('payments.index') }}" class="btn btn-success"><img src="{{ asset('icons/back (1).png') }}" alt="search" width="20px"></a>
</form>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>payments</h2>
            </div>
            <div class="pull-right">
                @can('payment-create')
                <a class="btn btn-primary" href="{{ route('payments.create') }}"> Create New payments <img src="{{ asset('icons/plus (1).png') }}" width="20px" alt=""></a>
                @endcan
            <a href="{{ route('export') }}" class="btn btn-primary"><img src="{{ asset('icons/excel-file.png') }}" alt=""> export</a>
            </div>
        </div>
    </div>
    <br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Total Unit Price</th>
                <th>Down Payment</th>
                <th>Status</th>
                <th>Createdby</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
              <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->first_name }}</td>
                <td>{{ $payment->last_name }}</td>
                <td>{{ $payment->total_unit_price }}</td>
                <td>{{ $payment->down_payment }}</td>
                @if($payment->status ==0)
                    <td>pending</td>
                @else
                <td>paid</td>
                @endif
                <td>{{ $payment->user->name }}</td>
                <td>
                    <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                        <a class="" href="{{ route('payments.show',$payment->id) }}"><img src="{{ asset('icons/5618479.png') }}" width="25px" alt=""></a>
                        @if($payment->status == 0)
                        @can('payment-edit')
                        <a class="" href="{{ route('payments.edit',$payment->id) }}"><img src="{{ asset('icons/747825.png') }}" width="25px" alt=""></a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('payment-delete')
                        <button type="submit" class="" style="border: none; background:none;"><img src="{{ asset('icons/1215092.png') }}" width="25px" alt=""></button>
                        @endcan
                        @endif
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $payments->links() !!}
@endsection
