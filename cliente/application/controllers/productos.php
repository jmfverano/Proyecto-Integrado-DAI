<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
	
	function __construct() {
		CI_Controller::__construct();
		
	}
	
	function index($id_producto=null) {
		/**
		 * Comprueba si es la primera vez que entra en este producto.
		 */
		
		
		if ($id_producto != $this->session->userdata('id_anterior') && $id_producto != null) {
			
			$this->session->set_userdata('orden', 'order by id_producto');
			$this->session->set_userdata('orden_tipo', 'desc');
		}
		
		
		
		/**
		 *  Se comprueba el valor enviado desde la vista.
		 *  Si no se manda, entonces tomara el anterior que esta pensado así para el paginador.
		 */
		switch ($id_producto) {
			
			case 1:
				$producto = "where id_tipo_producto = 1";
				break;
			case 2:
				$producto = "where id_tipo_producto in (2,3,4,5)";
				break;
			case 6:
				$producto = "where id_tipo_producto = 6";
				break;
			case 7:
				$producto = "where id_tipo_producto = 7";
				break;
			case 8:
				$producto = "where id_tipo_producto = 8";
				break;
			case 9:
				$producto = "where id_tipo_producto = 9";
				break;
			case 10:
				$producto = "where id_tipo_producto = 10";
				break;
			case 11:
				$producto = "where id_tipo_producto = 11";
				break;
			case 12:
				$producto = "where id_tipo_producto = 12";
				break;
			case 13:
				$producto = "where id_tipo_producto = 13";
				break;
			case 14:
				$producto = "where id_tipo_producto = 14";
				break;
			case 15:
				$producto = "where id_tipo_producto = 15";
				break;
			case 99;
				$producto = '';
				break;
			default:
				$producto = $this->session->userdata('producto');
				break;
		}
	
		$this->session->set_userdata('producto',$producto);
		$this->session->set_userdata('id_anterior',$id_producto);
		
		
		/**
		 * Se realiza las comprobaciones, se comprueba el criterio y las columnas, ademas de el producto seleccionado.
		 * Si el produto seleccionado es todos, la variable de sessión <producto>tendrá un valor vacio. 
		 */
		if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
		
			if ($this->session->userdata('producto') == '') {
				
				$busqueda = "where " . $this->session->userdata('columna') .
				" = " . $this->session->userdata('criterio') ;
			} else {
			
				$busqueda = "and " . $this->session->userdata('columna') .
				" = " . $this->session->userdata('criterio') ;
			}
			
		} elseif ($this->busqueda_criterio()) {
		
			
			if ($this->session->userdata('producto') == '') {
			
				$busqueda = "where " . $this->session->userdata('columna') . " like " .
						" '%" . $this->session->userdata('criterio') ."%'";
			} else {
				$busqueda = "and " . $this->session->userdata('columna') . " like " .
						" '%" . $this->session->userdata('criterio') ."%'";
			}
		} else {
		
			$busqueda = '';
		}
			
		// Se comprueba el orden con la siguiente fucion, si viene del paginador el orden se mantiene.
		if (!$this->input->post('numero_pagina')) {
			$this->tipo_orden();	
		}
		$datos_campo_orden = "order by " . $this->session->userdata('campo') . " " . $this->session->userdata('orden_tipo');
		// Con los datos ya preparados se procede a iniciar la consulta.
		$datos = $this->Producto->obten_producto($busqueda, $datos_campo_orden);
		$datos['columna'] = $this->session->userdata('columna');
		$datos['criterio'] = $this->session->userdata('criterio');
		$this->template->load('template','productos/index', $datos);
			
		
	}
	
	
	
	/**
	 *  Esta funcion será la encargada de controlar el orden a la hora de realizar la buscaqueda.
	 *  Sera llamada antes de realizar la consulta, la consulta lo debera obtener de la varable de sessión.
	 */
	
	private function tipo_orden() {
		
		if ($this->session->userdata('campo')) {
		
			if ($this->input->post('campo')) {
		
				$this->session->set_userdata('campo', $this->input->post('campo'));
			}  else {
				
				$this->session->set_userdata('campo', 'id_producto');
			} 
		} else {
				
				$this->session->set_userdata('campo', 'id_producto');
		}
		
		switch ($this->session->userdata('orden_tipo')) {
			case 'asc':
				$this->session->set_userdata('orden_tipo', 'desc');
				break;
			case 'desc':
				$this->session->set_userdata('orden_tipo', 'asc');
				break;
			default:
				$this->session->set_userdata('orden_tipo', 'asc');
				break;		
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
	
	function informacion_producto($id) {
		
		if($id) {
		
			$datos['fila'] = $this->Producto->obten_producto_segun_id($id);
			$datos['id_producto'] =  $id;
			$this->template->load('template2','productos/informacion_producto', $datos);
		
		} else {
		
			$datos['mensaje'] = "Se ha producido un error.";
			$this->template->load('template2','productos/informacion_producto', $datos);
		}
	}
}