<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="web/css/admin_style.css" rel="stylesheet">
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
    <div class="bg-red-500 mb-9 flex items-center justify-center h-96">
        <div class="text-center p-9 rounded-lg w-full max-w-screen-xl mx-auto">
            <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto">
                <br><br><br>
                <h1 class="text-3xl sm:text-4xl font-bold text-white">Disfruta de la comida que te mereces</h1>
                <p class="text-white mt-4 text-base sm:text-lg">
                    En Foodify, nos apasiona ofrecerte platos deliciosos y saludables, preparados con ingredientes frescos y de la más alta calidad.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Comidas</h2>

            <!-- FORMULARIO DE FILTROS -->
            <form method="GET" action="index.php?all-dishes" class="flex space-x-2 relative z-50">
                <input type="search" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md w-60" name="searcher" id="searcher" placeholder="Buscar...">
                <!-- Fix para que se envie all-dishes y allergen[] al hacer submit -->
                <input type="hidden" name="all-dishes">
                <input type="hidden" name="allergen[]">


                <!-- Botón de Tipo de Comida -->
                <div class="relative">
                    <button
                        id="tipo-comida-btn"
                        type="button"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md w-60">
                        Tipo de Comida
                    </button>
                    <div
                        id="tipo-comida-menu"
                        class="absolute bg-white shadow-md rounded-md mt-2 w-60 p-4 hidden right-0 z-50 transition-all duration-300 transform opacity-0 scale-95 origin-top-right">
                        <?php foreach ($types as $type): ?>
                            <label class="block mb-2">
                                <input type="checkbox" name="type[]" value="<?= $type ?>" class="mr-2" checked>
                                <?= ucfirst(strtolower($type)) ?>
                            </label>
                        <?php endforeach; ?>
                        <button type="button" onclick="toggleAllCheckboxes('type[]',this)" class="bg-gray-300 text-gray-800 px-2 py-1 rounded-md w-full mb-2">
                            Deseleccionar todo
                        </button>
                        <button
                            id="close-tipo-comida"
                            type="button"
                            class="bg-red-500 text-white px-4 py-2 rounded-md w-full mt-3">
                            Listo!
                        </button>
                    </div>
                </div>

                <!-- Botón de Alérgenos -->
                <div class="relative">
                    <button
                        id="alergenos-btn"
                        type="button"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md w-60">
                        Alérgenos
                    </button>
                    <div
                        id="alergenos-menu"
                        class="absolute bg-white shadow-md rounded-md mt-2 w-60 p-4 hidden right-0 z-50 transition-all duration-300 transform opacity-0 scale-95 origin-top-right">
                        <?php foreach ($allergens as $allergen): ?>
                            <label class="block mb-2">
                                <input type="checkbox" name="allergen[]" value="<?= $allergen ?>" class="mr-2">
                                <?= $allergen ?>
                            </label>
                        <?php endforeach; ?>
                        <button type="button" onclick="toggleAllCheckboxes('allergen[]',this)" class="bg-gray-300 text-gray-800 px-2 py-1 rounded-md w-full mb-2">
                            Seleccionar todo
                        </button>
                        <button
                            id="close-alergenos"
                            type="button"
                            class="bg-red-500 text-white px-4 py-2 rounded-md w-full mt-3">
                            Listo!
                        </button>
                    </div>
                </div>

                <!-- Botón Buscar -->
                <div class="relative">
                    <button
                        type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-md w-60 ">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <p class="text-gray-600 mt-4">Raciones de 420 a 500 gr pensadas como plato único.</p>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-9 mt-4">
            <?php foreach ($dishes as $dish): ?>
                <div class="bg-white shadow-md rounded-lg relative pb-6">
                    <div class="relative">
                        <img
                            src="<?= getClientImage($dish->id_dish) ?>"
                            alt="<?= htmlspecialchars($dish->name) ?>"
                            class="rounded-lg w-full">
                        <span class="absolute bottom-2 left-2 bg-black text-white px-3 py-1 rounded-md text-sm">
                            <?= $dish->price ?> €
                        </span>
                    </div>
                    <p class="mx-4 pt-6 font-semibold text-center"><?= htmlspecialchars($dish->name) ?></p>

                    <div class="flex items-center justify-center mt-6 space-x-4">
                        <!-- Botón Añadir al carrito -->
                        <form method="GET" action="index.php?">
                            <input type="hidden" name="order" value="addToCartAllDishes">
                            <input type="hidden" name="id_dish" value="<?= $dish->id_dish ?>">
                            <button
                                type="submit"
                                class="bg-red-600 text-white font-semibold text-lg py-2 px-5 rounded-full hover:bg-red-700 transition-colors duration-300">
                                Añadir

                            </button>
                        </form>
                        <!-- Botón Detalles -->
                        <a
                            href="index.php?dish&id=<?= $dish->id_dish ?>"
                            class="bg-white text-red-600 font-semibold py-2 px-4 rounded-lg hover:bg-red-50 transition-colors duration-300">
                            Detalles
                        </a>
                    </div>
                    <!--div de cantidad añadida-->
                    <div>
                        <?php if (isset($_SESSION["cart"][$dish->id_dish])) : ?>
                            <p class="text-center text-gray-600 mt-2"> <button class="bg-white text-red-600 font-semibold py-2 px-4 rounded-lg hover:bg-red-50 transition-colors duration-300" onclick="reducirPlato(<?php echo $dish->id_dish; ?>)"> - </button> Cantidad Añadida: <?php echo $_SESSION["cart"][$dish->id_dish] ?> <button onclick="aumentarPlato(<?php echo $dish->id_dish; ?>)" class="bg-white text-red-600 font-semibold py-2 px-4 rounded-lg hover:bg-red-50 transition-colors duration-300">+</button> </p>

                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>


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
    <script src="web/js/script_dishes.js"></script>
    <script>
        function toggleAllCheckboxes(name, buttonElement) {
            const checkboxes = document.querySelectorAll(`input[name="${CSS.escape(name)}"]`);
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);

            // Actualiza el texto del botón
            if (buttonElement) {
                buttonElement.textContent = allChecked ? "Seleccionar todo" : "Deseleccionar todo";
            }
        }
    </script>
</body>

</html>