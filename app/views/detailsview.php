<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./css/dish_style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="web/media/icons/favicon-96x96.png">


</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow rounded-2xl mt-3 max-w-4xl mx-auto absolute left-1/2 transform -translate-x-1/2 z-10">
        <div class="container px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="w-16 mr-5">
                    <a href="./index.php">
                        <img src="./web/media/icons/foodify_name_logo_white.png" alt="Foodify logo" class="w-full h-auto">
                    </a>
                </div>
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
                                    echo '<button class="nav-button text-sm" name="order" value="kitchen"><i class="fas fa-user-circle"></i> Acceso Cocina</button>';
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

    <!-- INTRODUCCIÓN -->
    <div class="bg-red-500 flex items-center justify-center h-96">
        <div class="text-center p-9 rounded-lg"><br><br><br>
            <h1 class="text-4xl font-bold text-white">¡Tu pedido está en camino!</h1>
            <p class="text-white mt-4">
                Hemos recibido tu pedido con éxito y nuestro equipo ya está preparando cada detalle con mucho cuidado.
                <br>
                En breve, estarás disfrutando de una experiencia deliciosa directamente en la puerta de tu casa.
            </p>
        </div>
    </div>

    <!-- DETALLES DEL PEDIDO -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detalles de tu pedido</h1>
            <span class="text-gray-500">
                <?= count($plates) ?> <?= count($plates) === 1 ? 'artículo' : 'artículos' ?>
            </span>
        </div>

        <!-- LISTA DE PLATOS -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 divide-y">
            <?php foreach ($plates as $plate): ?>
                <div class="flex items-center px-6 py-4">
                    <img class="w-16 h-16 object-cover rounded-full mr-4" src="<?= getClientImage($plate->id_dish) ?? 'rec/placeholder.jpg' ?>" alt="<?= htmlspecialchars($plate->name) ?>">
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($plate->name) ?></h3>
                        <p class="text-gray-600 text-sm"><?= number_format($plate->price, 2) ?>€ x <?= $orders->GetQuantity($plate->id_dish, $_GET['id']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- RESUMEN -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span><?= number_format($order->total_price, 2) ?>€</span>
            </div>
        </div>

        <!-- INFORMACIÓN DEL PEDIDO -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Información del Pedido</h2>
            <p class="text-gray-700"><strong>Dirección:</strong> <?= htmlspecialchars($order->delivery_address) ?></p>
            <p class="text-gray-700 mt-1"><strong>Estado del Pedido:</strong> <?= htmlspecialchars($order->status) ?></p>
        </div>

        <a href="index.php?order=order"
            class="text-red-500 hover:text-red-700 font-medium transition duration-200 ease-in-out transform hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
    </div>


    <!-- FOOTER -->
    <footer class="w-full bg-gray-200 text-white py-8 rounded-2xl">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors duration-300"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors duration-300"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-red-600 transition-colors duration-300"> <i class="fab fa-youtube fa-2x"></i> </a>
                    </div>

                    <div class="mt-5">
                        <img src="./web/media/icons/foodify_name_logo.jpeg" alt="">
                    </div>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Conócenos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Nuestra historia</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Equipo</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Trabaja con nosotros</a></li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Sostenibilidad</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Compromiso ecológico</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Envases sostenibles</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Huella de carbono</a></li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Ayuda</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Preguntas frecuentes</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Contacto</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Política de privacidad</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-400 mt-8 pt-8 text-center">
                <p class="text-gray-600">&copy; 2025 Foodify. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>

</html>