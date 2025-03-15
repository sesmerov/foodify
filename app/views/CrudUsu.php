
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>este es el crud usuarios</h1>
<table>
    <th>ID</th>
    <th>Nombre</th>
    <th>Contraseña</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Direccion</th>
    <th>Rol</th>
    <?php foreach ($users as $usu) { ?>
    <tr>
        <td><?php echo $usu->id_user; ?></td>
        <td><?php echo $usu->first_name; ?></td>
        <td><?php echo $usu->password; ?></td>
        <td><?php echo $usu->last_name; ?></td>
        <td><?php echo $usu->email; ?></td>
        <td><?php echo $usu->address; ?></td>
        <td><?php echo $usu->role; ?></td> 
        <td><a href="index.php?order=details&id=<?=$usu->id_user?>">detalles</a></td>
        <td><a href="index.php?order=delete&id=<?=$usu->id_user?>">borrar</a></td>
        <td><a href="index.php?order=mod&id=<?=$usu->id_user?>">modificar</a></td>
    </tr>
<?php } ?>
    
</table>
<form method="get" action="index.php">
    <input type="hidden" name="order" value="usu">
    <input type="hidden" name="type" value ="usu">
    <button type="submit" name="nav" value="Begin"> << </button>
    <button type="submit" name="nav" value="Before"> < </button>
    <button type="submit" name="nav" value="Next"> > </button>
    <button type="submit" name="nav" value="Last"> >> </button>
</form>


</body>
</html>