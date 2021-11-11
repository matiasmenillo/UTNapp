<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH . "style.css" ?>">    
</head>    
<body>    
    <h2>Iniciar sesion</h2><br>    
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
</div>    
</body>    
</html>
<?php
    require_once("footer.php");
?>