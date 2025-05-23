<?php
ob_start();
?>
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Registro de Usuario</h2>
    
    <form action="/register" method="POST" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
            <input type="text" id="name" name="name" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" id="password" name="password" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <?php if (isset($error)): ?>
            <div class="text-red-500 text-sm"><?= $error ?></div>
        <?php endif; ?>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Registrarse
        </button>
        
        <p class="text-center text-sm text-gray-600">
            ¿Ya tienes una cuenta? <a href="/login" class="text-blue-600 hover:text-blue-800">Inicia sesión aquí</a>
        </p>
    </form>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';