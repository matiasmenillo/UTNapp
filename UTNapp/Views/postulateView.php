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
    <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterJobOffersByJobPosition" method="get">
        <label for="user_CareerId" style="color:White">Filtrar por Puesto Laboral</label>
            <select name="filter_JobPostitionId" style="color:black">
            <?php
                foreach($JobPositionsList as $JobPosition)
                {
                    echo "<option value='".$JobPosition->getJobPositionId()."'>".$JobPosition->getDescription()."</option>";
                }
            ?>
        </select>
        <br>
        <button type="submit" class="btn" name="Filtrar"> Filtrar por Puesto Laboral </button>
    </form>
    <br>
    <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterJobOffersByCareer" method="get">
        <label for="filter_CareerId" style="color:White">Filtrar por Carrera</label>
        <select name="filter_CareerId" style="color:black">
            <?php
                foreach($CareersList as $Career)
                {
                    echo "<option value='".$Career->getCareerId()."'>".$Career->getDescription()."</option>";
                }
            ?>
        </select>
        <br>
        <button type="submit" class="btn" name="Filtrar"> Filtrar por Carrera </button>
    </form>
    <form action="<?php echo FRONT_ROOT ?>Postulation/ShowPostulateView" method="get">
            <button type="submit" style="color:black" >Limpiar Filtros</button>
    </form>
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
                            <td style="color:black"><?php echo $JobPositionDescription ?></td>
                            <td style="color:black"><?php echo $CarrerDescription ?></td>
                            <td style="color:black"><?php echo $CompanyName ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo  $JobOffer->getJobOfferId();?>"> Remove </button>
                                </form>
                            </td>
                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowModifView" method="POST">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="JobPositionId" value="<?php echo $JobOffer->getJobPositionId(); ?>">
                                    <input type="hidden" name="CompanyId" value="<?php echo $JobOffer->getCompanyId(); ?>">
                                    <button type="submit" class="btn" name="modify"> Modify </button>
                                </form>
                            </td>

                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowPostulatedStudents" method="POST">
                                    <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                                    <input type="hidden" name="CompanyId" value="<?php echo $JobOffer->getCompanyId(); ?>">
                                    <input type="hidden" name="JobPositionId" value="<?php echo $JobOffer->getJobPositionId(); ?>">
                                    <button type="submit" class="btn" name="modify"> Ver Postulados </button>
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