<?php
// Databaseverbinding
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $id = $_POST['id'];

    $table = '';
    if ($type == 'klant') {
        $table = 'klanten';
    } elseif ($type == 'leverancier') {
        $table = 'leveranciers';
    } elseif ($type == 'product') {
        $table = 'producten';
    }

    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo ucfirst($type) . " succesvol verwijderd!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verwijderen</title>
</head>
<body>
    <h1>Klanten/Leveranciers/Producten Verwijderen</h1>
    <form method="POST" action="">
        Type:
        <select name="type">
            <option value="klant">Klant</option>
            <option value="leverancier">Leverancier</option>
            <option value="product">Product</option>
        </select><br><br>
        ID: <input type="text" name="id" required><br><br>
        <button type="submit">Verwijderen</button>
    </form>
</body>
</html>