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
<h2 style="text-align:center; color:white">Ofertas Laborales disponibles</h2>
<br>
    <table style="text-align:center;">
    <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterJobOffersByJobPosition" method="get">
    <label for="user_CareerId" style="color:White;padding-right:10px;padding-left:10px;">Filtrar por Puesto Laboral</label>
    <div style="display:flex; flex-direction: row;padding-right:10px;padding-left:10px;">
         <select name="filter_JobPostitionId" style="color:black;width:500px;">
            <?php
                foreach($JobPositionsList as $JobPosition)
                {
                    echo "<option value='".$JobPosition->getJobPositionId()."'>".$JobPosition->getDescription()."</option>";
                }
            ?>
        </select>
        <button type="submit" class="btn" name="Filtrar"> Filtrar por Puesto Laboral </button>
    </form>
    </div>
    <br>
    <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterJobOffersByCareer" method="get">
        <label for="filter_CareerId" style="color:White;padding-right:10px;padding-left:10px;">Filtrar por Carrera</label>
        <div style="display:flex; flex-direction: row;padding-right:10px;padding-left:10px;">
        <select name="filter_CareerId" style="color:black;width:500px;">
            <?php
                foreach($CareersList as $Career)
                {
                    echo "<option value='".$Career->getCareerId()."'>".$Career->getDescription()."</option>";
                }
            ?>
        </select>
        <button type="submit" class="btn" name="Filtrar"> Filtrar por Carrera </button>
    </form>
    </div>
    <br>
    <div style="padding-left:10px;">
    <form action="<?php echo FRONT_ROOT ?>Postulation/ShowPostulateView" method="get">
            <button type="submit" style="color:white;" class="btn">Limpiar Filtros</button>
    </form>
    </div>
    <br>
        <thead>
        <tr>
            <th style="width: 15%;">DESCRIPCION</th>
            <th style="width: 30%;">CARRERA</th>
            <th style="width: 30%;">EMPRESA</th>


            <?php
                if ($rol == 'admin')
                {
                    ?>
                        <th style="width: 10%;"></th>
                        <th style="width: 30%;"></th>
                        <th style="width: 30%;"></th>
                    <?php
                }
                else
                {
                    ?>
                        <th style="width: 30%;"></th>
                    <?php
                }
            ?>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($JobOffersList as $JobOffer)
                {
                    if($rol == 'student')
                    {
                        ?>
                                <tr>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getDescription()?></td>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription() ?></td>
                                <td style="color:black"><?php echo $JobOffer->getCompany()->getName() ?></td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>Postulation/Add" method="POST">
                                    <input type="hidden" name="studentId" value="<?php echo  $_SESSION["loggedUser"]->getStudentId();?>">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="postulationDate" value="<?php echo date('y-m-d'); ?>">
                                        <button type="submit" class="btn" name="Apply" value="<?php ?>"> Aplicar </button>
                                    </form>
                                </td>
                        <?php   
                    }
                    ?>

                    <?php
                        if ($rol == 'admin')
                        {       
                    ?>
                        </tr>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getDescription()?></td>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription() ?></td>
                                <td style="color:black"><?php echo $JobOffer->getCompany()->getName() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo  $JobOffer->getJobOfferId();?>"> Remove </button>
                                </form>
                            </td>
                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowModifView" method="POST">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="JobPositionId" value="<?php echo $JobOffer->getJobPosition()->getJobPositionId(); ?>">
                                    <input type="hidden" name="CompanyId" value="<?php echo $JobOffer->getCompany()->getId(); ?>">
                                    <button type="submit" class="btn" name="modify"> Modify </button>
                                </form>
                            </td>

                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowPostulatedStudents" method="POST">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="CompanyId" value="<?php echo $JobOffer->getCompany()->getId(); ?>">
                                    <input type="hidden" name="JobPositionId" value="<?php echo $JobOffer->getJobPosition()->getJobPositionId(); ?>">
                                    <button type="submit" class="btn" name="ViewPostulated"> Ver Postulados </button>
                                </form>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                <?php
               }
                ?>
        </tbody>        