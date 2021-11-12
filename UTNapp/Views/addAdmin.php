<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
?>
</head> 
<body>
    <br>
    <div style="margin:left;padding-left:100px">
    <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
        <button type="submit" class='btn'>Volver</button>
    </form>
    </div>
<h2 style="text-align:center; color:white">Cargar administrador</h2>
    <form action="<?php echo FRONT_ROOT ?> User/Add" method="POST">

        <label for="user_firstName" style="color:White;text-align:center">Nombre</label>
        <input style="margin:auto" type="text" name="user_firstName" style="color:black" required>

        <label for="user_lastName" style="color:White;text-align:center">Apellido</label>
        <input style="margin:auto" type="text" name="user_lastName" style="color:black" required>

        <label for="user_email" style="color:White;text-align:center">Email</label>
        <input style="margin:auto" type="text" name="user_email" style="color:black" required>
        
        <label for="user_password" style="color:White;text-align:center">Contraseña</label>
        <input style="margin:auto" type="password" name="user_password" style="color:black" required>

        <input type="hidden" name="user_admin" value="1">

        <br>

        <button style="margin:auto;" type="submit">Agregar</button>
    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>