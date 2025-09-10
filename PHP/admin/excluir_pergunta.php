<?php
require_once __DIR__ . '/../../include/conn.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
	$conn->query("DELETE FROM perguntas WHERE id=$id");
}

header("Location: admin.php");
exit;
?>