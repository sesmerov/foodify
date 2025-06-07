<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plato - Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="web/media/icons/favicon-96x96.png">

</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Plato</h1>

        <form action="index.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="ord" value="modpostD">
            <input type="hidden" name="id_dish" value="<?= htmlspecialchars($dish->id_dish) ?>">


            <div>
                <label for="name" class="block text-gray-700 mb-2 font-medium">Nombre</label>
                <input id="name" name="name" type="text" value="<?= htmlspecialchars($dish->name) ?>" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <label for="type" class="block text-gray-700 mb-2 font-medium">Tipo</label>
                <select id="type" name="type" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
                    <?php
                    $types = ['VEGETARIANO', 'PESCADO', 'CARNE', 'OTROS'];
                    foreach ($types as $t): ?>
                        <option value="<?= $t ?>" <?= $dish->type === $t ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div>
                <label for="details" class="block text-gray-700 mb-2 font-medium">Descripción</label>
                <textarea id="details" name="details" rows="4" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500"><?= htmlspecialchars($dish->details) ?></textarea>
            </div>


            <div>
                <label for="price" class="block text-gray-700 mb-2 font-medium">Precio (€)</label>
                <input id="price" name="price" type="number" step="0.01" value="<?= htmlspecialchars($dish->price) ?>" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
            </div>


            <div>
                <label for="image" class="block text-gray-700 mb-2 font-medium">Imagen del Plato</label>
                <input id="image" name="image" type="file" accept="image/*" class="w-full text-gray-700">
                <p class="mt-2 text-sm text-gray-500">Imagen actual: <img src="<?= getClientImage($dish->id_dish) ?>" alt="Imagen actual" class="inline-block w-40 h-40 object-cover rounded"></p>

            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Alérgenos</label>
                <div class="grid grid-cols-2 gap-2">
                    <?php
                    $allergenIds = $controller->getAllergensCodeByDishID($_GET['id']);
                    ?>

                    <div class="grid grid-cols-2 gap-2">
                        <?php
                        $allergenList = [
                            1 => 'Gluten',
                            2 => 'Lactosa',
                            3 => 'Frutos secos',
                            4 => 'Soya',
                            5 => 'Huevos',
                            6 => 'Pescado',
                            7 => 'Mariscos',
                            8 => 'Cacahuetes',
                            9 => 'Apio',
                            10 => 'Mostaza'
                        ];
                        foreach ($allergenList as $id => $name): ?>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                    name="allergens[]"
                                    value="<?= $id ?>"
                                    <?= in_array($id, $allergenIds) ? 'checked' : '' ?>
                                    class="form-checkbox text-pink-500">
                                <span class="ml-2"><?= $name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="flex justify-end space-x-4">
                    <a href="index.php?order=dish" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Cancelar</a>
                    <button type="submit" class="px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">Guardar Cambios</button>
                </div>
        </form>
    </div>

</body>

</html>