<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema/');
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = 'Ingrese su usuario y su calve';
        } else {
            require_once "conexion.php";
            $user      = $_POST['usuario'];
            $pass      = $_POST['clave'];
            $sentencia = $conexion->prepare('select * from usuario where (usuario = ? and clave = ?)and estatus=1 ;');
            $sentencia->execute([$user, $pass]);
            $data = $sentencia->fetch(PDO::FETCH_BOTH);
            if ($data > 0) {
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['idusuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email']  = $data['email'];
                $_SESSION['user']   = $data['usuario'];
                $_SESSION['rol']    = $data['rol'];
                header('location: sistema/');
            } else {
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }}}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id="container">
		<form action="" method="post">
			<h3>Iniciar Sesión</h3>
			<img src="img/login.png" alt="Login">
			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input  class="btn btn-primary" type="submit" value="INGRESAR">
		</form>
	</section>
</body>
</html>