<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conn = new MongoDB\Client("mongodb://127.0.0.1:27017"); // Conexión
        $serverInfo = $conn->getServerStatus();
        if ($serverInfo !== null && $serverInfo->isDead()) {
            echo "El servidor MongoDB está marcado como muerto.";
        } else {
            echo "El servidor MongoDB está vivo.";
        }
    ?>
</body>
</html>