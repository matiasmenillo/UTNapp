<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getRol() == "admin")
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
    else
    {
        $rol = 'student';
        require_once("nav-barStudent.php");
    }
?>
<br>
<h2 style="text-align:center;">Empresas Cargadas</h2>

    <form action="<?php echo FRONT_ROOT ?>Company/searchCompany" method="get">
        <div style="display:flex; flex-direction: row;">
            <label for="txtNombreEmpresaFiltro" style="color:white">Filtrar por Nombre</label>
            <input type="text" name="txtNombreEmpresaFiltro" style="color:black" required>
            <button type="submit" style="color:black" >Buscar</button>
        </div>
    </form>

    <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyListView" method="get">
            <button type="submit" style="color:black" >Limpiar Filtros</button>
    </form>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 15%;">NOMBRE</th>
            <th style="width: 30%;">CUIT</th>
            <?php 
                if($rol == 'admin'){
            ?>
            <th style="width: 30%;">ESTADO</th>
            <?php
                }
            ?>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($companyList as $company)
                {
                    if($rol == 'student'){

                        if($company->getStatus() == 'active'){

            ?>
                    <tr>
                    <td style="color:black"><?php echo $company->getName() ?></td>
                    <td style="color:black"><?php echo $company->getCuit() ?></td>
            <?php
            
                }
            }
            ?>
            
                    <?php
                        if ($rol == 'admin')
                        {         
                    ?>
                            <td style="color:black"><?php echo $company->getName() ?></td>
                            <td style="color:black"><?php echo $company->getCuit() ?></td>
                            <td style="color:black"><?php echo $company->getStatus() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo $company->getCuit() ?>"> Remove </button>
                                </form>
                            </td>
                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>Company/ShowModifView" method="POST">
                                    <input type="hidden" name="Cuit" value="<?php echo $company->getCuit() ?>">
                                    <input type="hidden" name="Name" value="<?php echo $company->getName() ?>">
                                    <button type="submit" class="btn" name="modify"> Modify </button>
                                </form>

                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
               }
               
                ?>
        </tbody>        