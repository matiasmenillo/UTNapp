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
        <h1 style="color: white"><a href="<?php echo FRONT_ROOT."Home/Home" ?>">Universidad Tecnológica Nacional</a></h1>
      </div>
      <!-- Add path routes below -->
      <nav id="mainav" class="fl_right">
        <ul class="clear">
            <li class="active"><a href="<?php echo FRONT_ROOT."Home/Index" ?>">CERRAR SESION</a></li>

            <li><a class="drop" href="#">Alumnos</a>
              <ul>
                <li><a href="#">Estado Academico</a></li>
                <li><a href="<?php echo FRONT_ROOT."Student/ShowStudentListView" ?>">Lista Alumnos</a></li>
                <li><a href="#">Historial de propuestas</a></li>
              </ul>
            </li>
                <li><a class="drop" href="#">Administrador</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Company/ShowAddView" ?>">Añadir Empresa</a></li>
                <li><a href="<?php echo FRONT_ROOT."Company/ShowCompanyListView" ?>">Gestionar Empresas</a></li>
                <li><a href="<?php echo FRONT_ROOT."Postulation/ShowPostulateView" ?>">Gestionar Ofertas Laborales</a></li>
                <li><a href="<?php echo FRONT_ROOT."Student/ShowStudentListView" ?>">Ver Estudiantes</a></li>
                <li><a href="<?php echo FRONT_ROOT."Student/ShowAddStudentView" ?>">Agregar Estudiante</a></li>
                <li><a href="<?php echo FRONT_ROOT."JobOffer/ShowAddView" ?>">Cargar propuesta</a></li>
                <li><a href="#">Ver propuestas</a></li>
              </ul>
            </li>
                

            
        </ul>
    </nav> 
    </header>
  </div>