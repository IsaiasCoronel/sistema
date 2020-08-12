<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $nombre = $_POST['nombre'];
        $email  = $_POST['correo'];
        $user   = $_POST['usuario'];
        $clave  = $_POST['clave'];
        $rol    = $_POST['rol'];
        $query  = $conexion->prepare('select * from usuario where (usuario = ? OR correo = ?)and estatus=1 ;');
        $query->execute([$user, $email]);
        $data = $query->fetch(PDO::FETCH_BOTH);
        if ($data > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {
            $query_insert = $conexion->prepare("INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES (?,?,?,?,?);");
            $resultado    = $query_insert->execute([$nombre, $email, $user, $clave, $rol]);
            if ($resultado) {
                $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el usuario.</p>';
            }}}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro Usuario</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
			<h1>Registro usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="rol">Tipo Usuario</label>
			<?php
$query_rol = $conexion->prepare('select * from rol;');
$query_rol->execute();
$resultado_rol = $query_rol->fetchAll(PDO::FETCH_OBJ);
?>
	<select name="rol" id="rol">
<?php
if ($query_rol->rowCount() > 0) {
    foreach ($resultado_rol as $resultado) {
        ?>
<option value="<?php echo $resultado->idrol; ?>">
	<?php echo $resultado->rol; ?>
	</option>
<?php
}}?>
</select>
	<input type="submit" value="Crear usuario" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php";?>

</body>
</html>