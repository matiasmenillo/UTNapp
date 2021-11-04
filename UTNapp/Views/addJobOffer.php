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

    <h2>Seleccione las opciones para crea la oferta laboral</h2>

    <form action="<?php echo FRONT_ROOT?> JobOffer/Add" method="POST">
    
    <label for="jobPositionId" style="color:White">Seleccione la Posicion</label>
        <select name="jobPositionId" style="color:black" required>
        <?php
            foreach($jobPositionList as $jobPosition)
            {
                echo "<option value='".$jobPosition->getJobPositionId()."'>".$jobPosition->getDescription()."</option>";
            }
        ?>
        </select>

    <label for="companyId" style="color:White">Seleccione una Empresa</label>
        <select name="companyId" style="color:black" required>
        <?php
            foreach($companyList as $company)
            {
                echo "<option value='".$company->getId()."'>".$company->getName()."</option>";
            }
        ?>
        </select>

    <label for="careerId" style="color:White">Seleccione una Carrera</label>
        <select name="careerId" style="color:black" required>
        <?php
            foreach($careerList as $career)
            {
                echo "<option value='".$career->getCareerId()."'>".$career->getDescription()."</option>";
                $careerId = $career->getCareerId();
            }
        ?>
        </select>

 
        <button type="submit" style="color:black">Agregar</button>
    </form>

</body>
</html>
<?php
    require_once("footer.php");
?>