<!DOCTYPE html>
<!--Sumit Mahi -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($watch['name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($watch['name']); ?></h1>
    <p>Price: $<?php echo htmlspecialchars($watch['price']); ?></p>
    <p><?php echo htmlspecialchars($watch['information']); ?></p>
    <img src="<?php echo htmlspecialchars($watch['image']); ?>" alt="<?php echo htmlspecialchars($watch['name']); ?>">
    <br>
    <a href="<?php echo htmlspecialchars($watch['official_url']); ?>" target="_blank">Official Page</a>
    <br>
    <a href="index.php">Back to Watches</a>
</body>
</html>