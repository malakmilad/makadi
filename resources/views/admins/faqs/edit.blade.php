@extends('layouts.navbar')
@section('content')
<form action="{{ route('faqs.update',$faq->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Question</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Question" name="question" value="{{ $faq->question }}">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Answer</label>
      <textarea class="form-control" placeholder="Leave a Answer here" id="floatingTextarea" name="answer" value="{{ $faq->answer }}">{{ $faq->answer }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary"><img src="{{ asset('icons/bookmark.png') }}" alt="" width="25px">Save</button>
  </form>
@endsection
