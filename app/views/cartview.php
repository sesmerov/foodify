<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="web/css/cart_style.css" rel="stylesheet">
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
                                    echo '<button class="nav-button text-sm" name="order" value="admin"><i class="fas fa-user-circle"></i>Acceso Administrador</button>';
                                    break;
                                case 'CLIENTE':
                                    echo '<button class="nav-button text-sm" name="order" value="usu"><i class="fas fa-user-circle"></i>Tu Perfil</button>';
                                    break;
                                case 'COCINA':
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

    <!-- INTRODUCCION -->
    <div class="hero flex items-center justify-center h-96">
        <div class="text-center p-9 rounded-lg"><br><br><br>
            <h1 class="text-4xl font-bold text-white">El placer está en tu mano</h1>
            <p class="text-white mt-4">Cada plato en tu carrito es una promesa de sabor. Completa tu pedido y deja que
                comience el deleite.</p>
        </div>
    </div>
    <br><br>

    <!-- NUMERO PRODUCTOS -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <?php
        $cartItemCount = array_sum($_SESSION['cart']);
        ?>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tu Carrito</h1>
            <?php if ($cartItemCount > 0): ?>
                <span class="text-gray-500"><?= $cartItemCount ?> artículo<?= $cartItemCount > 1 ? 's' : '' ?></span>
            <?php endif; ?>
        </div>

        <!-- LISTA -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">

            <?php $total = 0; ?>
            <?php foreach ($cartDishes as $dish): ?>
                <?php $quantity = $_SESSION['cart'][$dish->id_dish]; ?>
                <?php $subtotal = $dish->price * $quantity; ?>
                <?php $total += $subtotal; ?>

                <div class="p-4 border-b flex items-center">
                    <img src="<?= getClientImage($dish->id_dish) ?>" alt="<?= htmlspecialchars($dish->name) ?>" class="w-20 h-20 object-cover rounded-md mr-4">
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <h3 class="font-medium text-gray-800"><?= htmlspecialchars($dish->name) ?></h3>
                            <p class="text-gray-500 text-sm"><?= htmlspecialchars($dish->details) ?></p>
                            <p class="font-medium text-gray-800 mt-1"><?= number_format($dish->price, 2) ?>€ x <?= $quantity ?></p>
                        </div>
                        <form method="GET" action="index.php?">
                            <input type="hidden" name="order" value="removeFromCart">
                            <input type="hidden" name="id_dish" value="<?= $dish->id_dish?>">
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Eliminar del carrito">
                                <a href="index.php?order=removeFromCart&id=<?= $dish->id_dish ?>" title="Eliminar del carrito" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- RESUMEN -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span><?= number_format($total, 2) ?>€</span>
            </div>
        </div>
        <div class="flex justify-center mt-6">
        <form method="POST" action="index.php">
         <input type="hidden" name="ord" value="submitcart">
        <input type="hidden" name="date" value="<?= date('Y-m-d H:i:s.u') ?>">
        <input type="hidden" name="total" value="<?= $total ?>">
        <button type="submit" class="w-48 bg-white border-2 border-red-500 text-red-500 font-bold py-2 px-6 rounded-3xl hover:bg-red-500 hover:text-white hover:scale-105 transition-all duration-300 ease-in-out transform">
               Realizar Pedido  
            </button>
            </form>
        </div> <br>
    </div>


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
                    <div class="mt-6 text-gray-800 text-4xl font-bold">Foodify</div>
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