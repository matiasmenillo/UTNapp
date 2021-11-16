<?php
        require_once("nav-barStudent.php");
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Home/Home" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<h2 style="text-align:center;color:white; padding-bottom:10px;"><?php echo $_SESSION["loggedUser"]->GetEmail(); ?></h2>
    <div>
        <table style="text-align:center;">
            <thead>
            <tr>
                <th style="width: 10%;">FECHA</th>
                <th style="width: 30%;">DE</th>
                <th style="width: 30%;">ASUNTO</th>
                <th style="width: 10%;"></th>
                <th style="width: 10%;"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($mailList as $mail)
                    {
                    ?>
                    <tr>
                        <td style="color:black"><?php echo $mail->getSentDate()?></td>
                        <td style="color:black"><?php echo $mail->getCompany()->getCompanyLink()?></td>
                        <td style="color:black"><?php echo $mail->getHeader()?></td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Mail/ViewMailDetails" method="POST">
                                <button type="submit" class="btn" name="View" value="<?php echo $mail->getMailId(); ?>"> Ver </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Mail/Delete" method="POST">
                                <button type="submit" class="btn" name="Delete" value="<?php echo $mail->getMailId(); ?>"> Borrar </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
            </tbody>        
    </div>