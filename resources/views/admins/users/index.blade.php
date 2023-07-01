@extends('layouts.navbar')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User <img src="{{ asset('icons/plus (1).png') }}" width="20px" alt=""></a>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
    <p class="text-primary">{{ $message }}</p>
@endif
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>
@foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
            @endif
        </td>
        <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    <a class="" href="{{ route('users.show',$user->id) }}"><img src="{{ asset('icons/5618479.png') }}" width="25px" alt=""></a>
                    <a class="" href="{{ route('users.edit',$user->id) }}"><img src="{{ asset('icons/747825.png') }}" width="25px" alt=""></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="" style="border: none; background:none;"><img src="{{ asset('icons/1215092.png') }}" width="25px" alt=""></button>
                </form>
        </td>
    </tr>
@endforeach
</table>
{!! $data->render() !!}
@endsection
