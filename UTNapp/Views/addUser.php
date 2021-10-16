<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Registrarse</h2>
    <form action="<?php echo FRONT_ROOT ?> User/Add" method="POST">

        <label for="user_firstName">Nombre</label>
        <input type="text" name="user_firstName">

        <label for="user_lastName">Apellido</label>
        <input type="text" name="user_lastName">

        <label for="user_email">Email</label>
        <input type="text" name="user_email">

        <label for="user_dni">Dni</label>
        <input type="number" name="user_dni">

        <label for="user_rol">Seleccione un rol</label>
        <select name="user_rol">
            <option value="" selected disabled hidden>Seleccione</option>
            <option value="admin">Administrador</option>
            <option value="student">Estudiante</option>
        </select>
        
        <label for="user_password">Contraseña</label>
        <input type="password" name="user_password">

        

        <button type="submit">Agregar</button>

    </form>
</body>
</html>