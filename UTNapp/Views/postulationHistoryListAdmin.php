<?php
        require_once("nav-barAdmin.php");
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<div>
            <div>
                <table style="text-align:center;">
                <h2 style="text-align:center; color:white"> Historial de Postulaciones </h2>
                    <thead>
                    <tr>
                        <th style="width: 15%;">NOMBRE</th>
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
                                    ?>
                                    <tr>
                                    <td style="color:black"><?php echo $Postulation->getStudent()->GetFirstName() . " " .  $Postulation->getStudent()->GetLastName()?></td>
                                    <td style="color:black"><?php echo $Postulation->getJobOffer()->getJobPosition()->getDescription()?></td>
                                    <td style="color:black"><?php echo $Postulation->getJobOffer()->getJobPosition()->getCareer()->getDescription() ?></td>
                                    <td style="color:black"><?php echo $Postulation->getJobOffer()->getCompany()->getName() ?></td>
                                    <td style="color:black"><?php echo $Postulation->getPostulationDate() ?></td>
                                    <td>
                                    <form action="<?php echo FRONT_ROOT ?>Student/ShowViewStudentDetails" method="POST">
                                        <input type="hidden" name="StudentId" value="<?php echo $Postulation->getStudent()->GetStudentId(); ?>">
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