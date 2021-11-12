<?php
        require_once("nav-barStudent.php");
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<div>
    <?php
        if ($PostulacionVigente != null)
        {
    ?>
    <div>
        <table style="text-align:center;">
        <h2 style="text-align:center; color:white"> Postulacion actual </h2>
            <thead>
            <tr>
                <th style="width: 15%;">DESCRIPCION</th>
                <th style="width: 30%;">CARRERA</th>
                <th style="width: 30%;">EMPRESA</th>
                <th style="width: 30%;">FECHA</th>
                <th style="width: 50%;">ACCION</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($JobOffersList as $JobOffer)
                    {
                        if ($JobOffer->GetJobOfferId() == $PostulacionVigente->GetJobOffer()->GetJobOfferId())
                        {
                            ?>

                                <tr>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getDescription()?></td>
                                <td style="color:black"><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription() ?></td>
                                <td style="color:black"><?php echo $JobOffer->getCompany()->GetName() ?></td>
                                <td style="color:black"><?php echo $PostulacionVigente->getPostulationDate() ?></td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>Postulation/Remove" method="POST">
                                    <input type="hidden" name="studentId" value="<?php echo  $_SESSION["loggedStudent"]->getStudentId();?>">
                                    <button type="submit" class="btn" >Dar de Baja</button>
                                    </form>
                                </tr>

                            <?php
                        }
                    }
                ?>
            </tbody>
    </div>
    <?php
        }
    ?>

    <div>
        <table style="text-align:center;">
        <caption style="text-align:center;color:white; padding-bottom:10px;">Historial de Postulaciones</caption>
            <thead>
            <tr>
                <th style="width: 15%;">DESCRIPCION</th>
                <th style="width: 30%;">CARRERA</th>
                <th style="width: 30%;">EMPRESA</th>
                <th style="width: 30%;">FECHA</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($PostulationHistory as $Postulation)
                    {
                        ?>
                <tr>
                            <td style="color:black"><?php echo $Postulation->getJobOffer()->getJobPosition()->getDescription()?></td>
                            <td style="color:black"><?php echo $Postulation->getJobOffer()->getJobPosition()->getCareer()->getDescription() ?></td>
                            <td style="color:black"><?php echo $Postulation->getJobOffer()->getCompany()->getName() ?></td>
                            <td style="color:black"><?php echo $Postulation->getPostulationDate() ?></td>
                </tbody> 
                    <?php
                    }
                    ?>
            </tbody>        
    </div>
    <?php
    require_once("footer.php");
?>