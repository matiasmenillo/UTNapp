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

        <br>
        <br>
    <h2 style="text-align:center; color:white">Ingrese los datos de la nueva empresa</h2>

    <form style="text-align:center;color:white" action="<?php echo FRONT_ROOT?> Company/Add" method="POST">

        <label for="company_name">Nombre</label>
        <input style="margin:auto;color:black" type="text" name="company_name" required>

        <label for="company_cuit">Cuit</label>
        <input style="margin:auto;color:black" type="number" name="company_cuit" required>

        <label for="company_AboutUs">About Us</label>
        <input style="margin:auto;color:black" type="text" name="company_AboutUs" required>

        <label for="company_Link">Link</label>
        <input style="margin:auto;color:black" type="text" name="company_Link" required>

        <label for="company_descripcion">Descripcion</label>
        <textarea id="subject" name="company_descripcion" placeholder="Descripción de su compañia..." style="height:100px;width:250px;margin:auto;color:black" required></textarea>
        
        <label for="company_sector">Sector</label>
        <input style="margin:auto;color:black" type="text" name="company_sector" required>

        <label for="company_status">Estado</label>
        <select style="margin:auto;color:black" name="company_status">
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
        </select>
        <br>
        <button style="margin:auto;color:black" type="submit" style="color:black">Agregar</button>
    </form>
    <br>
    <br>
    <br>
    <br>

</body>
</html>

<?php
    require_once("footer.php");
?>