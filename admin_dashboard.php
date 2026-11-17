<?php
require 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Delete Event
if (isset($_GET['delete'])) {
    $del_id = $conn->real_escape_string($_GET['delete']);
    $conn->query("DELETE FROM events WHERE id='$del_id'");
    header("Location: admin_dashboard.php?msg=deleted");
    exit();
}

// Add New Event Card
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $sql = "INSERT INTO events (title, description, category, image_url) VALUES ('$title', '$description', '$category', '$image_url')";
    $conn->query($sql);
}

// Add News/Update to an Existing Event Card
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_news'])) {
    $event_id = $conn->real_escape_string($_POST['event_id']);
    $news_text = $conn->real_escape_string($_POST['news_text']);
    $sql = "INSERT INTO event_updates (event_id, news_text) VALUES ('$event_id', '$news_text')";
    if($conn->query($sql)){
        $success = "News added to the event successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - NVTI News</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 border-b border-gray-800 text-center text-xl font-bold text-blue-500">NVTI ADMIN</div>
        <nav class="flex-1 p-4"><a href="#" class="block px-4 py-2 bg-blue-600 rounded-lg text-white">Manage Events</a></nav>
        <div class="p-4 border-t border-gray-800"><a href="logout.php" class="block w-full py-2 bg-red-600 text-center rounded-lg">Logout</a></div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto p-8">
        <?php if(isset($success)) echo "<p class='bg-green-100 text-green-700 p-3 rounded mb-4 font-bold'>$success</p>"; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- 1. Create New Event Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">1. Create New Event Card</h3>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="add_event" value="1">
                    <input type="text" name="title" placeholder="Event Title (e.g. Open Day 2026)" required class="w-full border p-2 rounded">
                    <select name="category" class="w-full border p-2 rounded">
                        <option value="Campus">Campus</option><option value="Entertainment">Entertainment</option>
                    </select>
                    <textarea name="description" placeholder="Short description" required class="w-full border p-2 rounded"></textarea>
                    <input type="text" name="image_url" placeholder="Image URL" required class="w-full border p-2 rounded">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold w-full">Create Card</button>
                </form>
            </div>

            <!-- 2. Add News to Existing Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-green-500">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">2. Add News to Event Card</h3>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="add_news" value="1">
                    <select name="event_id" required class="w-full border p-2 rounded bg-gray-50 font-bold">
                        <option value="">-- Select Event Card --</option>
                        <?php
                        $events = $conn->query("SELECT * FROM events ORDER BY created_at DESC");
                        while($e = $events->fetch_assoc()){
                            echo "<option value='".$e['id']."'>".$e['title']."</option>";
                        }
                        ?>
                    </select>
                    <textarea name="news_text" placeholder="e.g. This will be held December 1st from 8 am" required class="w-full border p-2 rounded" rows="3"></textarea>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded font-bold w-full">Add News Update</button>
                </form>
            </div>
        </div>
        
        <a href="index.php" class="bg-gray-800 text-white px-4 py-2 rounded text-center block w-48">View Live Site &rarr;</a>
    </main>
</body>
</html>