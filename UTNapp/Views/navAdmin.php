<?php

    use Models\User as User;
    $adminRol = "admin";

    if(isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getRol() != $adminRol)){
        header("location: ".FRONT_ROOT."Home/index");
    }else
        echo "Bienvenido " . $_SESSION["loggedUser"]->getEmail();
?>
    
    <ul>
            <li><a href="<?php echo FRONT_ROOT."" ?>">Inicio</a></li>
            <li><a href="<?php echo FRONT_ROOT."Company/ShowAddView" ?>">Añadir Empresa</a></li>
            <li><a href="<?php echo FRONT_ROOT."Company/ShowCompanyListView" ?>">Ver Empresas</a></li>
            <li><a href="<?php echo FRONT_ROOT."deleteCompany.php" ?>">Eliminar Empresa</a></li> 
            <li><a href="<?php echo FRONT_ROOT."modifyCompany.php" ?>">Modificar Empresa</a></li>
    </ul>

