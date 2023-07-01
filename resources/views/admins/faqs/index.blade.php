@extends('layouts.navbar')
@section('content')
@if ($message = Session::get('success'))
<p class="text-primary">{{ $message }}</p>
@endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>FaQs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('faqs.create') }}"> Create New Faqs <img src="{{ asset('icons/plus (1).png') }}" width="20px" alt=""></a>
            </div>
        </div>
    </div>
    <br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">id</th>
                <th>Question</th>
                <th>Answer</th>
                <th>img</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq )
              <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td><img width="100px" src="{{asset('upload/'.$faq->img)}}"></td>
                <td>
                    <form action="{{ route('faqs.destroy',$faq->id) }}" method="POST">
                        <a class="" href="{{ route('faqs.show',$faq->id) }}"><img src="{{ asset('icons/5618479.png') }}" width="25px" alt=""></a>
                        <a class="" href="{{ route('faqs.edit',$faq->id) }}"><img src="{{ asset('icons/747825.png') }}" width="25px" alt=""></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="" style="border: none; background:none;"><img src="{{ asset('icons/1215092.png') }}" width="25px" alt=""></button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $faqs->links() !!}
@endsection
