<?php
// Start the session
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Fetch user data from the database to check their role
    include 'db_config.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Redirect based on user role
    if ($user['role'] == 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        header("Location: user_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop 🛒</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="flex justify-between items-center px-6 py-4 bg-white bg-opacity-80 shadow-md">
        <div class="text-2xl font-bold text-indigo-600">Online Shop🛒</div>
        <div>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md mr-2 hover:bg-indigo-700"
                onclick="location.href='login.php'">Login</button>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700"
                onclick="location.href='register.php'">Register</button>
        </div>
    </header>
    <h1 class="text-5xl font-bold mb-4">Welcome to Shop</h1>
    </section>

    <section class="py-16 bg-gray-50 text-center">
        <h2 class="text-3xl font-semibold mb-10">Featured Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="https://cdn.mos.cms.futurecdn.net/FkGweMeB7hdPgaSFQdgsfj.jpg" alt="Smart Watches"
                    class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Smart Watches</h3>
                <p>Stay connected and healthy with our latest collection of smart wearables.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="https://images.othoba.com/images/thumbs/0663980_wireless-earbuds-bluetooth-headphones-with-noise-cancellation-in-ear-earbuds-with-touch-control-buil.webp"
                    alt="Wireless Earbuds" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Wireless Earbuds</h3>
                <p>Experience crystal clear sound and premium audio quality anywhere.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <img src="https://sc04.alicdn.com/kf/Hb630d22fd70f429dbbad5bd11f19c644A.jpg" alt="Laptop Accessories"
                    class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-semibold mb-2">Laptop Accessories</h3>
                <p>Upgrade your workflow with top-tier tech accessories for your devices.</p>
            </div>
        </div>
    </section>

    <section class="py-16 text-center px-6">
        <h2 class="text-3xl font-semibold mb-10">Our Bestsellers</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            include 'db_config.php';
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="bg-white shadow-md rounded-lg overflow-hidden text-center">
                            <img src="  ' . $row['image'] . '" alt="' . $row['name'] . '" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">' . $row['name'] . '</h3>
                                <p class="text-indigo-600 font-bold">' . number_format($row['price'], 2) . ' Taka</p>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "<p class='text-gray-600'>No products found!</p>";
            }
            ?>
        </div>
    </section>


    </div>
    </div>
    </section>

    <footer class="text-center py-6 bg-gray-200 text-gray-600">
        <p>&copy; 2025 Online Shop 🛒 | All Rights Reserved</p>
    </footer>
</body>

</html>