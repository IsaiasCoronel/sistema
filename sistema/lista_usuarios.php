<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de usuarios</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<h1>Lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>
		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		<?php
//Paginador
$sql_registe = $conexion->prepare('SELECT COUNT(*) as total_registro FROM usuario WHERE estatus = 1');
$sql_registe->execute();
$result_register = $sql_registe->fetch(PDO::FETCH_BOTH);
$total_registro  = $result_register['total_registro'];
echo $total_registro;
$por_pagina = 5;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];}
$desde         = ($pagina - 1) * $por_pagina;
$total_paginas = ceil($total_registro / $por_pagina);
$sql           = "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE estatus = 1
ORDER BY u.idusuario ASC LIMIT  $desde,$por_pagina";
$queryMostrar = $conexion->prepare($sql);
$queryMostrar->execute();
$resultadoListaRol = $queryMostrar->fetchAll(PDO::FETCH_ASSOC);
//mysqli_close($conection);

if ($resultadoListaRol > 0) {
    foreach ($resultadoListaRol as $resultadoLista) {
        ?>
				<tr>
				 <td><?php echo $resultadoLista['idusuario']; ?></td>
					<td><?php echo $resultadoLista['nombre']; ?></td>
					<td><?php echo $resultadoLista['correo']; ?></td>
					<td><?php echo $resultadoLista['usuario']; ?></td>
					<td><?php echo $resultadoLista['rol']; ?></td>
					<td>
						<a class="link_edit" href="editar_usuario.php?id=<?php echo $resultadoLista['idusuario']; ?>">Editar</a>
					<?php if ($resultadoLista['idusuario'] != 1) {?>
					<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $resultadoLista['idusuario']; ?>">Eliminar</a>
             		<?php }?>
					</td>
				</tr>
		<?php }}?>
		</table>
	<div class="paginador">
			<ul>
			<?php
if ($pagina != 1) {?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina - 1; ?>"><<</a></li>
			<?php }
for ($i = 1; $i <= $total_paginas; $i++) {
    # code...
    if ($i == $pagina) {
        echo '<li class="pageSelected">' . $i . '</li>';
    } else {
        echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';}}
if ($pagina != $total_paginas) {?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php }?>
			</ul>
		</div>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>