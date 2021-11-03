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

    <?php
        if (isset($error))
        {
            echo $error;
            unset($error);
        } 
    ?>

    <?php echo "Bienvenido " . $_SESSION["loggedUser"]->getFirstName();?>
    <h2>Ingrese los datos de la nueva empresa</h2>

    <form action="<?php echo FRONT_ROOT?> Company/Add" method="POST">

        <label for="company_name">Nombre</label>
        <input type="text" name="company_name" required style="color:black">

        <label for="company_cuit">Cuit</label>
        <input type="number" name="company_cuit" required style="color:black">

        <label for="company_AboutUs">About Us</label>
        <input type="text" name="company_AboutUs" required style="color:black">

        <label for="company_Link">Link</label>
        <input type="text" name="company_Link" required style="color:black">

        <label for="company_descripcion">Descripcion</label>
        <input type="text" name="company_descripcion" required style="color:black">

        <label for="company_sector">Sector</label>
        <input type="text" name="company_sector" required style="color:black">

        <label for="company_status">Estado</label>
        <select name="company_status" style="color:black">
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit" style="color:black">Agregar</button>
    </form>

</body>
</html>