<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ../');
	}
 ?>
	<header>
		<div class="header">
			
			<h1>Visualizaciones</h1>
			<div class="optionsBar">
				<p>Guayas, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span>
				<img class="photouser" src="images/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="images/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>