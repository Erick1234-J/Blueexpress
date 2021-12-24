<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div>
        <h1 >Hello {{$parcel->FirstName}} </h1>
        <h1>Your parcel has been submitted successfully.</h1>
        <h2>Your Tracking Number is: {{$parcel->Reference}}</h2>
        <h2>Kindly visit blueexpress to track the status of your parcel</h2>
        <h3>Thank You for shipping with us!</h3>
    </div>
</body>
</html>