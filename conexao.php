<?php

$host = "localhost";
$db = "deposito_flavio";
$user = "ismael";
$pass = "Nick1413@";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("falha na conexão com o banco de dados");
}
