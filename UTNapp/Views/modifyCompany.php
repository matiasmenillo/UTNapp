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
    <?php echo "Bienvenido " . $_SESSION["loggedUser"]->getFirstName();?>
    <h2>Modifcar datos de la empresa</h2>

    <form action="<?php echo FRONT_ROOT?> Company/Modify" method="POST">

        <label for="company_id">ID</label>
        <input type="number" name="company_id" value="<?php echo $ModifCompany->getId() ?>" readonly="True" required style="color:black">

        <label for="company_name">Nombre</label>
        <input type="text" name="company_name" value="<?php echo $ModifCompany->getName() ?>" required style="color:black">

        <label for="company_cuit">Cuit</label>
        <input type="number" name="company_cuit" value="<?php echo $ModifCompany->getCuit() ?>" readonly="True" required style="color:black">

        <label for="company_AboutUs">About Us</label>
        <input type="text" name="company_AboutUs" value="<?php echo $ModifCompany->getAboutUs() ?>" required style="color:black">

        <label for="company_Link">Link</label>
        <input type="text" name="company_Link" value="<?php echo $ModifCompany->getCompanyLink() ?>" required style="color:black">

        <label for="company_descripcion">Descripcion</label>
        <input type="text" name="company_descripcion" value="<?php echo $ModifCompany->getDescription() ?>" required style="color:black">

        <label for="company_sector">Sector</label>
        <input type="text" name="company_sector" value="<?php echo $ModifCompany->getSector() ?>" required style="color:black">

        <label for="company_status">Estado</label>
        <select name="company_status" style="color:black">
            <option value="<?php if ($ModifCompany->getStatus() == 1) {echo 1;} else {echo 0;} ?>" selected><?php if ($ModifCompany->getStatus() == 1) {echo "Active";} else {echo "Inactive";} ?></option>
            <option value="<?php if ($ModifCompany->getStatus() == 1) {echo 0;} else {echo 1;} ?>"><?php if ($ModifCompany->getStatus() == 1) {echo "Inactive";} else {echo "Active";} ?></option>
        </select>

        <button type="submit" style="color:black">Guardar</button>
    </form>

</body>
</html>