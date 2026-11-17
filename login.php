<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                // Normal user wa kelinma index.php (Home page) ekata yawanawa
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Incorrect password! Please try again.";
        }
    } else {
        $error = "User account not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NVTI News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="w-full max-w-md relative z-10 px-4">
        <a href="index.php" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-blue-600 mb-6 transition">
            &larr; Back to Home
        </a>

        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Welcome Back!</h2>
                <p class="text-gray-500 text-sm">Please sign in to your NVTI News account.</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm font-semibold mb-6 text-center border border-red-100">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" placeholder="e.g. Admin hari irushi" required 
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required 
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 mt-2">
                    Sign In
                </button>
            </form>
            
            <p class="mt-8 text-center text-sm text-gray-600 font-semibold">
                Don't have an account? 
                <a href="register.php" class="text-blue-600 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>