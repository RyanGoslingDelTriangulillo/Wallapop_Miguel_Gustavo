<?php

//Incluir archivo de configuración
require_once 'app/config.php';

//Incluir controladores necesarios
require_once 'app/controlador/AnunciosController.php';
require_once 'app/controlador/UsuariosController.php';
require_once 'app/modelo/Usuario.php';
require_once 'app/modelo/UsuarioDAO.php';
require_once 'app/modelo/AnuncioDAO.php';
require_once 'app/modelo/Anuncio.php';
require_once 'app/utilidades/MensajeFlash.php';
// Crear un arreglo de mapeo de acciones
$map = array(
    "login" => array("controller" =>  "UsuariosController", "method" => "login", "publica" => true),
    "registro" => array("controller" =>  "UsuariosController", "method" => "registrar", "publica" => true),
    "inicio" => array("controller" => "AnunciosController", "method" => "inicio", "publica" => true), 
    "descripcion" => array("controller" => "AnunciosController", "method" => "descripcion", "publica" => true)
);

/* PARSEO DE LA RUTA */
if (!isset($_GET['action'])) {    //Si no existe el parámetro GET action como index.php?action=algo
    $action = 'inicio';
} else {
    if (!isset($map[$_GET['action']])) {  //Si no existe la acción en el mapa
        print "La acción indicada no existe.";
        header('Status: 404 Not Found');
        die();
    } else {
        $action = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
}

// Verificar si la acción es pública o no
if (!$map[$action]['publica'] && !isset($_SESSION['usuario'])) {
    // Si la acción no es pública y no existe una sesión de usuario, redirigir a la página de login
    header("Location: login.php");
    exit;
}

// Incluir el controlador especificado en el mapeo$controller = $map[$action]['controller'];
$controller = $map[$action]['controller'];
$method = $map[$action]['method'];

if (method_exists($controller, $method)) {
    $obj_controller = new $controller();
    $obj_controller->$method();
} else {
    header('Status: 404 Not Found');
    echo "El método $method del controlador $controller no existe.";
}