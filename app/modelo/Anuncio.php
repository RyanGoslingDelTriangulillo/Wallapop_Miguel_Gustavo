<?php
class Anuncio {

    private $id;
    private $precio;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $id_usuario;

    public function getId() {
        return $this->id;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

}