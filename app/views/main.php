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
                <div class="flex space-x-5">
                    <button class="nav-button text-sm">Iniciar Sesión</button>
                    <button class="nav-button text-sm">Acceso Administrador</button>
                    <button class="nav-button text-sm"><i class="fas fa-shopping-cart"></i> Carrito</button>
                    <button class="nav-button text-sm"><i class="fas fa-cog"></i> Ajustes</button>
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
            <h2 class="text-2xl font-semibold mb-8">COMO FUNCIONA</h2>
            <div class="flex justify-center gap-8">
                <div class="text-center">
                    <img src="pato.jpeg" alt="Imagen 1" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Elige tu menú</h3>
                    <p class="text-gray-600 mb-0">Selecciona tus platos favoritos de nuestra amplia variedad.</p>
                </div>
                <div class="text-center">
                    <img src="pato.jpeg" alt="Imagen 2" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Realiza tu pedido</h3>
                    <p class="text-gray-600 mb-0">Haz tu pedido en minutos y elige la hora de entrega.</p>
                </div>
                <div class="text-center">
                    <img src="pato.jpeg" alt="Imagen 3" class="w-48 h-48 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="how-it-works-title">Disfruta en casa</h3>
                    <p class="text-gray-600 mb-0">Recibe tu comida en la puerta de tu casa y disfruta.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- SECCION MENU DEL DIA -->
    <div class="container mx-auto px-6 py-8"><br>
        <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">MENU DEL DIA</h2>
        <p class=" mt-2 text-center mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia perferendis dicta sit consectetur ab quibusdam quo facere corporis soluta consequuntur.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- PRIMERO -->
            <div class="text-center">
                <img src="pato.jpeg" alt="Paso 1" class="mx-auto mb-4 rounded-lg">
                <h3 class="how-it-works-title">Nombre primero</h3>
                <p class="text-gray-600">Descripcion opcional</p>
            </div>
            <!-- SEGUNDO -->
            <div class="text-center">
                <img src="pato.jpeg" alt="Paso 2" class="mx-auto mb-4 rounded-lg">
                <h3 class="how-it-works-title">Nombre segundo</h3>
                <p class="text-gray-600">Descripcion opcional</p>
            </div>
            <!-- POSTRE -->
            <div class="text-center">
                <img src="pato.jpeg" alt="Paso 3" class="mx-auto mb-4 rounded-lg">
                <h3 class="how-it-works-title">Nombre postre</h3>
                <p class="text-gray-600">Descripcion opcional</p>
            </div>
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
                <img src="pato.jpeg" alt="Plato 1" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 2" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 3" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 4" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 5" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 6" class="carousel-item">
                <!-- SECCION 2 (IMAGENES DUPLICADAS PARA EL LOOP) -->
                <img src="pato.jpeg" alt="Plato 1" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 2" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 3" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 4" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 5" class="carousel-item">
                <img src="pato.jpeg" alt="Plato 6" class="carousel-item">
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
                <h1 class="text-5xl font-bold text-gray-800">Dudas más típicas</h1>
            </div>

            <div class="space-y-4 m-8 px-10">
                <!-- Duda 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse1')"
                        class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Cuánto cuesta Foodify?</span>
                    </button>
                    <div id="collapse1" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Tú lo eliges. El precio dependerá de los platos que quieras para tu primera entrega. Ese será el precio de tu suscripción. A partir de ahí, recibirás cada semana platos adaptados a tus gustos y su precio si no haces cambios nunca superará el de tu primer pedido. Podrás elegir platos desde 6,69€/comida.</p>
                    </div>
                </div>
                <!-- Duda 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse2')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Qué pasa si una semana no puedo o no quiero recibir mi menú?</span>
                    </button>
                    <div id="collapse2" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Por supuesto, podrás pausar entregas si alguna semana no necesitas que te hagamos la comida y lo podrás hacer las veces que quieras y en todo momento.</p>
                    </div>
                </div>
                <!-- Duda 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse3')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Qué me va a llegar exactamente?</span>
                    </button>
                    <div id="collapse3" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Recibirás platos adaptados a tus gustos y preferencias, preparados con ingredientes frescos y de alta calidad.</p>
                    </div>
                </div>
                <!-- Duda 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse4')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Cuándo recibiré mi pedido?</span>
                    </button>
                    <div id="collapse4" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Los pedidos se entregan semanalmente en la fecha y hora que elijas durante el proceso de suscripción.</p>
                    </div>
                </div>
                <!-- Duda 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button onclick="toggleCollapse('collapse5')" class="w-full text-left p-4 flex justify-between items-center">
                        <span class="font-semibold">¿Cómo puedo cancelar mi suscripción?</span>
                    </button>
                    <div id="collapse5" class="hidden px-4 pb-4">
                        <p class="text-gray-600">Puedes cancelar tu suscripción en cualquier momento desde tu cuenta en la página web o contactando con nuestro servicio de atención al cliente.</p>
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