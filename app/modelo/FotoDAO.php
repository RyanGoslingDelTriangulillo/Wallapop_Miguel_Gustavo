<?php 

class FotoDAO{
    private $conn;

    public function __construct($conn) {
        if (!$conn instanceof mysqli) { //Comprueba si $conn es un objeto de la clase mysqli
            return false;
        }
        $this->conn = $conn;
    }

    public function getFotosAnuncio($idAnuncio){
        $query = "SELECT * FROM fotografias WHERE id_anuncio = ?";
        if(!$result = $this->conn->query($query)){
            die("Error al ejecutar la QUERY" . $this->conn->error);
        }
        $array_fotos = array();
        while($foto = $result->fetch_object('Foto')){
            $array_fotos[] = $foto;
        }
        return $array_fotos;
        
    }
}

?>