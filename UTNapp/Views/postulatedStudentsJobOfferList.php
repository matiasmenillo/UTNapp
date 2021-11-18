<?php

        require_once("nav-barAdmin.php");
?>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Postulation/ShowPostulateView" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<table style="text-align:center;">
<caption style="text-align:center;color:white;padding-bottom:20px;padding-top:10px;">Oferta laboral</caption>
<thead>
        <tr>
            <th style="width: 15%;">DESCRIPCIÓN</th>
            <th style="width: 15%;">CARRERA</th>
            <th style="width: 15%;">EMPRESA</th>
        </tr>
        </thead>
        <tbody>
                        <tr>
                        <td style="color:black"><?php echo $JobOffer->getJobPosition()->getDescription() ?></td>
                        <td style="color:black"><?php echo $JobOffer->getJobPosition()->getCareer()->getDescription() ?></td>
                        <td style="color:black"><?php echo $JobOffer->getCompany()->getName() ?></td>
                        </tr>
        </tbody>
<table style="text-align:center;">
<caption style="text-align:center;color:white;padding-bottom:20px;padding-top:10px;">Estudiantes postulados</caption>
<thead>
        <tr>
            <th style="width: 3%;">Nombre y apellido</th>
            <th style="width: 1%;">ID</th>
            <th style="width: 10%;">DNI</th>
            <th style="width: 1%;">Genero</th>
            <th style="width: 1%;">Email</th>
            <th style="width: 1%;">Carrera</th>
            <th style="width: 10%;">Fecha de Nacimiento</th>
            <th style="width: 10%;">Número de telefono</th>
            <th style="width: 1%;">Activo</th>
            <th style="width: 5%;"></th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($studentList as $student)
                {
                ?>
                <tr>
                    <td style="color:black"><?php echo $student->getLastName() ?>, <?php echo $student->getFirstName() ?></td>
                    <td style="color:black"><?php echo $student->getStudentId()?></td>
                    <td style="color:black"><?php echo $student->getDNI() ?></td>
                    <td style="color:black"><?php echo $student->getGender() ?></td>
                    <td style="color:black"><?php echo $student->getEmail() ?></td>
                    <td style="color:black"><?php echo $student->getCareer()->getDescription() ?></td>
                </td>
                    <?php $date=date_create($student->getBirthDate())?>
                    <td style="color:black"><?php echo date_format($date, "Y/m/d") ?></td>
                    <td style="color:black"><?php echo $student->getPhoneNumber() ?></td>
                    <td style="color:black">
                <?php  
                            if($student->getActive())
                            {
                                echo "Si";
                            }else 
                            {
                                echo "No";
                            }
                ?></td>
                <td>
                    <form action="<?php echo FRONT_ROOT ?>Postulation/Remove" method="POST">
                        <input type="hidden" name="StudentId" value="<?php echo $student->getStudentId(); ?>">
                        <input type="hidden" name="JobOfferId" value="<?php echo $JobOffer->getJobOfferId(); ?>">
                        <button type="submit" class="btn" name="ViewStudent"> Rechazar </button>
                    </form>
                </td>
                </tr>
                <?php
                }
                ?>
        </tbody>  

