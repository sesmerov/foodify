<?php
// require_once __DIR__ . '/../vendor/autoload.php';
// session_start();

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
// $dotenv->load();

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

$user = $_SESSION['userLogged'];
$amount = $_POST['amount'] ?? 1000; // En céntimos

// 💾 Guarda la orden pendiente para registrar después del pago
$_SESSION['pending_order'] = [
    'date' => date('Y-m-d H:i:s'),
    'amount' => $amount,
    'address' => $user->address,
    'user_id' => $user->id_user
];

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => 'Pedido Foodify',
            ],
            'unit_amount' => $amount,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $_ENV['APP_URL'] . '/index.php?order=cart&payment=success',
    'cancel_url' => $_ENV['APP_URL'] . '/index.php?order=cart&payment=cancel',
]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Redirigiendo a Stripe...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3;url=<?= htmlspecialchars($session->url) ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center h-screen text-center px-4">

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Redirigiendo a Stripe...</h1>
        <p class="text-gray-600">Por favor, espera mientras te llevamos a la plataforma de pago.</p>
        <div class="mt-6 flex justify-center">
            <svg class="animate-spin h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
        </div>
        <p class="mt-4 text-sm text-gray-400">Si no eres redirigido automáticamente, haz clic <a href="<?= htmlspecialchars($session->url) ?>" class="text-red-500 hover:underline">aquí</a>.</p>
    </div>

</body>
</html>
