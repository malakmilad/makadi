@extends('layouts.navbar')
@section('content')
<form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Question</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Question" name="question" value="{{ old('question') }}" class="@error('question') is-invalid @enderror">
      @error('question')
        <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Answer</label>
      <textarea class="form-control" placeholder="Leave a Answer here" id="floatingTextarea" name="answer" value="{{ old('answer') }}"class="@error('answer') is-invalid @enderror">{{ old('answer') }}</textarea>
      @error('answer')
        <p class="text-danger">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label for="validationCustom02">Movie Poster</label>
        <input name="img" class="form-control" type="file" id="formFileMultiple">
    </div>
    <button type="submit" class="btn btn-primary"><img src="{{ asset('icons/bookmark.png') }}" alt="" width="25px">Save</button>
  </form>
@endsection
