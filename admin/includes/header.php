<?php include('ajax-save/carrito.php'); ?>
<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div id="navbar" class="navbar-collapse">
            	<ul class="breadcrumb">
        			<li class="breadcrumb-home">
						<a href="./">
							<i class="fa fa-home"></i>
						</a>
					</li>
                    <li>
                        Puntos otorgados: <span id="puntos"><?php echo $_SESSION['puntos']; ?></span>
                    </li>
        		</ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                    <?php if(!empty($_SESSION['carrito'])){ ?>
                        <a href="carrito-de-canje.php" class="bg-warning" style="border-radius: 40px;width: 55px;height: 55px;margin-top: 2px;">
                            <span class="fas fa-shopping-cart" style="margin-left: 12px;"></span><span class="" style="font-size:15px;position:absolute;"> <?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']); ?></span>
                        </a>
                    <?php }else{ } ?>
                    </li>
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