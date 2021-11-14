<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == 1)
    {
        $admin = $_SESSION["loggedUser"];
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
<h2 style="text-align:center; color:white">Registrar usario de empresa</h2>
    <form action="<?php echo FRONT_ROOT ?> User/Add" method="POST">

        <label for="user_FirstName" style="color:White;text-align:center">Nombre</label>

        <select name="user_FirstName" style="color:black;margin:auto" required>
        <?php
            foreach($companyList as $company)
            {
                if ($company->getStatus() == 1)
                {
                    echo "<option value='".$company->getName()."'>".$company->getName()."</option>";
                }
            }
        ?>
        </select>

        <input type="hidden" name="user_LastName" value="">

        <label for="user_email" style="color:White;text-align:center">Email</label>
        <input style="margin:auto" type="text" name="user_email" style="color:black" required>

        <label for="user_password" style="color:White;text-align:center">Contraseña</label>
        <input style="margin:auto" type="password" name="user_password" style="color:black" required>

        <input type="hidden" name="user_rol" value="2">
        <br>
        <button style="margin:auto" type="submit" style="color:White;text-align:center">Registrar</button>
    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>