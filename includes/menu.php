<div class="navigation">
    <a class="navbar-brand">
        <img alt="" class="logo vcentered" src="images/logo.png">
    </a>
	<?php
	if ($_SESSION['nivel']==1)
	{
	?>
    <ul class="nav primary">
        <li>
            <a href="./">
                <i class="fa fa-home"></i>
                <span>Inicio</span>
            </a>
        </li>
		<li class="nav-item-expandable">
            <a href="#catalogos" data-toggle="collapse" aria-expanded="false"> 
                <i class="fa fa-newspaper-o"></i>
                <span> Catálogos </span>
                <span class="nav-item-icon"> <i class="fa fa-chevron-down"></i> </span>
            </a>
            <ul id="catalogos" class="nav nav-item collapse">
                <li>
                    <a href="equipos.php">
                        <i class="fa fa-list-ul"></i>
                        <span>Equipos</span>
                    </a>
                </li>
                <li>
					<a href="usuarios.php">
						<i class="fa fa-users"></i>
						<span>Usuarios</span>
					</a>
				</li>
				<li>
					<a href="criterios.php">
						<i class="fa fa-check"></i>
						<span>Criterios de evaluación</span>
					</a>
				</li>
				<li>
					<a href="clasificacion.php">
						<i class="fa fa-list-ol"></i>
						<span>Clasificación</span>
					</a>
				</li>
            </ul>
        </li>
        <li class="nav-item-expandable">
            <a href="#evaluacion" data-toggle="collapse" aria-expanded="false"> 
                <i class="fa fa-newspaper-o"></i>
                <span> Evaluación </span>
                <span class="nav-item-icon"> <i class="fa fa-chevron-down"></i> </span>
            </a>
            <ul id="evaluacion" class="nav nav-item collapse">
                <li>
                    <a href="ideas.php">
                        <i class="fa fa-lightbulb-o"></i>
                        <span>Ideas</span>
                    </a>
                </li>
				<li>
					<a href="reporte.php">
						<i class="fa fa-print"></i>
						<span>Reportes</span>
					</a>
				</li>
            </ul>
        </li>
    </ul>
	<?php
	}
	//Promotor
	if ($_SESSION['nivel']==2)
	{
	?>
    <ul class="nav primary">
        <li>
            <a href="./">
                <i class="fa fa-home"></i>
                <span>Inicio</span>
            </a>
        </li>
		<li>
			<a href="usuarios.php">
				<i class="fa fa-users"></i>
				<span>Usuarios</span>
			</a>
		</li>
		<li>
            <a href="ideas.php">
                <i class="fa fa-lightbulb-o"></i>
                <span>Ideas</span>
            </a>
        </li>
    </ul>
	<?php
	}
	//Generador 
	if ($_SESSION['nivel']==3)
	{
	?>
    <ul class="nav primary">
        <li>
            <a href="./">
                <i class="fa fa-home"></i>
                <span>Inicio</span>
            </a>
        </li>
		<li>
            <a href="ideas.php">
                <i class="fa fa-lightbulb-o"></i>
                <span>Ideas</span>
            </a>
        </li>
    </ul>
	<?php
	}
	?>
    <div class="time text-center">
        <h5 class="current-time2">&nbsp;</h5>
        <h5 class="current-time">&nbsp;</h5>
    </div>
  </div>