<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodify Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="web/css/admin_style.css" rel="stylesheet">
</head>

<body class="flex flex-col items-center min-h-screen">
  <nav class="bg-white  w-full px-12 py-4 mb-9 flex justify-between items-center">
    <div class="text-xl font-semibold text-gray-800"> <a href="./index.php">Foodify</a> </div>
    <div>
      <form action="" class="flex space-x-8">
      <button class="nav-button text-sm hover:text-custom-red" name="order" value="main">Pagina principal</button>
      <button class="nav-button text-sm hover:text-custom-red"> <i class="fas fa-shopping-cart"></i> Carrito</button>
      <button class="nav-button text-sm hover:text-custom-red"> <i class="fas fa-cog"></i> Ajustes</button>
      </form>
      
    </div>
  </nav>

  <h1 class="text-3xl font-bold text-custom-red mb-4 mt-1">Zona de administración</h1>

  <div class="bg-custom-red w-full py-8">
    <div class="max-w-screen-md mx-auto px-6">
      <p class="text-white text-center mb-6"> Bienvenido al panel de administración de Foodify. Desde aquí puedes gestionar usuarios, pedidos y platos.</p>

    <!-- BOTONES -->
      <form method="get" action="" class="flex space-x-4 justify-center">
        <button type="submit" name="order" value="usu" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs"> Usuarios</button>
        <button type="submit" name="order" value="order" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs">Pedidos</button>
        <button type="submit" name="order" value="dish" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs"> Platos </button>
      </form>
    </div>
  </div>

    <!-- PRESENTA LAS TABLAS -->
  <div id="admin-content" class="mt-8 p-6 w-full max-w-screen-lg mx-auto bg-white rounded-lg border-collapse border border-custom-red" >
    <?php
      if ($_GET["order"]=="usu" || $_GET["order"]=="order" || $_GET["order"]=="dish" ) {
        include "UltimateCrud.php";
      } else {
        echo "<p class='text-center text-gray-500'>Elija el campo que desea administrar.</p>";
      }
    ?>
  </div>

</body>
</html>