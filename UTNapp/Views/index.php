<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        <form action="<?php echo FRONT_ROOT?>Login/Login" method="POST" >

        <label for="user_email">Email</label>
        <input type="text" name="user_email">

        <label for="user_password">Contraseña</label>
        <input type="password" name="user_password">
        
        <button type="submit">Ingresar</button>

    </form>
    </div>
    
</body>
</html>