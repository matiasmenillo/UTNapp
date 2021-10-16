<?php
    require_once("navAdmin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
</head>
<body>
    <h2>Empresas Cargadas</h2>

    <?php foreach($companyList as $company){ ?>
        <div>
                <?echo $company->getName() . $company->getCuit()?>
        </div>
    <?php }?>
</body>
</html>