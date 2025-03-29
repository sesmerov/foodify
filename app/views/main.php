<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="web/css/main.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow rounded-2xl mt-3 max-w-4xl mx-auto absolute left-1/2 transform -translate-x-1/2 z-10">
        <div class="container px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold text-gray-800 mr-12"> Foodify </div>
                <div>
                    <form action="" class="flex space-x-5">
                        <button class="nav-button text-sm" name="order">Iniciar Sesión</button>
                        <button class="nav-button text-sm" name="order" value="admin">Acceso Administrador</button>
                        <button class="nav-button text-sm" name="order"><i class="fas fa-shopping-cart"></i> Carrito</button>
                        <button class="nav-button text-sm" name="order"><i class="fas fa-cog"></i> Ajustes</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- INTRODUCCION -->
    <div class="hero flex items-center justify-center h-96">
        <div class="text-center p-9 rounded-lg"><br><br><br>
            <h1 class="text-4xl font-bold text-white">Disfruta de la comida que te mereces</h1>
            <p class="text-white mt-4">En Foodify, nos apasiona ofrecerte platos deliciosos y saludables, preparados con
                ingredientes frescos y de la más alta calidad. ¡Deja que nosotros cocinemos por ti!</p>
            <br><br>
            <button class="hero-button">Registrarse / Iniciar sesión</button>
        </div>
    </div>
    <br><br>


    <!-- CARRUSEL RESENAS-->
    <div class="w-full mx-auto px-6 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Lo que dicen nuestros foodifans xd</h2>

        <div class="carousel">
            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"¡La mejor comida que he probado! Muy recomendable."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Servicio rápido y platos deliciosos. Volveré a pedir."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Increíble calidad y sabor. ¡Gracias, Foodify!"</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"¡Increíble experiencia! La comida llegó puntual y caliente. El salmón con
                    salsa provenzal estaba delicioso. ¡Volveré a pedir!"</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Muy recomendable. El pollo teriyaki es mi favorito. Siempre fresco y
                    lleno de sabor. ¡Gracias, Foodify!"</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Excelente servicio. Me encanta la variedad de opciones vegetarianas. El
                    arroz meloso de setas es una delicia."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Increíble calidad y sabor. ¡Gracias, Foodify!"</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"¡La mejor comida que he probado! Muy recomendable."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Servicio rápido y platos deliciosos. Volveré a pedir."</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow flex-none w-64 mb-6 mr-5">
                <div class="flex items-center"><span class="text-yellow-500">★★★★★</span></div>
                <p class="text-gray-600 mt-2">"Servicio rápido y platos deliciosos. Volveré a pedir."</p>
            </div>
        </div>
    </div><br>


    <!-- SECCION COMO FUNCIONA -->
    <div class="w-full bg-white py-12">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-8">Cómo funciona</h2>
            <div class="flex justify-center gap-8">
                <div class="text-center">
                    <img src="web/media/images/funciona1.webp" alt="Imagen 1" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Explora el menú</h3>
                    <p class="text-gray-600 mb-0">Descubre nuestros platos y elige lo que más te apetezca.</p>
                </div>
                <div class="text-center">
                    <img src="web/media/images/funciona2.webp" alt="Imagen 2" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Haz tu pedido</h3>
                    <p class="text-gray-600 mb-0">Completa tu pedido y dinos dónde entregarlo.</p>
                </div>
                <div class="text-center">
                    <img src="web/media/images/funciona3.webp" alt="Imagen 3" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Recibe y disfruta</h3>
                    <p class="text-gray-600 mb-0">Te llevamos la comida caliente a casa. ¡Buen provecho!</p>
                </div>
            </div>
        </div>
    </div>


    <!-- SECCION EXPLORA POR TIPO DE PLATO -->
    <div class="container mx-auto px-6 py-8"><br>
        <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">Explora por tipo de plato</h2>
        <p class="mt-2 text-center mb-8">Elige la categoría que más te apetezca y descubre los platos que tenemos preparados para ti.</p>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <!-- VEGETARIANO -->
            <a href="index.php?type=vegetariano" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 p-6">
                <img src="web/media/images/vegetariano.webp" alt="Vegetariano" class="mx-auto mb-4 rounded-lg w-32 h-32 object-cover">
                <h3 class="how-it-works-title">Vegetariano</h3>
                <p class="text-gray-600">Platos sin carne ni pescado, llenos de sabor.</p>
            </a>
            <!-- PESCADO -->
            <a href="index.php?type=pescado" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 p-6">
                <img src="web/media/images/pescado.webp" alt="Pescado" class="mx-auto mb-4 rounded-lg w-32 h-32 object-cover">
                <h3 class="how-it-works-title">Pescado</h3>
                <p class="text-gray-600">Delicias del mar frescas y sabrosas.</p>
            </a>
            <!-- CARNE -->
            <a href="index.php?type=carne" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 p-6">
                <img src="web/media/images/carne.webp" alt="Carne" class="mx-auto mb-4 rounded-lg w-32 h-32 object-cover">
                <h3 class="how-it-works-title">Carne</h3>
                <p class="text-gray-600">Sabores intensos para los amantes de la carne.</p>
            </a>
            <!-- OTROS -->
            <a href="index.php?type=otros" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300 p-6">
                <img src="web/media/images/otros.webp" alt="Otros" class="mx-auto mb-4 rounded-lg w-32 h-32 object-cover">
                <h3 class="how-it-works-title">Otros</h3>
                <p class="text-gray-600">Sopas, postres y todo lo que no te esperas.</p>
            </a>
        </div>
    </div><br><br>


    <!-- CARRUSEL NUESTROS PLATOS -->
    <div class="w-full bg-red-600 py-12" style="background-color: var(--color-primary);">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-white">Nuestros Platos</h2>
            <p class="text-xl text-white mt-2">Descubre nuestras delicias culinarias</p>
        </div>
        <div class="w-full carousel-wrapper overflow-hidden relative">
            <div class="w-full carousel-track flex">

                <!-- SECCION 1 (IMAGENES ORIGINALES) -->
                <?php foreach ($dishes as $dish): ?>
                    <img src="<?= getClientImage($dish->id_dish) ?>" alt="<?= htmlspecialchars($dish->name) ?>" class="carousel-item">
                <?php endforeach; ?>

                <!-- SECCION 2 (IMAGENES DUPLICADAS PARA EL LOOP) -->
                <?php foreach ($dishes as $dish): ?>
                    <img src="<?= getClientImage($dish->id_dish) ?>" alt="<?= htmlspecialchars($dish->name) ?>" class="carousel-item">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="bg-white text-red-600 font-semibold py-2 px-6 rounded-lg hover:bg-red-50 transition-colors duration-300">
                Ver todos los platos
            </button>
        </div>
    </div>


    <!-- SECCION DUDAS -->
    <div class="bg-gray-200 py-12"><br><br>
        <div class="max-w-3xl mx-auto">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-800">Preguntas frecuentes</h1>
            </div>

            <div class="space-y-4 m-8 px-10">
                <!-- Duda 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse1')"
                        class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Cuánto cuesta un pedido?</span>
                    </button>
                    <div id="collapse1" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Depende de los platos que elijas. Solo pagas por lo que consumes, sin tarifas adicionales ni suscripciones.</p>
                    </div>
                </div>
                <!-- Duda 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse2')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Tengo que pedir todos los días?</span>
                    </button>
                    <div id="collapse2" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Para nada. Pide cuando quieras. En Foodify no hay compromisos, solo comodidad.</p>
                    </div>
                </div>
                <!-- Duda 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse3')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Qué tipo de comida tienen?</span>
                    </button>
                    <div id="collapse3" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Ofrecemos una variedad de platos preparados al momento, con ingredientes frescos y pensados para todos los gustos.</p>
                    </div>
                </div>
                <!-- Duda 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse4')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Cuánto tarda en llegar el pedido?</span>
                    </button>
                    <div id="collapse4" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Nuestro equipo entrega en franjas horarias que eliges al confirmar tu pedido. Siempre puntuales y con la comida caliente.</p>
                    </div>
                </div>
                <!-- Duda 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse5')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Tengo que registrarme?</span>
                    </button>
                    <div id="collapse5" class="hidden px-4 pb-4">
                        <p class="text-gray-600">No es obligatorio, pero crear una cuenta te permite guardar tus direcciones, ver pedidos anteriores y repetirlos fácilmente.</p>
                    </div>
                </div>
            </div>
        </div>
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

                    <div class="mt-6 text-gray-800 text-4xl font-bold">Foodify</div>
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

    <script src="web/js/script.js"></script>
</body>

</html>