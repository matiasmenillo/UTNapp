<?php
    require_once("navAdmin.php");
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
        <input type="text" name="company_name" value="<?php echo $ModifCompany->getName() ?>">

        <label for="company_cuit">Cuit</label>
        <input type="number" name="company_cuit" value="<?php echo $ModifCompany->getCuit() ?>" readonly="True">

        <button type="submit">Guardar</button>
    </form>

</body>
</html>