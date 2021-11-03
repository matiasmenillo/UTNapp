<?php

    if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getAdmin() == 1)
    {
        $rol = 'admin';
        require_once("nav-barAdmin.php");
    }
?>
</head>    $careerList
<body>
    <h2>Cargar Estudiante</h2>
    <form action="<?php echo FRONT_ROOT ?> Student/Add" method="POST">

        <label for="user_firstName" style="color:White">Nombre</label>
        <input type="text" name="user_firstName" style="color:black" required>

        <label for="user_lastName" style="color:White">Apellido</label>
        <input type="text" name="user_lastName" style="color:black" required>

        <label for="user_email" style="color:White">Email</label>
        <input type="text" name="user_email" style="color:black" required>

        <label for="user_dni" style="color:White">Dni</label>
        <input type="text" name="user_dni" style="color:black" required>

        <label for="user_Gender" style="color:White">Sexo</label>
        <input type="text" name="user_Gender" style="color:black" required>

        <label for="user_BirthDate" style="color:White">Fecha de Nacimiento</label>
        <input type="date" name="user_BirthDate" style="color:black" required>

        <label for="user_PhoneNumber" style="color:White">Nro. Telefono</label>
        <input type="text" name="user_PhoneNumber" style="color:black" required>

        <label for="user_FileNumber" style="color:White">Nro. Legajo</label>
        <input type="text" name="user_FileNumber" style="color:black" required>

        <label for="user_CareerId" style="color:White">Seleccione una Carrera</label>
        <select name="user_CareerId" style="color:black" required>
        <?php
            foreach($careerList as $career)
            {
                echo "<option value='".$career->getCareerId()."'>".$career->getDescription()."</option>";
            }
        ?>
        </select>

        <label for="user_rol" style="color:White">Seleccione un rol</label>
        <select name="user_rol" style="color:black" required>
            <option value="1">Administrador</option>
            <option value="0">Estudiante</option>
        </select>

        <label for="user_Active" style="color:White">Seleccione un Estado</label>
        <select name="user_Active" style="color:black" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        
        <label for="user_password" style="color:White">Contraseña</label>
        <input type="password" name="user_password" style="color:black" required>

        <br>

        <button type="submit" style="color:black">Agregar</button>
    </form>
</body>
</html>

<?php
    require_once("footer.php");
?>