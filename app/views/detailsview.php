<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./css/dish_style.css" rel="stylesheet">
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

    <!-- INTRODUCCIÓN -->
    <div class="hero flex items-center justify-center h-96">
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
            <span class="text-gray-500"><?= count($plates) ?> artículo(s)</span>
        </div>

        <!-- LISTA DE PLATOS -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <?php foreach ($plates as $plate): ?>
                <img  class="w-20 h-20 object-cover rounded-full mr-4" src="<?= getClientImage($plate->id_dish) ?? 'rec/placeholder.jpg' ?>" alt="<?= htmlspecialchars($plate->name) ?>">
                <h3><?= htmlspecialchars($plate->name) ?></h3>
                <p><?= number_format($plate->price, 2) ?>€ x <?= $orders->GetQuantity($plate->id_dish, $_GET['id']) ?></p>
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
    </div>

    <!-- FOOTER -->
    <footer class="w-full bg-gray-200 text-white py-8 rounded-2xl">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Reutilización de secciones del footer -->
                <!-- Puedes dejarlas como están o hacerlas dinámicas si es necesario -->
                <div class="bg-gray-100 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-500"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-pink-500"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-400"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-gray-600 hover:text-red-600"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                    <div class="mt-6 text-gray-800 text-4xl font-bold">Foodify</div>
                </div>

                <!-- ... Otros bloques del footer (puedes conservarlos igual) -->
            </div>
            <div class="border-t border-gray-400 mt-8 pt-8 text-center">
                <p class="text-gray-600">&copy; 2025 Foodify. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>

</html>