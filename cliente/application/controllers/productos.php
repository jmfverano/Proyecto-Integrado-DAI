<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
	
	function __construct() {
		CI_Controller::__construct();
		$this->session->set_userdata('orden', 'order by id_producto');
		$this->session->set_userdata('orden_tipo', 'asc');
		
	}
	
	function cuerpo() {
		
		if ($this->input->post('busca')) {
			
			/**
			 * Prepara los obtenido para la busqueda.
			 */
			if($busqueda != null) {
					
			} else {
				$busqueda = '';
			}
			if($this->session->userdata('orden') != $datos_orden) {
					
			}
			
		} else {
			
			$datos['columna'] = '';
			$datos['criterio'] = '';
			$datos['fila'] = $this->Producto->obten_cuerpo('', $this->session->userdata('orden'));
			$this->template->load('template','productos/index', $datos);
		}
		
	}
	
	function pastillas() {
		
		if ($this->input->post('busca')) {
				
			/**
			 * Prepara los obtenido para la busqueda.
			 */
			if($busqueda != null) {
					
			} else {
				$busqueda = '';
			}
			if($this->session->userdata('orden') != $datos_orden) {
					
			}
				
		} else {
				
			$datos = $this->Producto->obten_pastillas('', $this->session->userdata('orden'));
			$datos['columna'] = '';
			$datos['criterio'] = '';
			$this->template->load('template','productos/index', $datos);
		}
		
	}
	
}