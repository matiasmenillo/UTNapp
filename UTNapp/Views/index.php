<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "style.css" ?>">    
</head>    
<body>    
    <h2>Iniciar sesión</h2><br>    
    <div class="login">    
    <form action="<?php echo FRONT_ROOT?>Login/Login" method="POST" > 
        <label><b>E-Mail   
        </b><br>  
        </label>    
        <input type="text" name="user_email" placeholder="Email" required>    
        <br><br>    
        <label><b>Contraseña   
        </b>    
        </label> 
        <br>   
        <input type="password" name="user_password" placeholder="Contraseña" required>    
        <br><br>    
        <button type="submit" style="color:black">Ingresar</button>      
        <br><br>    

    </form> 
    <form action="<?php echo FRONT_ROOT?>User/AddUserView" method="POST" > 
        <button type="submit" style="color:black">Registrarse</button>   
    </form>   
</div>    
</body>    
</html>
<?php
    require_once("footer.php");
?>