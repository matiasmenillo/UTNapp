<?php
    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == "admin")
    {
        require_once("nav-barAdmin.php");
    }
    else
    {
        require_once("nav-barStudent.php");
    }
?>
<br>
<h2 style="text-align:center;">Estudiantes</h2>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 15%;">Nombre y apellido</th>
            <th style="width: 5%;">ID</th>
            <th style="width: 5%;">Carrera</th>
            <th style="width: 10%;">Fecha de Nacimiento</th>
            <th style="width: 10%;">Numero de telefono</th>
            <th style="width: 5%;">Activo</th>
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
                    <td style="color:black"><?php echo $student->getCareerId() ?></td>
                    <?php $date=date_create($student->getBirthDate())?>
                    <td style="color:black"><?php echo date_format($date, "Y/m/d") ?></td>
                    <td style="color:black"><?php echo $student->getPhoneNumber() ?></td>
                    <td style="color:black">
                    <?php 
                            if($student->getActive() == 1)
                            {
                                echo "Si";
                            }else
                            {
                                echo "No";
                            }
                    ?></td>

                    <?php
                        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == "admin")
                        {
                    ?>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo $student->getStudentId() ?>"> Remove </button>
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