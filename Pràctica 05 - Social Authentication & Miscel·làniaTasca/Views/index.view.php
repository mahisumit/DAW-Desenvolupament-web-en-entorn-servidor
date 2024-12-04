<?php
//Sumit Mahi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../config.php'; 

// Validar el token de recordar-me (Remember me)
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ? AND remember_token_expiry > ?");
    $stmt->execute([$token, time()]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['last_activity'] = time();
    }
}

// Temps d'inactivitat per a la sessió (en segons)
$timeout_duration = 60; // 40 mins = 2400 seconds

// Per comprovar si l'usuari està autenticat
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_activity'])) {
        // Calculate the session lifetime
        $elapsed_time = time() - $_SESSION['last_activity'];
        // Si l'usuari ha estat inactiu durant més temps que el temps d'inactivitat permès, tanca la sessió
        if ($elapsed_time > $timeout_duration) {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }
    $_SESSION['last_activity'] = time();
}

// Obtenir (Fetch) les dades de l'usuari si ha iniciat sessió
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}

// Fetch sorting and pagination parameters
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
$posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 6;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $posts_per_page;

// Validate sorting column
$valid_sort_columns = ['name', 'price']; 
$sort_by = in_array($sort_by, $valid_sort_columns) ? $sort_by : 'name'; // if no sorting is applied, default to sorting by name

// Obteniu els rellotges de la base de dades amb ordenació i paginació
$stmt = $pdo->prepare("
    SELECT watches.*, users.username 
    FROM watches 
    JOIN users ON watches.created_by = users.id 
    ORDER BY $sort_by $order 
    LIMIT :offset, :posts_per_page
");
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':posts_per_page', $posts_per_page, PDO::PARAM_INT);
$stmt->execute();
$watches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the total number of watches for pagination
$total_stmt = $pdo->query("SELECT COUNT(*) FROM watches");
$total_watches = $total_stmt->fetchColumn();
$total_pages = ceil($total_watches / $posts_per_page);// per calcular el nombre total de pàgines per a la paginació.

// Fetch the watch details if "Continue Reading" is clicked
$selected_watch = null;
if (isset($_GET['watch_id'])) {
    $watch_id = intval($_GET['watch_id']);
    foreach ($watches as $watch) {
        if ($watch['id'] == $watch_id) {
            $selected_watch = $watch;
            break;
        }
    }
}

// Function to truncate text to a specified number of lines
function truncateText($text, $lines = 2) {
    $linesArray = explode("\n", wordwrap($text, 100)); // trunca un text donat a un determinat nombre de línies per a una millor visualització.
    return implode("\n", array_slice($linesArray, 0, $lines));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watches</title>
    <link rel="stylesheet" href="../views/estils/st.css">
    <link rel="stylesheet" href="../views/estils/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        // script per al menú desplegable es pot canviar fent clic a el botó i es tanca fent clic fora de la desplegable.
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.querySelector('.dropdown');
            var dropbtn = document.querySelector('.dropbtn');

            dropbtn.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdown.classList.toggle('show');
            });

            window.addEventListener('click', function(event) {
                if (!event.target.matches('.dropbtn') && !event.target.closest('.dropdown-content')) {
                    dropdown.classList.remove('show');
                }
            });

            // Live search functionality
            var searchInput = document.querySelector('.search-form input[name="query"]');
            searchInput.addEventListener('input', function() {
                var query = searchInput.value; // Send the AJAX search query to the server (search.php)
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'search.php?query=' + encodeURIComponent(query), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.querySelector('.watches').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            });
        });
    </script>
    <style>
        .avatar {
            border-radius: 50%;
            width: 40px; 
            height: 40px; 
            object-fit: cover;
            margin-left: 10px; 
        }
        .default-avatar {
            font-size: 40px; 
            color: #ccc;
            margin-left: 10px; 
        }
        .message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body> 
    <!-- Header and user info -->
    <div class="header">
        <a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>
        <h1>Watches</h1>
        <div class="user-info">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">
                        <?php if (!isset($_SESSION['welcome_displayed'])): ?>
                            <span class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            <?php $_SESSION['welcome_displayed'] = true; ?>
                        <?php else: ?>
                            <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['avatar']); ?>" alt="User Avatar" class="avatar">
                        <?php else: ?>
                            <i class="fas fa-user-circle default-avatar"></i>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-content">
                        <a href="profile.php"><i class="fas fa-user"></i> Update Profile</a>
                        <a href="changepswd.php"><i class="fas fa-key"></i> Change Password</a>
                        <a href="my_watch.php"><i class="fas fa-clock"></i> My Watches</a>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                            <a href="admin.php"><i class="fas fa-user-shield"></i> Admin Panel</a>
                        <?php endif; ?>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user"></i> Login</a>
                    <div class="dropdown-content">
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                        <a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Welcome to the Watches Store</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <!-- Search Form -->
        <form class="search-form">
            <input type="text" name="query" placeholder="Search for watches..." required>
        </form>
    </div>

    <!-- Watches Section, to display watches-->
    <div class="watches">
        <?php foreach ($watches as $watch): ?>
            <div class="watch">
                <a href="<?php echo htmlspecialchars($watch['official_url']); ?>" target="_blank">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($watch['image_upload']); ?>" alt="<?php echo htmlspecialchars($watch['name']); ?>">
                </a>
                <h2><?php echo htmlspecialchars($watch['name']); ?></h2>
                <p>Price: <?php echo str_replace(',', ' ', number_format($watch['price'], 0, ',', ' ')); ?>€</p>
                <p><?php echo nl2br(htmlspecialchars(truncateText($watch['information']))); ?></p>
                <a href="?watch_id=<?php echo htmlspecialchars($watch['id']); ?>&page=<?php echo $page; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>">Continue Reading</a>
                <p>Published on: <?php echo htmlspecialchars(date('F j, Y', strtotime($watch['created_at']))); ?></p>
                <p>Published by: <?php echo htmlspecialchars($watch['username']); ?></p>
                <?php if (isset($_SESSION['user_id']) && ($_SESSION['is_admin'] || $watch['created_by'] == $_SESSION['user_id'])): ?>
                    <div class="watch-actions">
                        <a href="edit.php?id=<?php echo htmlspecialchars($watch['id']); ?>" class="icon-button"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($watch['id']); ?>" class="icon-button"><i class="fas fa-trash"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Insert Button -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="insert-button" style="text-align: center; margin: 20px 0;">
            <a href="insert.php">Insert Watch</a>
        </div>
        <br>
    <?php endif; ?>
    <!-- Pagination -->
    <div class="pagination" style="text-align: center;">
        <?php if ($page > 1): ?>
            <a href="?page=1&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>"><<</a>
            <a href="?page=<?php echo $page - 1; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>"><</a>
        <?php endif; ?>
        <span><?php echo $page; ?></span>
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>">></a>
            <a href="?page=<?php echo $total_pages; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>">>></a>
        <?php endif; ?>
    </div>

    <!-- Sorting and Pagination Controls -->
    <div class="controls" style="text-align: center; margin: 20px 0;">
        <form method="GET" action="index.php">
            <label for="sort_by">Sort by:</label>
            <select name="sort_by" id="sort_by" class="styled-select" onchange="this.form.submit()">
                <option value="name" <?php echo $sort_by == 'name' ? 'selected' : ''; ?>>Name</option>
                <option value="price" <?php echo $sort_by == 'price' ? 'selected' : ''; ?>>Price</option>
            </select>
            <select name="order" id="order" class="styled-select" onchange="this.form.submit()">
                <option value="ASC" <?php echo $order == 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                <option value="DESC" <?php echo $order == 'DESC' ? 'selected' : ''; ?>>Descending</option>
            </select>
            <label for="posts_per_page">Posts per page:</label>
            <select name="posts_per_page" id="posts_per_page" class="styled-select" onchange="this.form.submit()">
                <option value="6" <?php echo $posts_per_page == 6 ? 'selected' : ''; ?>>6</option>
                <option value="12" <?php echo $posts_per_page == 12 ? 'selected' : ''; ?>>12</option>
                <option value="16" <?php echo $posts_per_page == 16 ? 'selected' : ''; ?>>16</option>
            </select>
        </form>
    </div>

    <!-- Popup, for continue reading about watch -->
    <?php if ($selected_watch): ?>
        <div id="popup" class="popup">
            <div class="popup-content">
                <a href="index.php?page=<?php echo $page; ?>&sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&posts_per_page=<?php echo $posts_per_page; ?>" class="close">&times;</a>
                <img id="popup-image" src="data:image/jpeg;base64,<?php echo base64_encode($selected_watch['image_upload']); ?>" alt="Watch Image">
                <h2 id="popup-name"><?php echo htmlspecialchars($selected_watch['name']); ?></h2>
                <p id="popup-price">Price: <?php echo str_replace(',', ' ', number_format($selected_watch['price'], 0, ',', ' ')); ?>€</p>
                <p id="popup-information"><?php echo nl2br(htmlspecialchars($selected_watch['information'])); ?></p>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
