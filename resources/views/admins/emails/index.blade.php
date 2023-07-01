<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="color-scheme" content="light" />
    <meta name="supported-color-schemes" content="light" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hydeout</title>
    <style>
        body {
            max-width: 600px;
            /* margin: 0 auto; */
            padding: 40px;
            width: 100%;
        }

        .payment{
            background:black;
            border: none;
            border-radius: 10%;
            text-align: center;
            padding: 15px;
            text-decoration: none;
            color: white;
            margin-left:25vh;
        }
        .form{
            position: absolute;
            width: 50%;
            margin-left: 25vh;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="form">
        <h1>Hello : {{ $payment->first_name }} {{ $payment->last_name }}</h1>
        <a href="{{ $url }}" class="payment"> Pay</a>
    </div>
</body>

</html>
