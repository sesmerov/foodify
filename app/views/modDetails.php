<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify - Editar Pedido</title>
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

    <!-- FORMULARIO DE EDICIÓN -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <form method="POST" action="index.php" class="bg-white rounded-lg shadow-md p-6 mb-6">
            <input type="hidden" name="ord" value="updateOrder">
            <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
            
            <!-- Sección de Edición -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Editar Pedido #<?= $order->id_order ?></h2>
                
                <!-- Campo Dirección -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="direccion">
                        Dirección de Entrega
                    </label>
                    <input type="text" id="direccion" name="direccion" 
                        value="<?= htmlspecialchars($order->delivery_address) ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500
                               transition duration-200 ease-in-out">
                </div>

                <!-- Selector de Estado -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
                        Estado del Pedido
                    </label>
                    <select id="estado" name="estado" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500
                               appearance-none cursor-pointer">
                        <?php 
                        $estados = ['PENDIENTE', 'EN PROCESO', 'FINALIZADO'];
                        foreach ($estados as $opcion) : 
                            $selected = ($opcion == $order->status) ? 'selected' : '';
                        ?>
                            <option value="<?= $opcion ?>" <?= $selected ?>><?= $opcion ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Lista de Platos (No editable) -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Platos del Pedido</h3>
                <?php foreach ($plates as $plate): ?>
                    <div class="flex items-center mb-3 p-2 bg-white rounded-md">
                        <img class="w-12 h-12 object-cover rounded-full mr-3" 
                             src="<?= getClientImage($plate->id_dish) ?? 'rec/placeholder.jpg' ?>" 
                             alt="<?= htmlspecialchars($plate->name) ?>">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800"><?= htmlspecialchars($plate->name) ?></p>
                            <p class="text-sm text-gray-600">
                                <?= number_format($plate->price, 2) ?>€ x <?= $orders->GetQuantity($plate->id_dish, $_GET['id']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-between items-center mt-8">
                <a href="index.php?order=order" 
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
                <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg 
                           transition duration-200 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Guardar Cambios
                </button>
            </div>
        </form>

        <!-- Resumen del Pedido -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex justify-between text-lg font-bold mb-2">
                <span>Total:</span>
                <span class="text-blue-600"><?= number_format($order->total_price, 2) ?>€</span>
            </div>
            <p class="text-sm text-gray-500">Fecha del pedido: <?= date('d/m/Y H:i', strtotime($order->order_date)) ?></p>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="w-full bg-gray-200 text-white py-8 rounded-2xl">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
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
            </div>
            <div class="border-t border-gray-400 mt-8 pt-8 text-center">
                <p class="text-gray-600">&copy; 2025 Foodify. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>
</html>