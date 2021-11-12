<?php
    require_once('nav-barStudent.php');
    $student = $_SESSION['loggedUser'];
?>
<main class="py-5">
     <section id="listado" class="mb-5">
         <h1></h1>
         <div style="margin:left;padding-left:100px">
          <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
               <button type="submit" class='btn'>Volver</button>
          </form>
          </div>
          <div class="container" style="text-align:center;">
               <h2 class="mb-4" style="color:white">Ingrese su Cv</h2>
               <form action="<?php echo FRONT_ROOT ?>Image/Upload" method="POST" enctype="multipart/form-data" class="bg-light-alpha p-5">
                              <label for="file" style="color:white">Imagen:</label>
                              <input type="file" name="file" class="form-control-file" style="display:inline-block;width:500px;color:white" required> 
                              <input type="hidden" name="idStudent" value="<?php echo $_SESSION["loggedStudent"]->getStudentId();?>">                                              
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Cargar</button>
               </form>
          </div>
     </section>
</main>
<?php
    require_once("footer.php");
?>