<?php
$id = $_GET['id'];

$sql = new mysqli("localhost", "root", "", "mostra2025");

$sql->query("DELETE FROM perguntas WHERE id=$id");

header("Location: admin.php");
exit;
?>