<?php
if(isset($_SESSION['loggedUser']))
{

    if($_SESSION['loggedUser']->getAdmin() == 0)
    {
          require_once('nav-barStudent.php');
          $student = $_SESSION['loggedUser'];
     }
     else
          require_once('nav-barAdmin.php');
?>
<br>
<main>
     <?php 
          if ($_SESSION['loggedUser']->getAdmin() == 0)
          {
     ?>
              <div style="margin:left;padding-left:100px">
               <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
          <h2 class="mb-4;" style="color:white;text-align:center;">Mis CVs</h2>
          <br>
                              <section>
                    <div>
                         <?php if(isset($student)){ ?>
                         
                         <table>
                              <thead>
                                   <th>CVs Subidos</th>
                                   <th>Ver</th>
                              </thead>
                              <tbody>
                              <?php
                                   if(isset($imageList))
                                   {
                                        foreach($imageList as $image)
                                        {
                                             if($student->getStudentId() == $image->getIdStudent()){
                                             ?>
                                                  <tr>
                                                  <td><?php echo $image->getName() ?></td> 
                                                  <td><a href="<?php echo FRONT_ROOT ?>Image/ShowImage/<?php echo $image->getImageId() ?>">Ver</a></td>
                                                  </tr>
                                             <?php
                                             }
                                        }
                                   }
                              ?>
                              </tbody>
                         </table>
                         <?php
                                   }

                         ?>

                    </div>
               </section>
                         <?php
          }
          else
          {
                         ?>
                              <h2 class="mb-4;" style="color:white;text-align:center;">CVs Cargados</h2>
                              <br>
                              <section>
                    <div>
                         <table>
                              <thead>
                                   <th>CVs Subidos</th>
                                   <th>Ver</th>
                              </thead>
                              <tbody>
                              <?php
                                   if(isset($imageList))
                                   {
                                        foreach($imageList as $image)
                                        {
                                             ?>
                                                  <tr>
                                                  <td><?php echo $image->getName() ?></td> 
                                                  <td><a href="<?php echo FRONT_ROOT ?>Image/ShowImage/<?php echo $image->getImageId() ?>">Ver</a></td>
                                                  </tr>
                                             <?php
                                        }
                                   }
                              ?>
                              </tbody>
                         </table>
                    </div>
               </section>
     <?php
          }
     ?>
</main>
<?php
}
?>
<?php
    require_once("footer.php");
?>