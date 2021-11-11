<?php
    require_once('nav-barStudent.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
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