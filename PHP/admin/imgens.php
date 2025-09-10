<?php
session_start();
$sql = new mysqli("localhost", "root", "", "mostra2025");

if ($sql->connect_error) {
    die("Falha na conexão: " . $sql->connect_error);
}