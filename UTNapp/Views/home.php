<?php 
    include_once('header.php'); 

    if($_SESSION["loggedUser"]->getRol() == 1){
      include_once('nav-barAdmin.php'); 
    }
    else if ($_SESSION["loggedUser"]->getRol() == 0)
    {
      include_once('nav-barStudent.php');
    }
    else
    {
      include_once('nav-barCompany.php');
    }

?>
  <div id="pageintro" class="hoc clear"> 
    <article class="center">
    <h3>Bienvenido, <?php echo $_SESSION["loggedUser"]->GetFirstName() . ' ' . $_SESSION["loggedUser"]->GetLastName() ?>!</h3>
      <h3 class="heading underline">UTN</h3>
      <p>Gestor de Pasantías</p>
      <footer></footer>

    
    <table style="text-align:center; color:orange">
    <thead>
        <tr>
            <?php if ($_SESSION["loggedUser"]->getRol() == 0)
                  {
                    ?><th style="width: 3%;">Legajo</th>
                    <th style="width: 1%;">Carrera</th>
                    <th style="width: 1%;">Sexo</th>
                    <th style="width: 1%;">Fecha de Nacimiento</th>
                    <th style="width: 1%;">Telefono</th>
                  <?php 
                  }
                  ?>
                    <th style="width: 1%;">Email</th>
        </tr>
  </thead>
  <tbody>
  <tr>
      <?php if ($_SESSION["loggedUser"]->getRol() == 0) 
      {
        ?><td style="color:black"><?php echo $_SESSION["loggedStudent"]->getFileNumber(); ?></td>
        <td style="color:black"><?php echo $_SESSION["loggedStudent"]->getCareer()->getDescription(); ?></td>
        <td style="color:black"><?php echo $_SESSION["loggedStudent"]->getGender(); ?></td>
        <td style="color:black"><?php echo $_SESSION["loggedStudent"]->getBirthDate(); ?></td>
        <td style="color:black"><?php echo $_SESSION["loggedStudent"]->getPhoneNumber(); ?></td>
      <?php
      }
      ?>
        <td style="color:black"><?php echo $_SESSION["loggedUser"]->getEmail(); ?></td>
  </tr>
  </tbody>
    </table>

      <div class="hoc clear">
    <br>
  </div>
    </article>
  </div>
</div>
<?php 
    include_once('footer.php');   

?>
