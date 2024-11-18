<?php
include("controller.php");
$username = $_POST["username"];
$pass = md5($_POST["pass"]); //opcion 1 de modificacion, para hacerlo generico se debe crear una funcion que me devuelva todos los datos si existe

$fila = verificarUsuario($username, $pass);

if ($fila != 0) {

    session_start();
    $_SESSION["id_roles"] = $fila["id_roles"];
    $filaRole = getById("roles", $fila["id_roles"]);
    $_SESSION["roles"] = $filaRole["role"];
    $_SESSION["usuario"] = $fila["usuario"];
    $_SESSION["email"] = $fila["email"];
    $_SESSION["valido"] = "1";

    echo 1;
} else {
    echo 0;
}
