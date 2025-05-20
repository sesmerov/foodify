<?php

$orderType = $_GET["order"] ?? '';
switch ($orderType) {
    case 'usu': ?>
        <h2 class="text-xl font-bold mb-4 text-custom-red">Lista de Usuarios</h2>
        <table class="w-full border-collapse">
            <thead class="border-t border-custom-red">
                <tr class="text-gray-700">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <!-- <th class="px-4 py-2 text-left">Contraseña</th> -->
                    <th class="px-4 py-2 text-left">Apellidos</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Dirección</th>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $usu): ?>
                    <tr>
                        <td class="px-4 py-2"><?= $usu->id_user; ?></td>
                        <td class="px-4 py-2"><?= $usu->first_name; ?></td>
                        <!-- <td class="px-4 py-2 break-all max-w-xs overflow-x-auto "><?= $usu->password; ?></td> -->
                        <td class="px-4 py-2"><?= $usu->last_name; ?></td>
                        <td class="px-4 py-2"><?= $usu->email; ?></td>
                        <td class="px-4 py-2"><?= $usu->address; ?></td>
                        <td class="px-4 py-2"><?= $usu->role; ?></td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="#" onclick="borrarUsuario(<?=$usu->id_user?>)" class="text-red-500 hover:text-red-900 transition duration-300">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="index.php?order=modU&id=<?= $usu->id_user ?>" class="text-yellow-500 hover:text-yellow-900 transition duration-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php break;

    case 'order': ?>
        <h2 class="text-xl font-bold mb-4 text-custom-red">Lista de Pedidos</h2>
        <table class="w-full border-collapse">
            <thead class="border-t border-custom-red">
                <tr class="text-gray-700">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Fecha</th>
                    <th class="px-4 py-2 text-left">Precio Total</th>
                    <th class="px-4 py-2 text-left">Dirección</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $ord): ?>
                    <tr>
                        <td class="px-4 py-2"><?= $ord->id_order; ?></td>
                        <td class="px-4 py-2"><?= $ord->order_date; ?></td>
                        <td class="px-4 py-2"><?= $ord->total_price; ?></td>
                        <td class="px-4 py-2"><?= $ord->delivery_address; ?></td>
                        <td class="px-4 py-2"><?= $ord->status; ?></td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="index.php?order=detailsO&id=<?= $ord->id_order ?>" class="text-blue-500 hover:text-blue-900 transition duration-300">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                               <a href="#" onclick="borrarOrden(<?= $ord->id_order ?>); return false;" class="text-red-500 hover:text-red-900 transition duration-300">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="index.php?order=mod&id=<?= $ord->id_order ?>" class="text-yellow-500 hover:text-yellow-900 transition duration-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php break;

    case 'dish': ?>
        <h2 class="text-xl font-bold mb-4 text-custom-red">Lista de Platos</h2>
        <table class="w-full border-collapse">
            <thead class="border-t border-custom-red">
                <tr class="text-gray-700">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Tipo</th>
                    <th class="px-4 py-2 text-left">Detalles</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dishes as $dish): ?>
                    <tr>
                        <td class="px-4 py-2"><?= $dish->id_dish; ?></td>
                        <td class="px-4 py-2"><?= $dish->name; ?></td>
                        <td class="px-4 py-2"><?= $dish->price; ?></td>
                        <td class="px-4 py-2"><?= $dish->type; ?></td>
                        <td class="px-4 py-2"><?= $dish->details; ?></td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="index.php?order=detailsD&id=<?= $dish->id_dish ?>" class="text-blue-500 hover:text-blue-900 transition duration-300">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="#" onclick="borrarPlato(<?= $dish->id_dish ?>); return false;" class="text-red-500 hover:text-red-900 transition duration-300">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="index.php?order=modD&id=<?= $dish->id_dish ?>" class="text-yellow-500 hover:text-yellow-900 transition duration-300">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php break;
}

?>

<div class="flex justify-center mt-6">
    <form method="get" action="index.php" class="flex space-x-2 ">
        <input type="hidden" name="order" value="<?= $_GET['order'] ?? '' ?>">
        <button type="submit" name="nav" value="Begin"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition duration-300">
            <<
                </button>
                <button type="submit" name="nav" value="Before"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    <
                        </button>
                        <button type="submit" name="nav" value="Next"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            >
                        </button>
                        <button type="submit" name="nav" value="Last"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            >>
                        </button>
    </form>
</div>

<script src="web/js/alert.js"></script>