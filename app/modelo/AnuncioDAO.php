<?php

class AnuncioDAO {

    private $conn;

    public function __construct($conn) {
        if (!$conn instanceof mysqli) { //Comprueba si $conn es un objeto de la clase mysqli
            return false;
        }
        $this->conn = $conn;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM anuncios ORDER BY fecha DESC";
        if (!$result = $this->conn->query($sql)) {
            die("Error al ejecutar la SQL " . $this->conn->error);
        }
        $array_anuncios = array();
        while ($anuncio = $result->fetch_object('Anuncio')) {
            $array_anuncios[] = $anuncio;
        }
        return $array_anuncios;
        
    }

}
