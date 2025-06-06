<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foodify Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="web/css/admin_style.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="./web/media/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./web/media/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./web/media/icons/favicon-16x16.png">
</head>

<body class="flex flex-col items-center min-h-screen">
  <nav class="bg-white shadow rounded-2xl mt-3 max-w-4xl mx-auto absolute left-1/2 transform -translate-x-1/2 z-10">
    <div class="container px-6 py-3">
      <div class="flex justify-between items-center">
        <div class="text-lg font-semibold text-gray-800 mr-12"> <a href="./index.php">Foodify</a> </div>
        <div>
          <form action="" class="flex space-x-5">
            <?php
            if ($_SESSION['userLogged'] != null) {
              switch ($_SESSION['userLogged']->role) {
                case 'ADMIN':
                  echo '<button class="nav-button text-sm" name="order" value="admin"><i class="fas fa-user-circle"></i> Acceso Administrador</button>';
                  break;
                case 'CLIENTE':
                  echo '<button class="nav-button text-sm" name="order" value="profile"><i class="fas fa-user-circle"></i> Tu Perfil</button>';
                  break;
                case 'COCINERO':
                  echo '<button class="nav-button text-sm" name="order" value="kitchen"><i class="fas fa-user-circle"></i>Acceso Cocina</button>';
                  break;
                default:
                  # code...
                  break;
              }
            } else {
              echo '<button class="nav-button text-sm" name="order" value="login">Iniciar Sesión</button>';
              echo '<button class="nav-button text-sm" name="order" value="register">Registrate</button>';
            }
            ?>
            <button class="nav-button text-sm" name="order" value="cart"><i class="fas fa-shopping-cart"></i> Carrito</button>
            <?php
            if ($_SESSION['userLogged'] != null) {
              echo ' <button class="nav-button text-sm" name="order" value="logout"><i class="fas fa-sign-out-alt"></i> Salir</button>';
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <br>
  <h1 class="text-3xl font-bold text-custom-red mb-4 mt-1">Zona de administración</h1>

  <div class="bg-custom-red w-full py-8">
    <div class="max-w-screen-md mx-auto px-6">

      <?php if ($_SESSION['userLogged']->role == 'ADMIN') : ?>
        <h2 class="text-2xl font-bold  mb-4 text-center">¡Hola, <?php echo $_SESSION['userLogged']->first_name; ?>!</h2>
        <p class="text-white text-center mb-6 text-center"> Bienvenido al panel de administración de Foodify. Desde aquí puedes gestionar usuarios, pedidos y platos.</p>
        <br>
      <?php else: ?>
        <h2 class="text-2xl font-bold mb-4 text-center">¡Hola, <?php echo $_SESSION['userLogged']->first_name; ?>!</h2>
        <p class="text-white text-center mb-6 text-center">Bienvenido a la cocina aqui puedes gestionar los pedidos de la Cocina</p>
        <br>
      <?php endif; ?>

      <!-- BOTONES -->
      <form method="get" action="" class="flex space-x-4 justify-center">
        <?php if ($_SESSION['userLogged'] && $_SESSION['userLogged']->role == 'ADMIN') : ?>
          <button type="submit" name="order" value="usu" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs">Usuarios</button>
          <button type="submit" name="order" value="dish" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs">Platos</button>
          <button type="submit" name="order" value="adddish" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs">Añadir un plato</button>
        <?php endif; ?>
        <button type="submit" name="order" value="order" class="border-2 border-white text-white py-2 px-4 rounded-lg hover:bg-white hover:text-custom-red hover:scale-105 transition-transform duration-300 w-1/3 max-w-xs">Pedidos</button>

        <!-- BOTÓN VISIBLE PARA TODOS -->
      </form>
    </div>
  </div>

  <!-- PRESENTA LAS TABLAS -->
  <div id="admin-content" class="mt-8 p-6 w-full max-w-screen-lg mx-auto bg-white rounded-lg border-collapse border border-custom-red">
    <?php
    if ($_GET["order"] == "usu" || $_GET["order"] == "order" || $_GET["order"] == "dish") {
      include "UltimateCrud.php";
    } else {
      echo "<p class='text-center text-gray-500'>Elija el campo que desea administrar.</p>";
    }
    ?>
  </div>

</body>

</html>