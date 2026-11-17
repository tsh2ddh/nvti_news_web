<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php?msg=registered");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NVTI News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <!-- Background Decoration -->
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="w-full max-w-md relative z-10 px-4 py-8">
        <!-- Back to Home -->
        <a href="index.php" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-blue-600 mb-4 transition">
            &larr; Back to Home
        </a>

        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Create Account</h2>
                <p class="text-gray-500 text-sm">Join the NVTI News student community.</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm font-semibold mb-6 text-center border border-red-100">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" placeholder="e.g. irushi" required 
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" placeholder="user@nvti.com" required 
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required 
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                
                <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3 rounded-xl hover:bg-black hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 mt-4">
                    Create Account
                </button>
            </form>
            
            <p class="mt-6 text-center text-sm text-gray-600 font-semibold">
                Already have an account? 
                <a href="login.php" class="text-blue-600 hover:underline">Sign in here</a>
            </p>
        </div>
    </div>
</body>
</html>