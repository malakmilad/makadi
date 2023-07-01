<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .status{
            padding: 10px;
            background: black;
            text-align: center;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }
        .text-primary{
            color: blueviolet;
        }
    </style>
</head>
<body>
    @if ($message = Session::get('success'))
<p class="text-primary">{{ $message }}</p>
@endif
    <h1>{{ $payment->first_name }}</h1>

    <form action="{{ route('status',$payment) }}" method="post">
        @csrf
        {{--  @method('PUT')  --}}
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
        <button type="submit" class="status">Change Status</button>
    </form>
</body>
</html>
