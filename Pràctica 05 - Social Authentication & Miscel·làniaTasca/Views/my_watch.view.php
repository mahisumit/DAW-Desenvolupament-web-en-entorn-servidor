<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watches</title>
    <link rel="stylesheet" href="../views/estils/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">My Watches</h1>
        <div class="watches">
            <?php foreach ($watches as $watch): ?>
                <div class="watch"> <!--Display Watches -->
                    <a href="<?php echo htmlspecialchars($watch['official_url']); ?>" target="_blank">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($watch['image_upload']); ?>" alt="<?php echo htmlspecialchars($watch['name']); ?>">
                    </a>
                    <h2><?php echo htmlspecialchars($watch['name']); ?></h2>
                    <p>Price: <?php echo str_replace(',', ' ', number_format($watch['price'], 0, ',', ' ')); ?>€</p>
                    <p><?php echo nl2br(htmlspecialchars(truncateText($watch['information']))); ?></p>
                    <a href="?watch_id=<?php echo htmlspecialchars($watch['id']); ?>">Continue Reading</a>
                    <p>Published on: <?php echo htmlspecialchars(date('F j, Y', strtotime($watch['created_at']))); ?></p>
                    <p>Published by: <?php echo htmlspecialchars($watch['username']); ?></p>
                    <div class="watch-actions">
                        <a href="edit.php?id=<?php echo htmlspecialchars($watch['id']); ?>" class="icon-button"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($watch['id']); ?>" class="icon-button"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center;">
            <a href="index.php" class="back-to-main">Back to Main Page</a>
        </div>
        <br>
    </div>
</body>
</html>