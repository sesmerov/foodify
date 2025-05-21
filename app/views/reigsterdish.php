<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Plato - Foodify</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Añadir Plato</h1>

    <form action="index.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="ord" value="addpostD">

        <div>
            <label for="name" class="block text-gray-700 mb-2 font-medium">Nombre</label>
            <input id="name" name="name" type="text" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
        </div>

        <div>
            <label for="type" class="block text-gray-700 mb-2 font-medium">Tipo</label>
            <select id="type" name="type" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="VEGETARIANO">VEGETARIANO</option>
                <option value="PESCADO">PESCADO</option>
                <option value="CARNE">CARNE</option>
                <option value="OTROS">OTROS</option>
            </select>
        </div>

        <div>
            <label for="details" class="block text-gray-700 mb-2 font-medium">Descripción</label>
            <textarea id="details" name="details" rows="4" required
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500"></textarea>
        </div>

        <div>
            <label for="price" class="block text-gray-700 mb-2 font-medium">Precio (€)</label>
            <input id="price" name="price" type="number" step="0.01" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
        </div>

        <div>
            <label for="image" class="block text-gray-700 mb-2 font-medium">Imagen del Plato</label>
            <input id="image" name="image" type="file" accept="image/*" class="w-full text-gray-700">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 font-medium">Alérgenos</label>
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
                               class="form-checkbox text-pink-500">
                        <span class="ml-2"><?= $name ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="index.php?order=dish" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">Cancelar</a>
            <button type="submit" class="px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">Añadir Plato</button>
        </div>
    </form>
</div>

</body>
</html>
