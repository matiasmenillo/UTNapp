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
  <div class="hoc clear">
    <br>
    <h3>Bienvenido <?php echo $_SESSION["loggedUser"]->GetFirstName() . ' ' . $_SESSION["loggedUser"]->GetLastName() ?>!</h3>
    <p>Legajo: <?php echo $_SESSION["loggedUser"]->getFileNumber(); ?></p>
    <p>Carrera: <?php echo $_SESSION["loggedUserCareer"]->getDescription(); ?></p>
    <p>Sexo: <?php echo $_SESSION["loggedUser"]->getGender(); ?></p>
    <p>Fecha de Nacimiento: <?php echo $_SESSION["loggedUser"]->getBirthDate(); ?></p>
    <p>Telefono: <?php echo $_SESSION["loggedUser"]->getPhoneNumber(); ?></p>
  </div>

  <div id="pageintro" class="hoc clear"> 
    <article class="center">
      <h3 class="heading underline">UTN</h3>
      <p>Gestor de Pasantias</p>
      <footer></footer>
    </article>
  </div>
</div>
<?php 
    include_once('footer.php');   

?>

