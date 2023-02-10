<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
require 'app/modelo/Anuncio.php';
require 'app/modelo/AnuncioDAO.php';
require_once 'app/modelo/ConexionBD.php';

/**
 * Description of AnunciosController
 *
 * @author Alumno
 */
class AnunciosController {
    function inicio() {
        
        $anuncioDAO = new AnuncioDAO(ConexionBD::conectar());
        

        //Obtengo todos los mensajes de la BD
        $array_anuncios = $anuncioDAO->getAnuncios();
        
        //incluimos la vista
        require 'app/vistas/anuncios.php';
        
    }
    
    function descripcion(){
        
        $anuncioDAO = new AnuncioDAO(ConexionBD::conectar());
        
        $idAnuncio = $_GET['idAnuncio'];
        //Obtengo todos los mensajes de la BD
        $anuncio = $anuncioDAO->getAnunciosIdAnuncio($idAnuncio);
        
        //incluimos la vista
        require 'app/vistas/descripcion.php';
        
        
    }
    
}
