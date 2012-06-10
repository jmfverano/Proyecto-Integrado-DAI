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
		
		if($this->input->post('ir_alta')) {
			
			$datos = array();
			$datos['usuario'] = $this->Usuario->obtener_usuario();
			$productos = $this->Producto->obtener_productos();
			
			#Estos son los array auxiliares que uremos para organizar la vista.
			
			$array_cuerpo = array(0 => "No");
			$array_p_mastil = array(0 => "No");
			$array_p_puente = array(0 => "No");
			$array_p_central = array(0 => "No");
			$array_set_pastilla = array(0 => "No");
			$array_mastil = array(0 => "No");
			$array_clavijero = array(0 => "No");
			$array_cuerdas = array(0 => "No");
			$array_cejuela = array(0 => "No");
			$array_puente = array(0 => "No");
			$array_potenciometro = array(0 => "No");
			$array_jack = array(0 => "No");
			$array_select_posicion = array(0 => "No");
			$array_guarda_puas = array(0 => "No");
			$array_ortros = array(0 => "No");
			
			foreach ($productos as $v) {
				extract($v);
				switch ($id_tipo_producto) {
			
					case 1:
						$array_cuerpo += array($id_producto => $nombre_prod);
						break;
					case 2:
						$array_p_mastil += array($id_producto => $nombre_prod);
						break;
					case 3:
						$array_p_puente += array($id_producto => $nombre_prod);
						break;
					case 4:
						$array_p_central += array($id_producto => $nombre_prod);
						break;
					case 5:
						$array_set_pastilla += array($id_producto => $nombre_prod);
						break;
					case 6:
						$array_mastil += array($id_producto => $nombre_prod);
						break;
					case 7:
						$array_clavijero += array($id_producto => $nombre_prod);
						break;
					case 9:
						$array_cuerdas += array($id_producto => $nombre_prod);
						break;
					case 10:
						$array_cejuela += array($id_producto => $nombre_prod);
						break;
					case 11:
						$array_puente += array($id_producto => $nombre_prod);
						break;
					case 12:
						$array_potenciometro += array($id_producto => $nombre_prod);
						break;
					case 13:
						$array_jack += array($id_producto => $nombre_prod);
						break;
					case 14:
						$array_guarda_puas += array($id_producto => $nombre_prod);
						break;
					case 15:
						$array_otros += array($id_producto => $nombre_prod);
						break;
				}
			}
			
			$datos['cuerpo'] = $array_cuerpo;
			$datos['p_mastil'] = $array_p_mastil;
			$datos['p_puente'] = $array_p_puente;
			$datos['p_central'] = $array_p_central;
			$datos['set_pastilla'] = $array_set_pastilla;
			$datos['mastil'] = $array_mastil;
			$datos['clavijero'] = $array_clavijero;
			$datos['cuerdas'] = $array_cuerdas;
			$datos['cejuela'] = $array_cejuela;
			$datos['puente'] = $array_puente;
			$datos['potenciometro'] = $array_potenciometro;
			$datos['jack'] = $array_jack;
			$datos['s_posicion'] = $array_select_posicion;
			$datos['guarda_puas'] = $array_guarda_puas;
			$datos['otros'] = $array_ortros;
			
			$this->template->load('template','pedidos/alta', $datos);
		} 
	}
	/**
	 * Actualizara el estado del pedido desde el panel de control.
	 */
	function modifica_estado() {
		
		if($this->input->post('cambiar')) {
			
			$estado = $this->input->post('estado');
			$id_pedido = $this->input->post('id_pedido');
			if($this->Pedido->modificar_estado($id_pedido, $estado) == 1) {
				$this->session->set_flashdata('mensaje', 'La actualización fue completado.');
				redirect('usuarios/index');
			} else {
				$this->session->set_flashdata('mensaje', 'Se ha producido un error, vuela a intentarlo');
				redirect('usuarios/index');
			}
		}
	}

}