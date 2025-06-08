<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="web/css/dish_style.css" rel="stylesheet">
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
    <div class="hero flex items-center justify-center h-96">
        <div class="text-center p-9 rounded-lg w-full max-w-screen-xl mx-auto">
            <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto">
                <br><br><br>
                <h1 class="text-3xl sm:text-4xl font-bold">Disfruta de la comida que te mereces</h1>
                <p class="text-white mt-4 text-base sm:text-lg">
                    En Foodify, nos apasiona ofrecerte platos deliciosos y saludables, preparados con ingredientes frescos y de la más alta calidad.
                </p>
                <?php if ($_SESSION['userLogged'] == null): ?>
                    <a href="index.php?order=login">
                        <button class="hero-button mt-4">Iniciar sesión</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto bg-white rounded-3xl flex flex-col md:flex-row overflow-hidden shadow-lg mt-10">

        <div class="md:w-1/2">
            <img src=<?= getClientImage($dish->id_dish) ?> alt="<?= htmlspecialchars($dish->name) ?>" class="w-full h-full object-cover">
        </div>
        <div class="md:w-1/2 p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-5xl font-bold text-gray-800 mb-2"><?= $dish->name ?></h2>
                <br>
                <?php if (count($allergens)): ?>
                    <?php foreach ($allergens as $allergen): ?>
                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded-full text-sm">
                            <?= " " . strtoupper(htmlspecialchars($allergen)) . " " ?>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-sm">
                        LIBRE DE ALÉRGENOS
                    </span>
                <?php endif; ?>
                <br>
                <br>
                <p class="text-sm text-gray-500 mb-2"><?= $dish->type ?></p>
                <div class="flex space-x-2 text-xl text-pink-500 mb-4">
                </div>
                <p class="text-sm text-gray-700 leading-relaxed">
                    <?= $dish->details ?> </p>
            </div>
            <div class="flex flex-col items-center space-y-4 mt-6">
                <span class="text-5xl font-bold text-gray-800"><?= $dish->price ?>€</span>
                <form method="GET" action="index.php?">
                    <input type="hidden" name="order" value="addToCart">
                    <input type="hidden" name="id_dish" value="<?= $dish->id_dish ?>">
                    <button
                        type="submit"
                        class="bg-red-600 text-white font-semibold text-xl py-4 px-8 rounded-lg hover:bg-red-700 transition-colors duration-300">
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    </div>
    <br><br>

    <!-- FOOTER -->
    <footer class="w-full bg-gray-200 text-white py-8 rounded-2xl">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors duration-300"><i
                                class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300"><i
                                class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors duration-300"><i
                                class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-red-600 transition-colors duration-300"> <i
                                class="fab fa-youtube fa-2x"></i> </a>
                    </div>

                    <div class="mt-5">
                        <img src="./web/media/icons/foodify_name_logo.jpeg" alt="">
                    </div>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Conócenos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Nuestra
                                historia</a></li>
                        <li><a href="#"
                                class="text-gray-600 hover:text-red-400 transition-colors duration-300">Equipo</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Trabaja
                                con nosotros</a></li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Sostenibilidad</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-600 hover:text-red-400 transition-colors duration-300">Compromiso
                                ecológico</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Envases
                                sostenibles</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Huella
                                de carbono</a></li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Ayuda</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-600 hover:text-red-400 transition-colors duration-300">Preguntas
                                frecuentes</a></li>
                        <li><a href="#"
                                class="text-gray-600 hover:text-red-400 transition-colors duration-300">Contacto</a>
                        </li>
                        <li><a href="#" class="text-gray-600 hover:text-red-400 transition-colors duration-300">Política
                                de privacidad</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-400 mt-8 pt-8 text-center">
                <p class="text-gray-600">&copy; 2025 Foodify. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script src="./js/script_dishes.js"></script>
</body>

</html>