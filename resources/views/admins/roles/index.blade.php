@extends('layouts.navbar')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role<img src="{{ asset('icons/plus (1).png') }}" width="20px" alt=""> </a>
            @endcan
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
        <p class="text-primary">{{ $message }}</p>
@endif
<table class="table table-bordered">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                <a class="" href="{{ route('roles.show',$role->id) }}"><img src="{{ asset('icons/5618479.png') }}" width="25px" alt=""></a>
                @can('role-edit')
                <a class="" href="{{ route('roles.edit',$role->id) }}"><img src="{{ asset('icons/747825.png') }}" width="25px" alt=""></a>
                @endcan
                @csrf
                @method('DELETE')
                @can('role-delete')
                <button type="submit" class="" style="border: none; background:none;"><img src="{{ asset('icons/1215092.png') }}" width="25px" alt=""></button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $roles->render() !!}
@endsection
