<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<h1>Forget Password Email</h1>
You can reset password from bellow link: <br><br>
<a href="{{ route('change_password_form',['token' => $token]) }}" style="background-color:#103052;padding:10px;border:none;color:white;text-decoration:none;border-radius:0.5rem;display:inline-block;">Reset Password</a>


</body>
</html>