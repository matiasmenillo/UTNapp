<div class="bgded overlay" style="background-image:url('<?php echo IMG_PATH; ?>fondo.jpg');"> 
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear">  
    <ul class="nospace">
          <li><i class="fa fa-map-marker" aria-hidden="true"></i></i> Mar del Plata</li>
        </ul>
    </div>
  </div>

  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="#">Universidad Tecnológica Nacional</a></h1>
      </div>
      <!-- Add path routes below -->
      <nav id="mainav" class="fl_right">
        <ul class="clear">
            <li class="active"><a href="<?php echo FRONT_ROOT ?>">CERRAR SESION</a></li>

            <li><a class="drop" href="#">Alumnos</a>
              <ul>
                <li><a href="#">Estado Academico</a></li>
                <li><a href="<?php echo FRONT_ROOT."Student/ShowStudentListView" ?>">Lista Alumnos</a></li>
                <li><a href="<?php echo FRONT_ROOT."Company/ShowCompanyListView" ?>">Lista de Empresas</a></li>
                <li><a href="#">Aplicar a propuesta</a></li>
                <li><a href="#">Historial de propuestas</a></li>
              </ul>
            </li>
        </ul>
    </nav> 
    </header>
  </div>