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
    <br><br>
    <?php echo "Bienvenido, admin " . $_SESSION["loggedUser"]->getLastName(); ?>
    <h2>Ingrese los datos de la nueva empresa</h2>

    <form action="<?php echo FRONT_ROOT?> Company/Add" method="POST">

        <label for="company_name">Nombre de la empresa</label>
        <input type="text" name="company_name">

        <label for="company_cuit">Cuit</label>
        <input type="number" name="company_cuit">
        <br><br>
        <button type="submit">Agregar</button>
    </form>

</body>
</html>