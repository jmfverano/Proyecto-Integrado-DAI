<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct() {
		CI_Controller::__construct();
	}

	function index() {
		
		$this->utilidades->comprobar_logueo();
		
		if ($this->input->post('editar')) {
			redirect('usuarios/editar');
		} elseif ($this->input->post('borrar')) {
			redirect('usuarios/borrar');
		} elseif ($this->input->post('nuevo_instrumento')) {
			redirect('tiendas/index');
		}  else {
			/**
			 * Aquí se obtiene todos los datos personales del usuario y los pedidos realizados.
			 */
			$data['usuario'] = $this->Usuario->datos_usuario();
			$data['pedidos'] = $this->Usuario->pedidos_usuario();
			$this->template->load('template','usuarios/index', $data);
			
		}
	}

	function login() {
		if ($this->input->post('login')) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$res = $this->Usuario->comprobar_usuario($email, $password);
			if ($res->num_rows() == 1) {
				$datos = $res->row_array();
				$this->session->set_userdata('id_usuario', $datos['id_usuario']);
				$this->session->set_userdata('email', $email);
				$this->session->set_userdata('nombre', $datos['nombre_usu']);
				$this->session->set_userdata('apellidos', $datos['apellidos']);
				redirect('tiendas/index');
			} else {
				$mensaje = 'Error: usuario o contraseña incorrectos';
			}

		} elseif ($this->input->post('nuevo')) {
			redirect('usuarios/insertar');
		} else {
			$mensaje = $this->session->flashdata('mensaje');
		}

		$this->template->load('template','usuarios/login', array('mensaje' => $mensaje));
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('usuarios/login');
	}

	function editar() {
		
		$this->utilidades->comprobar_logueo();
		
		if ($this->input->post('actualizar')) {
			$datos['nombre_usu'] = $this->input->post('nombre_usu');
			$datos['apellidos'] = $this->input->post('apellidos');
			$datos['email'] = $this->input->post('email');
			$datos['dni'] = $this->input->post('dni');
			$datos['direccion'] = $this->input->post('direccion');
			$datos['telefono'] = $this->input->post('telefono');
			$datos['id_usuario'] = $this->session->userdata('id_usuario');
			
			if(!$this->Usuario->actualizar_usuario($datos)){

			} else {
				redirect('usuarios/index');
			}
		} else {
			$datos = $this->Usuario->obtener_usuario();
			$this->template->load('template','usuarios/editar', $datos);
		}
	}

	
	function insertar() {
		
		if ($this->input->post('alta')) {
			
			if ($this->Usuario->insertar_nuevo()) {
				 $this->session->set_flashdata('mensaje', 'La operación se realizo correctamente.');
				 redirect('usuarios/index');
			} else {
				
				$this->session->set_flashdata('mensaje', 'La operación no se pudo completar, vuelva a intarlo.');
				 redirect('usuarios/insertar');
			}
		}	
	    elseif ($this->input->post('cancelar')) {
	    	redirect('usuarios/index');
		} else {
			$datos['email'] = '';
			$datos['password'] = '';
			$datos['nombre_usu'] = '';
			$datos['apellidos'] = '';
			$datos['nombre_usu'] = '';
			$datos['dni'] = '';
			$datos['direccion'] = '';
			$datos['telefono'] = '';
			$datos['admin'] = false;
			$this->template->load('template','usuarios/alta', $datos);
		}
	}
	
	function borrar() {
		
		$this->utilidades->comprobar_logueo();
		
		if ($this->input->post('si') && $this->session->userdata('id_usuario')) {
			
		    if($this->Usuario->borrar_usuario()) {
		    	
		    	$this->session->set_flashdata('mensaje', 'La operación se realizo correctamente.');
				redirect('usuarios/index');
				$this->logout();
				
		    } else {
		    	
		    	$this->session->set_flashdata('mensaje', 'La operación no se realizo, intentelo denuevo más tarde.');
				redirect('usuarios/index');
		    }
		}  elseif ($this->input->post('no')) {
			redirect('usuarios/index');
		} else {

			$datos['id_usuario'] = $this->session->userdata('id_usuario');
			$this->template->load('template','usuarios/borrar', $datos);		}
		}
		
	function cesta() {
		
		$this->utilidades->comprobar_logueo();
		
		if($this->session->userdata('cesta')) {
			$datos['filas'] = $this->Usuario->obten_productos_cesta();
			$this->template->load('template','usuarios/cesta', $datos);
				
		} else {
			
		}
	}
	
	/**
	 * Elimina el producto de la cesta que tiene la id que se le manda.
	 */
	function elimina_cesta($id_producto) {
		
		$cesta = $this->session->userdata('cesta');
		foreach ($cesta as $key => $valor) {
			if($valor == $id_producto) {
				$cesta[$key] = '';
				break;
			}
		}
		
		$this->session->set_userdata('cesta',$cesta);
		redirect('usuarios/cesta');
	}
}
