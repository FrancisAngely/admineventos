<?php

include("controller.php");
$tabla="usuarios";

//SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1


$datos["id_roles"]=$_POST["id_roles"];
$datos["usuario"]=$_POST["usuario"];
$datos["password"]=md5($_POST["password"]);
$datos["email"]=$_POST["email"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

echo saveV($tabla,$datos);
?>