<?php
    require_once("nav-barAdmin.php");

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
    <h2 style="text-align:center;color:White">Seleccione las opciones para modificar la oferta laboral</h2>

    <form style="text-align:center;color:white" action="<?php echo FRONT_ROOT?> JobOffer/Modify" method="POST">
    
    <label for="jobPositionId" style="color:White">Seleccione la posición</label>
        <select style="margin:auto;color:black" name="jobPositionId" style="color:black" required>
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
        <select style="margin:auto;color:black" name="companyId" style="color:black" required>
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
        <button style="margin:auto;color:black" type="submit" style="color:black">Guardar</button>
    </form>
<?php
    require_once("footer.php");
?>