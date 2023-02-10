<?php

class Favorito{
    private $id_usuario;
    private $id_anuncio;

	/**
	 * @return mixed
	 */
	public function getId_usuario() {
		return $this->id_usuario;
	}
	
	/**
	 * @param mixed $id_usuario 
	 * @return self
	 */
	public function setId_usuario($id_usuario): self {
		$this->id_usuario = $id_usuario;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getId_anuncio() {
		return $this->id_anuncio;
	}
	
	/**
	 * @param mixed $id_anuncio 
	 * @return self
	 */
	public function setId_anuncio($id_anuncio): self {
		$this->id_anuncio = $id_anuncio;
		return $this;
	}
}

?>