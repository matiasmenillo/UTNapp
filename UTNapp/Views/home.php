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
      <h3 class="heading underline">UTN</h3>
      <p>Gestor de Pasantias</p>
      <footer></footer>
    </article>
  </div>
</div>
<?php 
    include_once('footer.php');   

?>

