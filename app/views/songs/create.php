<?php
ob_start();
?>
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Agregar Nueva Canción</h2>
    
    <form action="/songs" method="POST" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Título *</label>
            <input type="text" id="title" name="title" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="artist" class="block text-sm font-medium text-gray-700">Artista *</label>
            <input type="text" id="artist" name="artist" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="album" class="block text-sm font-medium text-gray-700">Álbum</label>
            <input type="text" id="album" name="album" 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700">Año</label>
            <input type="number" id="year" name="year" min="1900" max="<?= date('Y') ?>" 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="link" class="block text-sm font-medium text-gray-700">Enlace (YouTube, Spotify, etc.)</label>
            <input type="url" id="link" name="link" 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="/songs" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Guardar Canción</button>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';