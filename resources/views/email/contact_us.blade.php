<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>From IQAC Page</title>
</head>
<body>
   You received a message from : {{ $mail_data['name'] }}
   
   <p>
   Name: {{ $mail_data['name'] }}
   </p>
   
   <p>
   Email Address: {{ $mail_data['email'] }}
   </p>
   
   <p>
   Message: {{ $mail_data['message'] }}
   </p>   
</body>
</html>
