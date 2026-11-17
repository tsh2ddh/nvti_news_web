<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NVTI News - Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header Section -->
    <header class="bg-white shadow-md p-5 flex justify-between items-center sticky top-0 z-50">
        <h1 class="text-3xl font-extrabold text-blue-700">NVTI News</h1>
        <div class="flex items-center space-x-4">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="text-right hidden sm:block mr-2">
                    <p class="font-bold text-gray-800 text-sm">Welcome, <?php echo $_SESSION['username']; ?></p>
                    <p class="text-xs text-blue-500 font-semibold uppercase"><?php echo $_SESSION['role']; ?></p>
                </div>
                
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="admin_dashboard.php" class="px-4 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg hover:bg-blue-200">Dashboard</a>
                <?php endif; ?>
                
                <a href="logout.php" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition">Logout</a>
            <?php else: ?>
                <a href="login.php" class="px-5 py-2 text-gray-700 font-bold hover:text-blue-700">Login</a>
                <a href="register.php" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-full shadow-lg hover:bg-blue-700">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Hero Section (Purple Banner) -->
    <main class="max-w-5xl mx-auto mt-12 mb-10 px-4">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-center shadow-xl">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 block">Welcome to NVTI News!</h2>
            <p class="text-xl text-blue-100 mb-8 block">Stay updated with our latest news and campus events.</p>
            <button class="px-8 py-3 bg-white text-blue-700 font-bold rounded-full shadow-md hover:bg-gray-100 transition inline-block hover:scale-105 transform duration-200">Explore More</button>
        </div>
    </main>

    <!-- Upcoming Events & Dynamic News Updates Section -->
    <section class="max-w-5xl mx-auto mb-20 px-4">
        <h2 class="text-center text-3xl font-extrabold text-gray-800 mb-10">Upcoming Events & News</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            // Event cards gennagannawa
            $events_sql = "SELECT * FROM events ORDER BY created_at DESC";
            $events_result = $conn->query($events_sql);

            if ($events_result->num_rows > 0) {
                while($row = $events_result->fetch_assoc()) {
                    $event_id = $row['id'];
                    $badgeColor = ($row['category'] == 'Campus') ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700';
                    
                    echo '
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col h-full hover:shadow-2xl transition duration-300">
                        <img src="'.$row['image_url'].'" class="w-full h-48 object-cover">
                        <div class="p-6 flex-grow">
                            <span class="'.$badgeColor.' text-xs font-bold px-2 py-1 rounded mb-3 inline-block">'.$row['category'].'</span>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">'.$row['title'].'</h3>
                            <p class="text-gray-500 text-sm mb-4">'.$row['description'].'</p>
                            
                            <!-- Meka athule thamai News Update wenne -->
                            <div class="mt-4 border-t border-gray-100 pt-4 space-y-3">';
                            
                            // Me card ekata adala news updates database eken gannawa
                            $updates_sql = "SELECT * FROM event_updates WHERE event_id='$event_id' ORDER BY created_at DESC";
                            $updates_result = $conn->query($updates_sql);
                            
                            if($updates_result->num_rows > 0){
                                echo '<h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Latest News</h4>';
                                while($update = $updates_result->fetch_assoc()){
                                    echo '
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r text-sm text-gray-700 font-medium">
                                        '.$update['news_text'].'
                                        <div class="text-xs text-gray-400 mt-1">'.date('M d, g:i A', strtotime($update['created_at'])).'</div>
                                    </div>';
                                }
                            }
                            
                    echo '  </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p class='text-gray-500 text-center col-span-2 font-bold bg-gray-100 p-8 rounded-lg'>No events found. Admin needs to add some!</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6 text-center">
        <p>&copy; 2026 NVTI News. All rights reserved.</p>
    </footer>

</body>
</html>