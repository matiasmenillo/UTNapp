<?php
if(isset($_SESSION['loggedUser']))
{
     if($_SESSION['loggedUser']->getRol() == 0)
     {
           require_once('nav-barStudent.php');
      }
     else
          require_once('nav-barAdmin.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <br>
     <div style="margin:left;padding-left:100px;">
    <form action="<?php echo FRONT_ROOT?> Image/ShowListView" method="POST">
        <button type="submit" class='btn'>Volver</button>
    </form>
    </div>
          <div class="container" style="text-align:center;">
               <h2 class="mb-4" style="color:white;">Imagen cargada</h2>

               <?php
                    if(isset($image))
                    {
                        ?>
                            <img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$image->getName() ?>">
                        <?php
                    }
               ?>               
          </div>
     </section>
</main>
<?php
}
?>
<?php
    require_once("footer.php");
?>