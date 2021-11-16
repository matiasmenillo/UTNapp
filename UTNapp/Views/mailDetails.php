<?php
        require_once("nav-barStudent.php");
?>
<br>
<div style="margin:left;padding-left:10px">
               <form action="<?php echo FRONT_ROOT?> Mail/ShowMailListView" method="POST">
                    <button type="submit" class='btn'>Volver</button>
               </form>
               </div>
<h2 style="text-align:center;color:white; padding-bottom:10px;"><?php echo $_SESSION["loggedUser"]->GetEmail(); ?></h2>
    <div>
        <table style="text-align:left;">
            <thead>
            <tr>
                <th style="width: 80%;">Fecha: <?php echo $mail->getSentDate() ?></th>
            </tr>
            <tr>
                <th style="width: 80%;">Asunto: <?php echo $mail->getHeader()  ?></th>
            </tr>
            <tr>
                <th style="width: 80%;">De: <?php echo $mail->getCompany()->getCompanyLink() ?></th>
            </tr>
            <tr>
                <th style="width: 80%;"></th>
            </tr>

            </thead>
            <tbody>
                    <tr>
                        <td style="color:black;padding-top:30px;padding-bottom:30px"><?php echo $mail->getMessage()?></td>
                    </tr>
            </tbody>      
    </div>