<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div id="navbar" class="navbar-collapse">
            	<ul class="breadcrumb">
        			<li class="breadcrumb-home">
						<a href="./">
							<i class="fa fa-home"></i>
						</a>
					</li>
        		</ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                    	<a href="../logout.php">
                        	Salir <i class="fa fa-sign-out"></i> 
                        </a>
                    </li>
                    <li class="profile">
                        <a href="perfil.php">
                            <img alt="<?php echo $_SESSION['nombre'];?>" src="images/avatar.jpg" class="img-circle">
                            <div class="vcentered">
	                            <p class="profile-name"><?php echo $_SESSION['nombre'];?></p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>