<?php

    if ($_SESSION["loggedUser"]->getRol() == 1)
    { 
        require_once("nav-barAdmin.php");
    }
    else
    {
        require_once("nav-barCompany.php");
    }
?>
<br>
<div style="margin:left;padding-left:100px">
               <form action="<?php echo FRONT_ROOT?> Postulation/ShowPostulateView" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>

    <?php
        if ($_SESSION["loggedUser"]->getRol() == 1)
        { 
            ?> <h2 style="text-align:center;color:White">Seleccione las opciones para modificar la oferta laboral</h2> <?php
        }
        else
        {
            ?> <h2 style="text-align:center;color:White">Seleccione la opción para modificar la oferta laboral</h2> <?php
        }
    ?>

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

    <?php if ($_SESSION["loggedUser"]->getRol() == 1) 
    { 
    ?>

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
    <?php 
    }
    else
    {
        ?> <input type="hidden" name="companyId" value="<?php echo $_SESSION["loggedCompany"]->getId(); ?>"> <?php
    } 
    ?>
        <br>
        <input type="hidden" name="JobOfferId" value="<?php echo $ModifJobOffer->getJobOfferId(); ?>">
        <button style="margin:auto;color:black" type="submit" style="color:black">Guardar</button>
    </form>
<?php
    require_once("footer.php");
?>