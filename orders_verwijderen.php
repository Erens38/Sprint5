<?php
// Databaseverbinding
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $id = $_POST['id'];

    $table = '';
    if ($type == 'verkooporder') {
        $table = 'verkooporders';
    } elseif ($type == 'inkooporder') {
        $table = 'inkooporders';
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
    <title>Orders Verwijderen</title>
</head>
<body>
    <h1>Verkooporders/Inkooporders Verwijderen</h1>
    <form method="POST" action="">
        Type:
        <select name="type">
            <option value="verkooporder">Verkooporder</option>
            <option value="inkooporder">Inkooporder</option>
        </select><br><br>
        ID: <input type="text" name="id" required><br><br>
        <button type="submit">Verwijderen</button>
    </form>
</body>
</html>