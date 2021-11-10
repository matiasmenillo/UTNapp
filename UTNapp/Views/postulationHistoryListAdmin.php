<?php
        require_once("nav-barAdmin.php");
?>
<br>
<div>
            <div>
                <table style="text-align:center;">
                <h2 style="text-align:center; color:white"> Historial de Postulaciones </h2>
                    <thead>
                    <tr>
                        <th style="width: 15%;">DESCRIPCION</th>
                        <th style="width: 30%;">CARRERA</th>
                        <th style="width: 30%;">EMPRESA</th>
                        <th style="width: 30%;">FECHA</th>
                        <th style="width: 30%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($PostulationHistory as $Postulation)
                            {
                                foreach($JobOffersList as $JobOffer)
                                {
                                    if ($JobOffer->GetJobOfferId() == $Postulation->GetJobOfferId())
                                    {
                                        foreach($JobPositionsList as $JobPosition)
                                        {
                                            if ($JobOffer->getJobPositionId() == $JobPosition->getJobPositionId())
                                            {
                                                $JobPositionDescription = $JobPosition->getDescription();
                                                $JobPositionCareerId = $JobPosition->getCareerId();
                                            }
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

                                        $postulatedStudentId = $Postulation->getStudentId();
                                }
                                    ?>
                                    <tr>
                                    <td style="color:black"><?php echo $JobPositionDescription ?></td>
                                    <td style="color:black"><?php echo $CarrerDescription ?></td>
                                    <td style="color:black"><?php echo $CompanyName ?></td>
                                    <td style="color:black"><?php echo $Postulation->getPostulationDate() ?></td>
                                    <td>
                                    <form action="<?php echo FRONT_ROOT ?>Student/ShowViewStudentDetails" method="POST">
                                        <input type="hidden" name="StudentId" value="<?php echo $postulatedStudentId; ?>">
                                        <button type="submit" class="btn" name="ViewStudent"> Ver Postulado </button>
                                    </form>
                                    </td>
                                    </tr>
                        </tbody> 
                                    <?php
                                }
                                ?>
                    </tbody>        
            </div>