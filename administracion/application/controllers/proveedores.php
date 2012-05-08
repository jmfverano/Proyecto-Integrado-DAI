<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	function index() {
		# Se comprobara el logueo antes mostrar algun dato.
		$this->utilidades->comprobar_logueo();
		if($this->input->post('criterio') && $this->input->post('columna')) {
			$datos['criterio'] = $this->input->post('criterio');
			$datos['columna']  = $this->input->post('columna');
		} else {
			$datos['criterio'] = '';
			$datos['columna']  = '';
		}
		$datos['filas'] = $this->Proveedor->obtener_todos();
		$this->template->load('template','proveedores/index', $datos);
	}
}