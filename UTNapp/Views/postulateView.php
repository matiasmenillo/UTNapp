<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
    else
    {
        $rol = 'student';
        require_once("nav-barStudent.php");
    }
?>
<br>
<h2 style="text-align:center;">Ofertas Laborales disponibles</h2>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 15%;">DESCRIPCION</th>
            <th style="width: 30%;">CARRERA</th>
            <th style="width: 30%;">EMPRESA</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($JobOffersList as $JobOffer)
                {
                    foreach($JobPositionsList as $JobPosition)
                    {
                        if ($JobOffer->getJobPositionId() == $JobPosition->getJobPositionId())
                        {
                            $JobPositionDescription = $JobPosition->getDescription();
                            $JobPositionCareerId = $JobPosition->getCareerId();
                        }
                    }

                    foreach($CareersList as $Career)
                    {
                        if ($JobPositionCareerId == $Career->getCareerId())
                        {
                            $CarrerDescription = $Career->getDescription();
                        }
                    }

                    foreach($CompanyList as $Company)
                    {
                        if ($JobOffer->getCompanyId() == $Company->getId())
                        {
                            $CompanyName = $Company->getName();
                        }
                    }

                    if($rol == 'student')
                    {

                        ?>
                                <tr>
                                <td style="color:black"><?php echo $JobPositionDescription ?></td>
                                <td style="color:black"><?php echo $CarrerDescription ?></td>
                                <td style="color:black"><?php echo $CompanyName ?></td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>Postulation/Add" method="POST">
                                    <input type="hidden" name="studentId" value="<?php echo  $_SESSION["loggedUser"]->getStudentId();?>">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="postulationDate" value="<?php echo date('y-m-d'); ?>">
                                        <button type="submit" class="btn" name="remove" value="<?php ?>"> Aplicar </button>
                                    </form>
                                </td>
                        <?php
                        
                    }
                        ?>

                    <?php
                        if ($rol == 'admin')
                        {       
                    ?>
                            <td style="color:black"><?php echo $JobPositionDescription ?></td>
                            <td style="color:black"><?php echo $CarrerDescription ?></td>
                            <td style="color:black"><?php echo $CompanyName ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo  $JobOffer->getJobOfferId();?>"> Remove </button>
                                </form>
                            </td>
                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>Company/ShowModifView" method="POST">
                                    <input type="hidden" name="Cuit" value="<?php ?>">
                                    <button type="submit" class="btn" name="modify"> Modify </button>
                                </form>

                            </td>
                        <?php
                        }
                        ?>
                        
                    </tr>
                <?php
               }
               
                ?>
        </tbody>        