<!DOCTYPE html>
<!--Sumit Mahi --> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../views/estils/styles.css">
    <link rel="stylesheet" href="../views/estils/admin.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="success"><?php echo htmlspecialchars($_SESSION['message']); ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <table>
            <thead>
                <tr> <!--User Table -->
                    <th>ID</th>
                    <th>Username</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo isset($user['created_at']) ? htmlspecialchars($user['created_at']) : 'N/A'; ?></td>
                        <td>
                            <form method="POST" action="delete_user.php" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="back-to-main">Back to Main Page</a>
    </div>
</body>
</html>