<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./css/user_style.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="./web/media/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./web/media/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./web/media/icons/favicon-16x16.png">
</head>

<body class="bg-gray-100">
    <!-- NAVBAR -->
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

<div class="hero flex items-center justify-center min-h-[12rem] bg-red-500 pt-20 pb-10">
    <div class="text-center text-white px-4 w-full pt-8 pb-6">
        <h1 class="text-3xl sm:text-4xl font-bold whitespace-nowrap px-4">¡Únete a Foodify hoy!</h1>
        <p class="mt-4 text-base sm:text-lg max-w-md md:max-w-lg mx-auto">
            Regístrate para comenzar a explorar deliciosos platos, guardar tus favoritos y vivir una experiencia gastronómica personalizada. ¡Es rápido y fácil!
        </p>
    </div>
</div>


<!-- REGISTRO -->
<section class="flex justify-center items-center py-20 bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg w-full max-w-md mt-10">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Registrarse</h2>
        <form action="index.php" method="post" class="space-y-4">

            <input type="hidden" name="ord" value="register">
            <input type="hidden" name="role" value="CLIENTE">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre</label>
                <input type="text" id="nombre" name="nombre"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                    required>
            </div>
            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-600">Apellido</label>
                <input type="text" id="apellido" name="apellido"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                    required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600">Correo electrónico</label>
                <input type="email" id="email" name="email"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                    required>
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-600">Dirección</label>
                <input type="text" id="direccion" name="direccion"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                    required>
            </div>
            <div>
                <label for="contrasena" class="block text-sm font-medium text-gray-600">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                    required>
                    <label for="contrasena" class="block text-sm font-medium text-gray-600"> confirmar Contraseña</label>
                    <input type="password" id="contrasena2" name="contrasena2"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"
                        required>
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white transition-colors transition-transform duration-300 transform hover:scale-105 font-semibold py-2 px-4 rounded-2xl mt-6">
                    Registrarse
                </button>
            </div>
        </form>
        <?php if (!empty($registerError)): ?>
    <div class="alert alert-danger">
        <?php echo htmlspecialchars($registerError); ?>
    </div>
<?php endif; ?>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                ¿Ya tienes una cuenta?
                <a href="index.php?order=login" class="text-red-500 hover:underline">Inicia sesión</a>
            </p>
        </div>
    </div>
</section>


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
</body>
</html>