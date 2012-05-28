<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas extends CI_Controller {

	function index(){
		
		$this->template->load('template','tiendas/index');
		
	}
	
	function creacion_guitarra() {
		/*
		 * Primero comprueba que este iniciada al sessión, sino no le deja.
		 */
		$this->utilidades->comprobar_logueo();
		
		if ($this->input->post('anadir_producto')) {
			
			if (!$this->session->userdata('id_piezas')) {
				$this->session->set_userdata('id_piezas',$this->input->post('id_piezas'));
			}
			$id_producto = $this->input->post('id_producto');
			$numero_paso = $this->session->userdata('numero_paso');
			$cesta = $this->session->userdata('cesta');
			$cesta += array($numero_paso => $id_producto);
			$numero_paso++;
			$this->session->set_userdata('numero_paso', $numero_paso+1);
			$this->session->set_userdata('cesta',$cesta);
			$this->proceso_creacion();
				
		} else {
			/*
			 * Comprueba que el numero de paso que va y si existe la cesta.
			 */
			if (!$this->session->userdata('cesta')) {
				$cesta = array();
				$this->session->set_userdata('cesta',$cesta);
				$this->session->set_userdata('numero_paso', 1);
				$this->session->set_userdata('id_categoria', '1');
				$this->proceso_creacion();
			} else {
				if($this->input->post('elimina_cesta')) {
					$this->session->unset_userdata('cesta');
					redirect('tiendas/index');
				} else {
					$this->template->load('template','tiendas/vaciar_cesta');
				}
			}
		}
	}
	
	function creacion_bajo() {
		
		
	}
	
	private function proceso_creacion() {
		
		$numero_paso = $this->session->userdata('numero_paso');
		
		switch ($numero_paso) {
			case 1:
				$datos['mensajes'] = "Selecciona un cuerpo para tú guitarra.";
				$id_categoria =  "and id_categoria = " . $this->session->userdata('id_categoria');
				$where = "where id_tipo_producto = 1 ";
				$datos['filas'] = $this->Producto->obten_producto_creacion($where, $id_categoria);
			break;
			case 2:
				$datos['mensajes'] = "Selecciona pastillas.";
				$id_categoria =  "and id_categoria = " . $this->session->userdata('id_categoria') . "and id_piezas = 
				$this->session->userdata('id_piezas') or 4";
				$where = "where id_tipo_producto = 1 ";
				$datos['filas'] = $this->Producto->obten_producto_creacion($where, $id_categoria);
			break;
			default:
				;
			break;
		}
		$datos['columna'] = '';
		$datos['criterio'] = '';
		$this->template->load('template','tiendas/creacion_guitarra', $datos);
		
	}
}