<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])
        || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $idUsuario = $_POST['idUsuario'];
        $nombre    = $_POST['nombre'];
        $email     = $_POST['correo'];
        $user      = $_POST['usuario'];
        $clave     = $_POST['clave'];
        $rol       = $_POST['rol'];

        if (empty($_POST['clave'])) {
            $sql_update = $conexion->prepare("UPDATE usuario SET nombre = ?, correo=?,usuario=?,rol=? WHERE idusuario= ? ");
            $sql_update->execute([$nombre, $email, $user, $rol, $idUsuario]);
        } else {
            $sql_update = $conexion->prepare("UPDATE usuario SET nombre = ?, correo=?,usuario=?,clave=?, rol=?
 WHERE idusuario= ? ;");
            $sql_update->execute([$nombre, $email, $user, $clave, $rol, $idUsuario]);
        }
        if ($sql_update) {
            $alert = '<p class="msg_save">Usuario actualizado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al actualizar el usuario.</p>';
            //header('Location: lista_usuarios.php');
        } //    }
    }}

if (empty($_REQUEST['id'])) {
    header('Location: lista_usuarios.php');
    //mysqli_close($conection);
}
$iduser = $_REQUEST['id'];
$sql    = $conexion->prepare("SELECT u.idusuario, u.nombre,u.correo,u.usuario,u.clave, (u.rol) as
 idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario= ? ;");
$sql->execute([$iduser]);
$result_sql = $sql->fetchAll(PDO::FETCH_ASSOC);
if ($result_sql == 0) {
    header('Location: lista_usuarios.php');
} else {
    $option = '';
    foreach ($result_sql as $data) {
        # code...
        $iduser  = $data['idusuario'];
        $nombre  = $data['nombre'];
        $correo  = $data['correo'];
        $usuario = $data['usuario'];
        $clave   = $data['clave'];
        $idrol   = $data['idrol'];
        $rol     = $data['rol'];
        if ($idrol == 1) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        } else if ($idrol == 2) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        } else if ($idrol == 3) {
            $option = '<option value="' . $idrol . '" select>' . $rol . '</option>';
        }}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizar usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="post">
				<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
				<label for="clave">Clave</label>
				<input type="text" name="clave" id="clave" placeholder="Clave de acceso"  value="<?php echo $clave; ?>" >
				<label for="rol">Tipo Usuario</label>
 				<?php
$query_rol = $conexion->prepare("SELECT * FROM rol;");
$query_rol->execute();
$result_rol = $query_rol->fetchAll(PDO::FETCH_ASSOC);
?>
				<select name="rol" id="rol" class="notItemOne">
					<?php
echo $option;
if ($result_rol > 0) {

    foreach ($result_rol as $rol) {
        ?>
							<option value="<?php echo $rol['idrol']; ?>">
								<?php echo $rol["rol"] ?></option>
					<?php
# code...
    }}
?>
				</select>
				<input type="submit" value="Actualizar usuario" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>