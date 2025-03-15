<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola este es el crud de platos</h1>


    <table>
    <th>ID</th>
    <th>fecha de creacion</th>
    <th>precio total</th>
    <th>direccion de entrega</th>
    <th>status</th>
    <th>id del usuario</th>
    <?php foreach ($dishes as $dish) { ?>
    <tr>
        <td><?php echo $dish->id_dish; ?></td>
        <td><?php echo $dish->name; ?></td>
        <td><?php echo $dish->price; ?></td>
        <td><?php echo $dish->type; ?></td>
        <td><?php echo $dish->details; ?></td> 
        <td><a href="index.php?order=details&id=<?=$dish->id_dish?>">detalles</a></td>
        <td><a href="index.php?order=delete&id=<?=$dish->id_dish?>">borrar</a></td>
        <td><a href="index.php?order=mod&id=<?=$dish->id_dish?>">modificar</a></td>
    </tr>
<?php } ?>
    
</table>
<form method="get" action="index.php">
    <input type="hidden" name="order" value="dish">
    <input type="hidden" name="type" value ="dish">
    <button type="submit" name="nav" value="Begin"> << </button>
    <button type="submit" name="nav" value="Before"> < </button>
    <button type="submit" name="nav" value="Next"> > </button>
    <button type="submit" name="nav" value="Last"> >> </button>
</form>

</body>
</html>