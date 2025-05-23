<?php
ob_start();
?>
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Mis Canciones</h2>
        <a href="/songs/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Agregar Canción</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Artista</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Álbum</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enlace</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($songs as $song): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($song->title) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($song->artist) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $song->album ? htmlspecialchars($song->album) : '-' ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $song->year ?? '-' ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if ($song->link): ?>
                            <a href="<?= htmlspecialchars($song->link) ?>" target="_blank" class="text-blue-600 hover:text-blue-800">Escuchar</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/songs/edit/<?= $song->id ?>" class="text-blue-600 hover:text-blue-800 mr-3">Editar</a>
                        <a href="/songs/delete/<?= $song->id ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';