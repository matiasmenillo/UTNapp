<?php
    require_once("nav-barAdmin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo "Bienvenido " . $_SESSION["loggedUser"]->getRol();?>
    <h2>Modifcar datos de la empresa</h2>

    <form action="<?php echo FRONT_ROOT?> Company/Modify" method="POST">

        <label for="company_name">Nombre de la empresa</label>
        <input type="text" name="company_name" value="<?php echo $ModifCompany->getName() ?>" required style="color:black">

        <label for="company_cuit">Cuit</label>
        <input type="number" name="company_cuit" value="<?php echo $ModifCompany->getCuit() ?>" readonly="True" required style="color:black">

        <label for="company_status">Estado de la empresa</label>
        <select name="company_status" required style="color:black">
            <option value="" selected disabled hidden><?php echo $ModifCompany->getStatus() ?></option>
            <option value="active">Activa</option>
            <option value="inactive">Inactiva</option>
        </select>

        <button type="submit">Guardar</button>
    </form>

</body>
</html>