<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
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
<h2 style="text-align:center;color:white">Empresas Cargadas</h2>
<br>
    <form style="margin:auto" action="<?php echo FRONT_ROOT ?>Company/searchCompany" method="get">
        <div style="display:flex; flex-direction: row;">
            <label style="color:white;padding-right:10px;padding-left:10px;" for="txtNombreEmpresaFiltro">Filtrar por Nombre</label>
            <input type="text" name="txtNombreEmpresaFiltro" required>
            <button type="submit" style="color:black" >Buscar</button>
        </div>
    </form>

    <div style="padding-left:10px;">
    <form action="<?php echo FRONT_ROOT ?>Company/ShowCompanyListView" method="get">
            <button type="submit" style="color:black" >Limpiar Filtros</button>
    </form>
    </div>
    <br>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th style="width: 15%;">NOMBRE</th>
            <th style="width: 30%;">CUIT</th>
            <th style="width: 30%;">ABOUT US</th>
            <th style="width: 30%;">LINK</th>
            <th style="width: 30%;">DESCRIPCION</th>
            <th style="width: 30%;">SECTOR</th>
            <?php 
                if($rol == 'admin'){
            ?>
            <th style="width: 30%;">ESTADO</th>
            <th style="width: 30%;">ID</th>
            <th style="width: 30%;"></th>
            <th style="width: 30%;"></th>
            <?php
                }
            ?>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach($result as $company)
                {
                    if($rol == 'student'){

                        if($company->getStatus() == 1){

            ?>
                    <tr>
                    <td style="color:black"><?php echo $company->getName() ?></td>
                    <td style="color:black"><?php echo $company->getCuit() ?></td>
                    <td style="color:black"><?php echo $company->getAboutUs() ?></td>
                    <td style="color:black"><?php echo $company->getCompanyLink() ?></td>
                    <td style="color:black"><?php echo $company->getDescription() ?></td>
                    <td style="color:black"><?php echo $company->getSector() ?></td>
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
                            <td style="color:black"><?php echo $company->getAboutUs() ?></td>
                            <td style="color:black"><?php echo $company->getCompanyLink() ?></td>
                            <td style="color:black"><?php echo $company->getDescription() ?></td>
                            <td style="color:black"><?php echo $company->getSector() ?></td>
                            <td style="color:black"><?php echo $company->getStatus() ?></td>
                            <td style="color:black"><?php echo $company->getId() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Company/Remove" method="POST">
                                    <button type="submit" class="btn" name="remove" value="<?php echo $company->getId() ?>"> Remove </button>
                                </form>
                            </td>
                            <td style="color:black">
                                <form action="<?php echo FRONT_ROOT ?>Company/ShowModifView" method="POST">
                                    <input type="hidden" name="Cuit" value="<?php echo $company->getCuit() ?>">
                                    <input type="hidden" name="Id" value="<?php echo $company->getId() ?>">
                                    <input type="hidden" name="Name" value="<?php echo $company->getName() ?>">
                                    <input type="hidden" name="Status" value="<?php echo $company->getStatus() ?>">
                                    <input type="hidden" name="AboutUs" value="<?php echo $company->getAboutUs() ?>">
                                    <input type="hidden" name="CompanyLink" value="<?php echo $company->getCompanyLink() ?>">
                                    <input type="hidden" name="Descripcion" value="<?php echo $company->getDescription() ?>">
                                    <input type="hidden" name="Sector" value="<?php echo $company->getSector() ?>">
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