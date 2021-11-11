<?php
    require_once("nav-barAdmin.php");

    if (isset($error))
    {
        echo $error;
        unset($error);
    } 
?>
    <h2 style="color:White">Seleccione las opciones para Modificar la oferta laboral</h2>

    <form action="<?php echo FRONT_ROOT?> JobOffer/Modify" method="POST">
    
    <label for="jobPositionId" style="color:White">Seleccione la Posicion</label>
        <select name="jobPositionId" style="color:black" required>
            <?php
                foreach($jobPositionList as $jobPosition)
                {
                    if ($jobPosition->getJobPositionId() == $ModifJobOffer->getJobPosition()->getJobPositionId())
                    {
                        echo "<option value='".$jobPosition->getJobPositionId()."' selected>".$jobPosition->getDescription()."</option>";
                    }
                    else
                    {
                        echo "<option value='".$jobPosition->getJobPositionId()."'>".$jobPosition->getDescription()."</option>";
                    }
                }
            ?>
        </select>

    <label for="companyId" style="color:White">Seleccione una Empresa</label>
        <select name="companyId" style="color:black" required>
            <?php
                foreach($companyList as $company)
                {
                    if ($company->getId() == $ModifJobOffer->getCompany()->getId())
                    {
                        echo "<option value='".$company->getId()."' selected>".$company->getName()."</option>";
                    }
                    else
                    { 
                        echo "<option value='".$company->getId()."'>".$company->getName()."</option>";
                    }
                }
            ?>
        </select>
        <br>
        <input type="hidden" name="JobOfferId" value="<?php echo $ModifJobOffer->getJobOfferId(); ?>">
        <button type="submit" style="color:black">Guardar</button>
    </form>
<?php
    require_once("footer.php");
?>