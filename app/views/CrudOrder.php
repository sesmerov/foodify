<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Este es el crud de pedidos</h1>

    <table>
    <th>ID</th>
    <th>fecha de creacion</th>
    <th>precio total</th>
    <th>direccion de entrega</th>
    <th>status</th>
    <th>id del usuario</th>
    <?php foreach ($orders as $ord) { ?>
    <tr>
        <td><?php echo $ord->id_order; ?></td>
        <td><?php echo $ord->order_date; ?></td>
        <td><?php echo $ord->total_price; ?></td>
        <td><?php echo $ord->delivery_address; ?></td>
        <td><?php echo $ord->status; ?></td>
        <td><a href="index.php?order=details&id=<?=$ord->id_order?>">detalles</a></td>
        <td><a href="index.php?order=delete&id=<?=$ord->id_order?>">borrar</a></td>
        <td><a href="index.php?order=mod&id=<?=$ord->id_order?>">modificar</a></td>
    </tr>
<?php } ?>
    
</table>
<form method="get" action="index.php">
    <input type="hidden" name="order" value="order">
    <input type="hidden" name="type" value ="order">
    <button type="submit" name="nav" value="Begin"> << </button>
    <button type="submit" name="nav" value="Before"> < </button>
    <button type="submit" name="nav" value="Next"> > </button>
    <button type="submit" name="nav" value="Last"> >> </button>
</form>

</body>
</html>