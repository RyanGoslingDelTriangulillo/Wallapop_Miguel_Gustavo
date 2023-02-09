<?php

//Incluir archivo de configuración
require_once 'app/config.php';

//Incluir controladores necesarios
require_once 'app/controlador/AnunciosController.php';


// Crear un arreglo de mapeo de acciones
$map = array(
    "login" => array("controller" =>  "UsuariosController.php", "method" => "login", "publica" => true),
    "anuncios" => array("controller" => "AnunciosController.php", "method" => "inicio", "publica" => true)
);

// Verificar si se ha enviado una acción en la URL
if (isset($_GET['action']) && array_key_exists($_GET['action'], $map)) {
    // Obtener la acción especificada
    $action = $_GET['action'];
} else {
    // Si no se ha especificado una acción o no existe, redirigir a la página de inicio
    header("Location: app/vistas/anuncios.php");
    exit;
}

// Verificar si la acción es pública o no
if (!$map[$action]['publica'] && !isset($_SESSION['usuario'])) {
    // Si la acción no es pública y no existe una sesión de usuario, redirigir a la página de login
    header("Location: login.php");
    exit;
}

// Incluir el controlador especificado en el mapeo
require_once 'app/controlador/' . $map[$action]['controller'];

// Crear una instancia del controlador
$controller = new UsuariosController();

// Llamar al método especificado en el mapeo
call_user_func(array($controller, $map[$action]['method']));