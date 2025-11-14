<!-- <?php
	// if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
	// $uri .= $_SERVER['HTTP_HOST'];
	// header('Location: '.$uri.'/dashboard/');
	// exit;
?> -->
<!-- Something is wrong with the XAMPP installation :-( -->

<?php
// PHP Logic Section

// Initialize the message variable
$message = "Enter your name below and click the button to see a personalized greeting!";

// Check if the form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent XSS (basic sanitization)
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';

    if (!empty($name)) {
        $message = "Hello, <span class=\"font-extrabold text-indigo-700 dark:text-indigo-300\">{$name}</span>! Welcome to your modern single-page PHP application.";
    } else {
        $message = "Please enter a valid name!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern PHP Greeting App</title>
    <!-- Load Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Enables dark mode based on 'dark' class on HTML
            theme: {
                extend: {
                    colors: {
                        'primary': '#4f46e5',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Optional custom styles for smoother transitions */
        body {
            transition: background-color 0.3s ease;
        }
        .card {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="h-full font-sans antialiased text-gray-800 dark:text-gray-100 flex items-center justify-center p-4">

    <!-- Dark Mode Toggle (UX Feature) -->
    <button id="theme-toggle" class="absolute top-4 right-4 p-2 rounded-full bg-white dark:bg-gray-700 shadow-md transition duration-300 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none">
        <svg id="sun-icon" class="w-6 h-6 text-yellow-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        <svg id="moon-icon" class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button>
    <script>
        // Simple dark mode script
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Check local storage or system preference
        const isDark = localStorage.getItem('theme') === 'dark' || 
                       (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isDark) {
            html.classList.add('dark');
            document.getElementById('sun-icon').classList.remove('hidden');
            document.getElementById('moon-icon').classList.add('hidden');
        } else {
             document.getElementById('sun-icon').classList.add('hidden');
            document.getElementById('moon-icon').classList.remove('hidden');
        }

        themeToggle.addEventListener('click', () => {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                document.getElementById('sun-icon').classList.add('hidden');
                document.getElementById('moon-icon').classList.remove('hidden');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('sun-icon').classList.remove('hidden');
                document.getElementById('moon-icon').classList.add('hidden');
            }
        });
    </script>
    
    <!-- Main Content Card -->
    <div class="card w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-[1.01]">
        
        <h1 class="text-3xl font-bold text-center mb-6 text-primary dark:text-indigo-400">PHP Greeting Generator</h1>
        
        <!-- Result Message Area -->
        <div id="result-message" class="mb-6 p-4 rounded-lg border-l-4 border-primary bg-indigo-50 dark:bg-gray-700/50 dark:border-indigo-400 text-base">
            <?php echo $message; ?>
        </div>
        
        <!-- Form Section -->
        <!-- The action="" submits the form to the same page, allowing PHP to process it immediately -->
        <form method="POST" action="" class="space-y-6">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Your Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="e.g., Jane Doe"
                    required 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white transition duration-200"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                >
            </div>
            
            <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-900 transition duration-300 transform hover:-translate-y-0.5"
            >
                Generate Greeting
            </button>
            
        </form>

        <p class="mt-6 text-xs text-center text-gray-500 dark:text-gray-400">
            Powered by PHP and modern Tailwind CSS.
        </p>
    </div>

</body>
</html>