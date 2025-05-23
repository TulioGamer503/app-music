<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(APP_NAME) ?> - <?= htmlspecialchars($title ?? 'Inicio') ?></title>
    
    <!-- Tailwind CSS via CDN (para desarrollo) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuración personalizada de Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            },
            plugins: [
                require('@tailwindcss/forms'),
                require('@tailwindcss/typography'),
            ]
        }
    </script>
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <style>
        [x-cloak] { display: none !important; }
        .prose img { margin: 0 auto; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-primary-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-tight flex items-center">
                <i class="fas fa-music mr-2"></i>
                <?= htmlspecialchars(APP_NAME) ?>
            </a>
            
            <div class="hidden md:flex space-x-4 items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/songs" class="px-3 py-2 rounded hover:bg-primary-600 transition">
                        <i class="fas fa-list mr-1"></i> Mis Canciones
                    </a>
                    <a href="/songs/create" class="px-3 py-2 rounded hover:bg-primary-600 transition">
                        <i class="fas fa-plus mr-1"></i> Agregar
                    </a>
                    <div class="relative group">
                        <button class="flex items-center space-x-1 px-3 py-2">
                            <span><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                            <a href="/logout" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="px-3 py-2 rounded hover:bg-primary-600 transition">
                        <i class="fas fa-sign-in-alt mr-1"></i> Iniciar Sesión
                    </a>
                    <a href="/register" class="px-3 py-2 rounded bg-primary-600 hover:bg-primary-800 transition">
                        <i class="fas fa-user-plus mr-1"></i> Registrarse
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/songs" class="block px-3 py-2 rounded hover:bg-primary-600">
                        <i class="fas fa-list mr-2"></i> Mis Canciones
                    </a>
                    <a href="/songs/create" class="block px-3 py-2 rounded hover:bg-primary-600">
                        <i class="fas fa-plus mr-2"></i> Agregar Canción
                    </a>
                    <a href="/logout" class="block px-3 py-2 rounded hover:bg-primary-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                    </a>
                <?php else: ?>
                    <a href="/login" class="block px-3 py-2 rounded hover:bg-primary-600">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </a>
                    <a href="/register" class="block px-3 py-2 rounded hover:bg-primary-600">
                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Mensajes flash -->
        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p><?= $_SESSION['success_msg'] ?></p>
                </div>
                <?php unset($_SESSION['success_msg']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p><?= $_SESSION['error_msg'] ?></p>
                </div>
                <?php unset($_SESSION['error_msg']); ?>
            </div>
        <?php endif; ?>
        
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold flex items-center">
                        <i class="fas fa-music mr-2"></i>
                        <?= htmlspecialchars(APP_NAME) ?>
                    </h3>
                    <p class="text-gray-400 mt-1">Tu colección musical personal</p>
                </div>
                
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; <?= date('Y') ?> <?= htmlspecialchars(APP_NAME) ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Menu móvil
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // Funciones globales
        function confirmAction(message) {
            return confirm(message || '¿Estás seguro de realizar esta acción?');
        }
        
        // Cargar canciones via AJAX
        async function loadSongs() {
            try {
                const response = await fetch('/api/songs');
                if (!response.ok) throw new Error('Error al cargar canciones');
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                showAlert('error', 'No se pudieron cargar las canciones');
                return [];
            }
        }
        
        // Mostrar alertas
        function showAlert(type, message) {
            const alert = document.createElement('div');
            alert.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            } text-white`;
            alert.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${
                        type === 'success' ? 'fa-check-circle' : 
                        type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'
                    } mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 5000);
        }
    </script>
    
    <!-- Script de la vista específica -->
    <?php if (isset($script)): ?>
        <script><?= $script ?></script>
    <?php endif; ?>
</body>
</html>