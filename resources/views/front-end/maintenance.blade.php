<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('frontend/assets/logos/logos_foods.png') }}" type="image/x-icon">
    <title>Asian food museum</title>
    <style>
        body {
            text-align: left;
            padding: 150px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            background-color: #f3f3f3;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 40px;
        }

        p {
            font-size: 20px;
            margin-bottom: 20px;
        }

        a {
            color: #ff6700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: #0da487;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>We’ll be back soon!</h1>
    <p>Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to you can always
        <br>
        contact us<span style="color: red;"> support@asian-food.site</span>, otherwise we’ll be back online shortly!
    </p>
    <p>&mdash; Asian Food Museum Team</p>
    <button onclick="location.href = '{{ url('/') }}';" class="button">Back To Home Screen</button>
</body>

</html>
