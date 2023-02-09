<?php

class UsuariosController {

    //Inicializamos las variables en blanco para que no den error al imprimirlos en los values
    //cuando cargamos la pagina la primera vez.

    function registrar() {
        $email = "";
        $password = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario();
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $error = false;

            //Comprobamos si existe un usuarios con el mismo correo
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            if ($usuarioDAO->obtenerPorEmail($email)) {
                MensajeFlash::guardarMensaje("Email Repetido");
                MensajeFlash::imprimirMensajes();
                $error = true;
            }

            if (!$error) {
                //Encriptamos la contraseña
                $passwordCrypt = password_hash($password, PASSWORD_BCRYPT);
                $usuario->setEmail($email);
                $usuario->setPassword($passwordCrypt);
                $usuarioDAO->insertar($usuario);
                header('Location: pruebas.php');
                die();
            }
        }
        require 'app/vista/registrar.php';
    }

    function login() {
        // Comprueba si se ha enviado el formulario
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            MensajeFlash::guardarMensaje("El correo electrónico no es válido");
            header("Location: index.php");
            die();
        }
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuario = $usuarioDAO->obtenerPorEmail($email);
        if (!$usuario) {
            MensajeFlash::guardarMensaje("El usuario o la contraseña no son válidos");
            header("Location: index.php");
            die();
//        }
        if (!password_verify($password, $usuario->getPassword())) {
            MensajeFlash::guardarMensaje("El usuario o la contraseña no son válidos");
            header("Location: index.php");
            die();
        }
        //VARIABLES DE SESION
        $_SESSION['email'] = $usuario->getEmail(); //EMAIL
        $_SESSION['idUsuario'] = $usuario->getId(); //USUARIO
        $_SESSION['foto'] = $usuario->getFoto(); //FOTO
        $uid = sha1(time() + rand()) . md5(time());
        $usuario->setUid($uid);
        $usuarioDAO->actualizar($usuario);
        setcookie("uid", $uid, time() + 7 * 24 * 60 * 60);
        header("Location: app/vistas/anuncios.php");
        die();
    }

    function logout() {
        session_destroy();
        setcookie("uid", "", 0);
        header("Location: index.php");
    }

}
}