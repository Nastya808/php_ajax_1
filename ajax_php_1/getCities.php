<?php
$dsn = 'mysql:host=localhost;dbname=CountryCityDB;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $countryid = $_GET['countryid'];

    $stmt = $pdo->prepare("SELECT city FROM Cities WHERE countryid = :countryid");
    $stmt->bindParam(':countryid', $countryid, PDO::PARAM_INT);
    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = '';
    foreach ($cities as $city) {
        $output .= "<tr><td>" . htmlspecialchars($city['city']) . "</td></tr>";
    }
    echo $output;

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
