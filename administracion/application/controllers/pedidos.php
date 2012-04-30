<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	function __construct() {
		CI_Controller::__construct();
		
	}

	function index() {
		/*
		 * Al entrar en el index antes se comprobara que se a iniciado la sesión, si no es así lo llevará al login.
		 */
		$this->utilidades->comprobar_logueo();
		
	}
	
	function alta() {
		
		if($this->input->post('alta_pedido') && $this->input->post('id_usuario')) {
			if ($this->input->post('estilo') && $this->input->post('tipo')) {
				
			} else {
				$dato['categorias'] = $this->Producto->obten_categoria();
			}
			
		} else {
			$data['mensaje'] = "Se ha producido un error, vuelva a intarlo.";
			$this->template->load('usuarios/error', $data);
		}
	}

}