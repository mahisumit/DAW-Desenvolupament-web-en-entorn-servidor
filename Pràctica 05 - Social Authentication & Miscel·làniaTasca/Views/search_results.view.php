<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../views/estils/index.css">
</head>
<body>
    <div class="container">
        <h1>Search Results</h1>
        <?php if (empty($search_results)): ?>
            <p>No results found for "<?php echo htmlspecialchars($search_query); ?>"</p>
        <?php else: ?>
            <div class="watches">
                <?php foreach ($search_results as $watch): ?>
                    <div class="watch">
                        <a href="<?php echo htmlspecialchars($watch['official_url']); ?>" target="_blank">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($watch['image_upload']); ?>" alt="<?php echo htmlspecialchars($watch['name']); ?>">
                        </a>
                        <h2><?php echo htmlspecialchars($watch['name']); ?></h2>
                        <p>Price: <?php echo str_replace(',', ' ', number_format($watch['price'], 0, ',', ' ')); ?>€</p>
                        <p><?php echo nl2br(htmlspecialchars(truncateText($watch['information']))); ?></p>
                        <a href="index.php?watch_id=<?php echo htmlspecialchars($watch['id']); ?>">Continue Reading</a>
                        <p>Published on: <?php echo htmlspecialchars(date('F j, Y', strtotime($watch['created_at']))); ?></p>
                        <p>Published by: <?php echo htmlspecialchars($watch['username']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <a href="index.php" class="back-to-main">Back to Main Page</a>
    </div>
</body>
</html>