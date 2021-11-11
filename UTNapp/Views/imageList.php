<?php
if(isset($_SESSION['loggedUser'])){

    if($_SESSION['loggedUser']->getAdmin() == 0){
          require_once('nav-barStudent.php');
          $student = $_SESSION['loggedUser'];
     }
} else
     header("location: ".FRONT_ROOT."Home/index");
?>
<br>
<main>
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
                                            <td><a href="<?php echo FRONT_ROOT ?>Image/ShowImage/<?php echo $image->getIdStudent() ?>">Ver</a></td>
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

</main>