@extends('layouts.navbar')
@section('content')
<div class="row mt-5">
    <div class="col-12 col-md-9">
        <div class="card">
            <h3 class="card-header">
                User Information
            </h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="label-field">
                            <strong>
                                First Name:
                            </strong>
                            <span>
                                {{ $payment->first_name}}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Last Name:
                            </strong>
                            <span>
                                {{ $payment->last_name }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                City:
                            </strong>
                            <span>
                                {{ $payment->city }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Country:
                            </strong>
                            <span>
                                {{ $payment->country }}
                            </span>
                        </div>

                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="label-field">
                            <strong>
                                Personal ID:
                            </strong>
                            <span>
                                {{ $payment->personal_id }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Address Line 1:
                            </strong>
                            <span>
                                {{ $payment->address }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Address Line 2:
                            </strong>
                            <span>
                                {{ $payment->address2 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="card-header mt-5">
                Unit Information
            </h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="label-field">
                            <strong>
                                Total Unit Price:
                            </strong>
                            <span>
                                {{ $payment->total_unit_price }} EGP
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>Unit Unique Reference: </strong>
                            <span>
                                {{ $payment->unit_unique_reference }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Unit:
                            </strong>
                            <span>
                                Junior Villa Type A
                            </span>
                        </div>

                        <div class="label-field">
                            <strong>
                                Building Type:
                            </strong>
                            <span>
                                Junior Villa Type A
                            </span>
                        </div>
                                                    </div>
                </div>
            </div>
            <h3 class="card-header mt-5">
                Payment Information
            </h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="label-field">
                            <strong>Payment ID: </strong>
                            <span>
                                {{ $payment->id }}
                            </span>
                        </div>
                        <div class="label-field">
                            <strong>
                                Valid Hours:
                            </strong>
                            <span>
                                {{ $payment->valid_hours }}
                            </span>
                        </div>
                                                                                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="label-field">
                            <strong>
                                Down Payment:
                            </strong>
                            <span>
                                {{ $payment->down_payment }} EGP
                            </span>
                        </div>
                                                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card">
            <div class="payment-status mb-5">
                <h3>
                    Status
                </h3>
                <div class="">
                    @if($payment->status ==0)
                    <p class="text-danger"><img src="{{ asset('icons/6711656.png') }}" width="25px" alt=""> pending</p>
                    @else
                    <p class="text-success"> <img src="{{ asset('icons/correct.png') }}" alt=""> paid</p>
                    @endif
                    </div>
            </div>
        </div>
        <div class="card mt-3">
            <h3>Information</h3>
            <div class="update-by">
                <span>Last Update</span>
                <span>2 months ago</span>
            </div>

            <div class="update-by">
                <span>By</span>
                <span>{{  $payment->user->name }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
