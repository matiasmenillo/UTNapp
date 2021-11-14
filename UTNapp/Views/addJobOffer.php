<?php
    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
    else
    {
        require_once("nav-barCompany.php");
    }
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
    <div style="margin:left;padding-left:100px">
    <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
        <button type="submit" class='btn'>Volver</button>
    </form>
    </div>

    <?php 
        if ($_SESSION["loggedUser"]->getRol() == 1)
        { 
            ?> <h2 style="color:white;text-align:center">Seleccione las opciones para crear la oferta laboral</h2> <?php
        }
        else
        {
            ?> <h2 style="color:white;text-align:center">Seleccione la opción para crear la oferta laboral</h2> <?php
        }
    ?>
    <br>
    <form action="<?php echo FRONT_ROOT?> JobOffer/Add" method="POST">
    <label for="jobPositionId" style="color:White;text-align:center">Seleccione la Posición</label>
        <select name="jobPositionId" style="color:black;margin:auto" required>
        <?php
            foreach($jobPositionList as $jobPosition)
            {
                echo "<option value='".$jobPosition->getJobPositionId()."'>".$jobPosition->getDescription()."</option>";
            }
        ?>
        </select>

        <?php if ($_SESSION["loggedUser"]->getRol() == 1) 
        { 
        ?>
            <label for="companyId" style="color:White;text-align:center">Seleccione una Empresa</label>
                <select style="margin:auto;color:black" name="companyId" style="color:black" required>
                    <?php
                        foreach($companyList as $company)
                        {
                            if ($company->getStatus() == 1)
                            {
                                echo "<option value='".$company->getId()."' selected>".$company->getName()."</option>";
                            }
                        }
                    ?>
                </select>
        <?php 
        }
        else
        {
            ?> <input type="hidden" name="companyId" value="<?php echo $_SESSION["loggedCompany"]->getId(); ?>"> <?php
        } 
        ?>
        <br>
        <button type="submit" style="color:black; margin:auto">Agregar</button>
    </form>

</body>
</html>
<?php
    require_once("footer.php");
?>