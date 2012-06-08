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
	
	function insertar() {
		
		if ($this->input->post('alta_nueva')) {
			
			$datos['email'] = $this->input->post('email');
			$datos['cif'] = $this->input->post('cif');
			$datos['telefono'] = $this->input->post('telefono');
			$datos['nombre_prov'] = $this->input->post('nombre_prov');

			if(!$this->Proveedor->insertar($datos) == 1) {
				
				$this->template->load('template','proveedores/alta', $datos);
			} else {
				
				redirect('index/index');
			}
			
		} else {
			
			$datos['nombre_prov'] = '';
			$datos['cif'] = '';
			$datos['email'] = '';
			$datos['telefono'] = '';
			
			$this->template->load('template','proveedores/alta', $datos);
				
		}
	}
}