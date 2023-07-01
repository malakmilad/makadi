@extends('layouts.navbar')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Payment</h2>
            </div>
        </div>
    </div>
    <br>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
            <button type="submit" class="btn btn-primary"><img src="{{ asset('icons/bookmark.png') }}" alt="" width="25px">Save</button>
          <br><br>
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                  <!-- general form elements -->
                  <div class="card card-danger">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">First Name</label>
                          <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" class="@error('first_name') is-invalid @enderror">
                          @error('first_name')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Last Name</label>
                          <input type="text" class="form-control" placeholder="" name="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror">
                          @error('last_name')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Phone number</label>
                            <input type="text" class="form-control" placeholder="" name="phone_number" value="{{ old('phone_number') }}" class="@error('phone_number') is-invalid @enderror">
                            @error('phone_number')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" placeholder="" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Personal ID</label>
                            <input type="text" class="form-control" placeholder="" name="personal_id" value="{{ old('personal_id') }}"  class="@error('personal_id') is-invalid @enderror">
                            @error('personal_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">Unit Unique Reference</label>
                            <input type="text" class="form-control" placeholder="" name="unit_unique_reference" value="{{ old('unit_unique_reference') }}"  class="@error('unit_unique_reference') is-invalid @enderror">
                            @error('unit_unique_reference')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Total Unit Price</label>
                            <input type="number" class="form-control" placeholder="" name="total_unit_price" value="{{ old('total_unit_price') }}" class="@error('total_unit_price') is-invalid @enderror">
                            @error('total_unit_price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">Down Payment</label>
                            <input type="number" class="form-control" placeholder="" name="down_payment" value="{{ old('down_payment') }}" class="@error('down_payment') is-invalid @enderror">
                            @error('down_payment')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Valid Hours</label>
                              <input type="number" name="valid_hours" class="form-control" id="validHours" value="{{ old('valid_hours') }}" class="@error('valid_hours') is-invalid @enderror">
                              @error('valid_hours')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" placeholder="1234 Main St" name="address" value="{{ old('address') }}" class="@error('address') is-invalid @enderror">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Address 2</label>
                            <input type="text" class="form-control" placeholder="Apartment, studio, or floor" name="address2" value="{{ old('address2') }}"class="@error('address2') is-invalid @enderror">
                            @error('address2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">City</label>
                            <input type="text" class="form-control" placeholder="" name="city" value="{{ old('city') }}"class="@error('city') is-invalid @enderror">
                            @error('city')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-6">
                              <label for="exampleInputEmail1">Country</label>
                            <input type="text" class="form-control" placeholder="" name="country" value="{{ old('country') }}"class="@error('country') is-invalid @enderror">
                            @error('country')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                          </div>
                          <div class="col-6">
                              <label for="exampleInputEmail1">On Behalf Of:</label>
                              <select class="form-select" aria-label="Default select example" name="user_id">
                                @foreach ($users as $user )
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                      </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-3">
                  <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Zone</label>
                          <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Building Type</label>
                          <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </form>
                  </div>

                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
    </form>
@endsection
