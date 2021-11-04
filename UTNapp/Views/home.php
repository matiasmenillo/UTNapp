<?php 
    include_once('header.php'); 

    if($_SESSION["loggedUser"]->getAdmin() == 1){
      include_once('nav-barAdmin.php'); 
    }
    if($_SESSION["loggedUser"]->getAdmin() == 0)
    {
      include_once('nav-barStudent.php');
    }

?>
  <div id="pageintro" class="hoc clear"> 
    <article class="center">
    <h3>Bienvenido, <?php echo $_SESSION["loggedUser"]->GetFirstName() . ' ' . $_SESSION["loggedUser"]->GetLastName() ?>!</h3>
      <h3 class="heading underline">UTN</h3>
      <p>Gestor de Pasantias</p>
      <footer></footer>

    
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
      <td style="color:black"><?php echo $_SESSION["loggedUser"]->getFileNumber(); ?></td>
      <td style="color:black"><?php echo $_SESSION["loggedUserCareer"]->getDescription(); ?></td>
      <td style="color:black"><?php echo $_SESSION["loggedUser"]->getGender(); ?></td>
      <td style="color:black"><?php echo $_SESSION["loggedUser"]->getBirthDate(); ?></td>
      <td style="color:black"><?php echo $_SESSION["loggedUser"]->getEmail(); ?></td>
      <td style="color:black"><?php echo $_SESSION["loggedUser"]->getPhoneNumber(); ?></td>
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
