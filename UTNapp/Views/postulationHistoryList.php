<?php
        require_once("nav-barStudent.php");
?>
<br>
<div>
    <?php
        if ($PostulacionVigente != null)
        {
    ?>
    <div>
        <table style="text-align:center;">
        <h2 style="text-align:center; color:white"> Historial de Postulaciones </h2>
            <thead>
            <tr>
                <th style="width: 15%;">DESCRIPCION</th>
                <th style="width: 30%;">CARRERA</th>
                <th style="width: 30%;">EMPRESA</th>
                <th style="width: 30%;">FECHA</th>
                <th style="width: 50%;">ACCIÓN</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($JobOffersList as $JobOffer)
                    {
                        if ($JobOffer->GetJobOfferId() == $PostulacionVigente->GetJobOfferId())
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
                        }
                    }
                ?>
                        <tr>
                            <td style="color:black"><?php echo $JobPositionDescription ?></td>
                            <td style="color:black"><?php echo $CarrerDescription ?></td>
                            <td style="color:black"><?php echo $CompanyName ?></td>
                            <td style="color:black"><?php echo $PostulacionVigente->getPostulationDate() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Postulation/Remove" method="POST">
                                <input type="hidden" name="studentId" value="<?php echo  $_SESSION["loggedUser"]->getStudentId();?>">
                                <button type="submit" class="btn" >Dar de Baja</button>
                                </form>
                        </tr>
            </tbody>
    </div>
    <?php
        }
    ?>
