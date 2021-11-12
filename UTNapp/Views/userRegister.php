<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        $admin = $_SESSION["loggedUser"];
        require_once("nav-barAdmin.php");
    }
?>
</head> 
<body>
    <br>
    <div style="margin:left;padding-left:100px">
    <form action="<?php echo FRONT_ROOT?> Home/Index" method="POST">
        <button type="submit" class='btn'>Volver</button>
    </form>
    </div>
<h2 style="text-align:center; color:white">Registro Usuario</h2>
    <form action="<?php echo FRONT_ROOT ?> User/Add" method="POST">

        <label for="user_FirstName" style="color:White;text-align:center">Nombre</label>
        <input style="margin:auto" type="text" name="user_FirstName" style="color:black" required>

        <label for="user_LastName" style="color:White;text-align:center">Apellido</label>
        <input style="margin:auto" type="text" name="user_LastName" style="color:black" required>

        <label for="user_email" style="color:White;text-align:center">Email</label>
        <input style="margin:auto" type="text" name="user_email" style="color:black" required>

        <label for="user_password" style="color:White;text-align:center">Contraseña</label>
        <input style="margin:auto" type="password" name="user_password" style="color:black" required>
        <br>
        <button style="margin:auto" type="submit" style="color:White;text-align:center">Registrarse</button>
    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>