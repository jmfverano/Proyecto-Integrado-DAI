<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
	
	function __construct() {
		CI_Controller::__construct();
		$this->session->set_userdata('orden', 'order by id_producto');
		$this->session->set_userdata('orden_tipo', 'asc');
		
	}
	
	function cuerpo() {
		
		// Se realiza la busqueda por criterio.
		if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
		
			$busqueda = "and " . $this->session->userdata('columna') .
			" = " . $this->session->userdata('criterio') ;
		
		} elseif ($this->busqueda_criterio()) {
		
			$busqueda = "and " . $this->session->userdata('columna') . " like " .
					" '%" . $this->session->userdata('criterio') ."%'";
		
		} else {
		
			$busqueda = '';
		}
			
		// Se comprueba el orden con la siguiente fucion.
		$this->tipo_orden();
		$datos_campo_orden = "order by " . $this->session->userdata('campo') . " " . $this->session->userdata('tipo_orden');
		// Con los datos ya preparados se procede a iniciar la consulta.
		$datos = $this->Producto->obten_cuerpo($busqueda, $datos_campo_orden);
		$datos['columna'] = $this->session->userdata('columna');
		$datos['criterio'] = $this->session->userdata('criterio');
		$this->template->load('template','productos/cuerpo', $datos);
			
		
	}
	
	function pastillas() {
		
			// Se realiza la busqueda por criterio.
			if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
				
				$busqueda = "and " . $this->session->userdata('columna') .
				" = " . $this->session->userdata('criterio') ;
				
			} elseif ($this->busqueda_criterio()) {
				
				$busqueda = "and " . $this->session->userdata('columna') . " like " .
						" '%" . $this->session->userdata('criterio') ."%'";
				
			} else {
				
				$busqueda = '';
			}
			
			// Se comprueba el orden con la siguiente fucion.
			$this->tipo_orden();
			$datos_campo_orden = "order by " . $this->session->userdata('campo') . " " . $this->session->userdata('tipo_orden');
			// Con los datos ya preparados se procede a iniciar la consulta.
			$datos = $this->Producto->obten_pastillas($busqueda, $datos_campo_orden);
			$datos['columna'] = $this->session->userdata('columna');
			$datos['criterio'] = $this->session->userdata('criterio');
			$this->template->load('template','productos/pastillas', $datos);
			
	}
	
	function mastil() {
	
		// Se realiza la busqueda por criterio.
		if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
	
			$busqueda = "and " . $this->session->userdata('columna') .
			" = " . $this->session->userdata('criterio') ;
	
		} elseif ($this->busqueda_criterio()) {
	
			$busqueda = "and " . $this->session->userdata('columna') . " like " .
					" '%" . $this->session->userdata('criterio') ."%'";
	
		} else {
	
			$busqueda = '';
		}
			
		// Se comprueba el orden con la siguiente fucion.
		$this->tipo_orden();
		$datos_campo_orden = "order by " . $this->session->userdata('campo') . " " . $this->session->userdata('tipo_orden');
		// Con los datos ya preparados se procede a iniciar la consulta.
		$datos = $this->Producto->obten_mastil($busqueda, $datos_campo_orden);
		$datos['columna'] = $this->session->userdata('columna');
		$datos['criterio'] = $this->session->userdata('criterio');
		$this->template->load('template','productos/mastil', $datos);
			
	}
	
	
	function clavijero() {
	
		// Se realiza la busqueda por criterio.
		if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
	
			$busqueda = "and " . $this->session->userdata('columna') .
			" = " . $this->session->userdata('criterio') ;
	
		} elseif ($this->busqueda_criterio()) {
	
			$busqueda = "and " . $this->session->userdata('columna') . " like " .
					" '%" . $this->session->userdata('criterio') ."%'";
	
		} else {
	
			$busqueda = '';
		}
			
		// Se comprueba el orden con la siguiente fucion.
		$this->tipo_orden();
		$datos_campo_orden = "order by " . $this->session->userdata('campo') . " " . $this->session->userdata('tipo_orden');
		// Con los datos ya preparados se procede a iniciar la consulta.
		$datos = $this->Producto->obten_clavijero($busqueda, $datos_campo_orden);
		$datos['columna'] = $this->session->userdata('columna');
		$datos['criterio'] = $this->session->userdata('criterio');
		$this->template->load('template','productos/clavijero', $datos);
			
	}
	
	
	
	/**
	 *  Esta funcion será la encargada de controlar el orden a la hora de realizar la buscaqueda.
	 *  Sera llamada antes de realizar la consulta, la consulta lo debera obtener de la varable de sessión.
	 */
	private function tipo_orden() {
		
		if ($this->input->post('campo')) {
			
			$this->session->set_userdata('campo', $this->input->post('campo'));
			
		} else {
			
			$this->session->set_userdata('campo', 'id_producto');			
		}
		
		if ($this->session->userdata('tipo_orden') == $this->input->post('orden')) {
			
			$this->session->set_userdata('tipo_orden', 'desc');
		
		} else {
			
			$this->session->set_userdata('tipo_orden', 'asc');
		}
	}
	
	/**
	 *  Se comprueba si la vista mando datos al controlador, si es así se gualdaran en las variables de
	 *  sessión para complementar la sentencia SQL.
	 *  @return Devuelve verdadero si la vista envio datos y falso sino.
	 */
	private function busqueda_criterio() {
		
		if ($this->input->post('buscar') && 
		    $this->session->userdata('tipo_producto') != $this->input->post('tipo_producto')) {
			
			$this->session->set_userdata('criterio',$this->input->post('criterio'));
			$this->session->set_userdata('columna', $this->input->post('columna'));
			$this->session->set_userdata('tipo_producto', $this->input->post('tipo_producto'));
			
			return true;
			
		} elseif ($this->input->post('buscar')) {
			
			$this->session->set_userdata('criterio',$this->input->post('criterio'));
			$this->session->set_userdata('columna', $this->input->post('columna'));
			
			return true;
			
		} else {
			
			$this->session->set_userdata('criterio','');
			$this->session->set_userdata('columna', '');
			
			return false;
		}
	}
	
}