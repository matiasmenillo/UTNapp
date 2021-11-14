<?php
        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == 1)
        {
            $rol = 'admin';
            require_once("nav-barAdmin.php");
        }
        else
        {
            require_once("nav-barCompany.php");
        }
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Postulation/showPostulationHistoryView" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<h3 style="text-align:center; color:white">Detalles de <?php echo $student->GetFirstName() . ' ' . $student->GetLastName() ?></h3>

<table style="text-align:center; color:orange">
    <thead>
        <tr>
            <th style="width: 3%;">Legajo</th>
            <th style="width: 1%;">Carrera</th>
            <th style="width: 1%;">Sexo</th>
            <th style="width: 1%;">Fecha de Nacimiento</th>
            <th style="width: 1%;">Email</th>
            <th style="width: 1%;">Telefono</th>
        </tr>
  </thead>
  <tbody>
  <tr>
      <td style="color:black"><?php echo $student->getFileNumber(); ?></td>
      <td style="color:black"><?php echo $student->getCareer()->getDescription() ?></td>
      <td style="color:black"><?php echo $student->getGender(); ?></td>
      <td style="color:black"><?php echo $student->getBirthDate(); ?></td>
      <td style="color:black"><?php echo $student->getEmail(); ?></td>
      <td style="color:black"><?php echo $student->getPhoneNumber(); ?></td>
  </tr>
  </tbody>
    </table>
    <?php
    require_once("footer.php");
?>