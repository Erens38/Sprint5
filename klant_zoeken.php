<?php
// Databaseverbinding
include 'db_connection.php';

$zoekresultaten = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zoekterm = $_POST['zoekterm'];
    
    $sql = "SELECT * FROM klanten WHERE naam LIKE ?";
    $stmt = $conn->prepare($sql);
    $zoekterm = "%" . $zoekterm . "%";
    $stmt->bind_param("s", $zoekterm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $zoekresultaten[] = $row['naam'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Klanten Zoeken</title>
</head>
<body>
    <h1>Klanten Zoeken</h1>
    <form method="POST" action="">
        Zoek klant: <input type="text" name="zoekterm" required><br><br>
        <button type="submit">Zoeken</button>
    </form>
    <?php if(!empty($zoekresultaten)): ?>
        <h2>Zoekresultaten:</h2>
        <ul>
            <?php foreach ($zoekresultaten as $resultaat): ?>
                <li><?php echo htmlspecialchars($resultaat); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>