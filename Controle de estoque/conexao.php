<?php

$host = "localhost";
$db = "id20961773_deposito";
$user = "id20961773_ismael";
$pass = "Nick14131226@";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("falha na conexão com o banco de dados");
}
