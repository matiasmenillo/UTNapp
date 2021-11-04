<?php
    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        require_once("nav-barAdmin.php");
    }
    else
    {
        require_once("nav-barStudent.php");
    }
?>
<br>
<h2 style="text-align:center; color: white">Estudiantes</h2>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 3%;">Nombre y apellido</th>
            <th style="width: 1%;">ID</th>
            <th style="width: 10%;">DNI</th>
            <th style="width: 1%;">Genero</th>
            <th style="width: 1%;">Email</th>
            <th style="width: 1%;">Carrera</th>
             <th style="width: 10%;">Fecha de Nacimiento</th>
            <th style="width: 10%;">Numero de telefono</th>
            <th style="width: 1%;">Activo</th>
            <th style="width: 1%;">Rol</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($studentList as $student)
                {
                ?>
                    <tr>
                    <td style="color:black"><?php echo $student->getLastName() ?>, <?php echo $student->getFirstName() ?></td>
                    <td style="color:black"><?php echo $student->getStudentId() ?></td>
                    <td style="color:black"><?php echo $student->getDNI() ?></td>
                    <td style="color:black"><?php echo $student->getGender() ?></td>
                    <td style="color:black"><?php echo $student->getEmail() ?></td>
                    <td style="color:black"><?php echo $student->getCareerId() ?></td>
                
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
                    <td style="color:black">
                            <?php 
                            if($student->getAdmin())
                            {
                                echo "Administrador";
                            }else 
                            {
                                echo "Estudiante";
                            }
                    ?></td>
                    </tr>
                <?php
               }
               
                ?>
        </tbody>  