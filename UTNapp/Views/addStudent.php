<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
?>
</head> 
<body>
    <br>
<h2 style="text-align:center; color:white">Cargar estudiante</h2>
    <form action="<?php echo FRONT_ROOT ?> Student/Add" method="POST">

        <label for="user_firstName" style="color:White;text-align:center">Nombre</label>
        <input style="margin:auto" type="text" name="user_firstName" style="color:black" required>

        <label for="user_lastName" style="color:White;text-align:center">Apellido</label>
        <input style="margin:auto" type="text" name="user_lastName" style="color:black" required>

        <label for="user_email" style="color:White;text-align:center">Email</label>
        <input style="margin:auto" type="text" name="user_email" style="color:black" required>

        <label for="user_dni" style="color:White;text-align:center">Dni</label>
        <input style="margin:auto" type="text" name="user_dni" style="color:black" required>

        <label for="user_Gender" style="color:White;text-align:center">Sexo</label>
        <input style="margin:auto" type="text" name="user_Gender" style="color:black" required>

        <label for="user_BirthDate" style="color:White;text-align:center">Fecha de Nacimiento</label>
        <input style="margin:auto" type="date" name="user_BirthDate" style="color:black" required>

        <label for="user_PhoneNumber" style="color:White;text-align:center">Nro. Telefono</label>
        <input style="margin:auto" type="text" name="user_PhoneNumber" style="color:black" required>

        <label for="user_FileNumber" style="color:White;text-align:center">Nro. Legajo</label>
        <input style="margin:auto" type="text" name="user_FileNumber" style="color:black" required>

        <label for="user_CareerId" style="color:White;text-align:center">Seleccione una Carrera</label>
        <select style="margin:auto" name="user_CareerId" style="color:black" required>
        <?php
            foreach($careerList as $career)
            {
                echo "<option value='".$career->getCareerId()."'>".$career->getDescription()."</option>";
            }
        ?>
        </select>

        <label for="user_rol" style="color:White;text-align:center">Seleccione un rol</label>
        <select style="margin:auto" name="user_rol" style="color:black" required>
            <option value="1">Administrador</option>
            <option value="0">Estudiante</option>
        </select>

        <label for="user_Active" style="color:White;text-align:center">Seleccione un Estado</label>
        <select style="margin:auto" name="user_Active" style="color:black" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        
        <label for="user_password" style="color:White;text-align:center">Contraseña</label>
        <input style="margin:auto" type="password" name="user_password" style="color:black" required>

        <br>

        <button style="margin:auto" type="submit" style="color:White;text-align:center">Agregar</button>
    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>