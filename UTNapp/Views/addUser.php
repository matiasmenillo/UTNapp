<!DOCTYPE html>
<html>
<head>    
    <title>Registrar</title>    
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>style.css">    
<style>
form { 
margin: 0 auto; 
width:130px;
}
</style>
</head>    
<body>
    <h2>Registrarse</h2>
    <form action="<?php echo FRONT_ROOT ?> Home/Index" method="POST">

        <label for="user_firstName" style="color:white">Nombre</label>
        <input type="text" name="user_firstName" >

        <label for="user_lastName" style="color:white">Apellido</label>
        <input type="text" name="user_lastName" required>

        <label for="user_email" style="color:white">Email</label>
        <input type="text" name="user_email" required>

        <label for="user_dni" style="color:white">Dni</label>
        <input type="number" name="user_dni" required>

        <label for="user_rol" style="color:white">Seleccione un rol</label>
        <select name="user_rol" style="color:white" required>
            <option value="admin">Administrador</option>
            <option value="student">Estudiante</option>
        </select>
        
        <label for="user_password" style="color:white">Contraseña</label>
        <input type="password" name="user_password" required>

        <br>

        <button type="submit">Agregar</button>

    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>