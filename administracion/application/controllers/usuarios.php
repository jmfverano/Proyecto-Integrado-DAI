<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
    $this->load->model('Usuario');
  }

  function index() {
  /*
	 * Al entrar en el index antes se comprobara que se a iniciado la sesión, si no es así lo llevará al login.
	 */
  	$this->utilidades->comprobar_logueo(); 
	
	  if ($this->input->post('editar')) {
	  		redirect('usuarios/editar');
	  } elseif ($this->input->post('borrar')) {
		  	redirect('usuarios/borrar');
	  } elseif ($this->input->post('volver')) {
		  	redirect('index/index');
    } elseif ($this->input->post('buscar')) {
        $datos['filas']= $this->Usuario->obtener_seleccion();
        $datos['criterio'] = $this->input->post('criterio');
        $datos['columna']  = $this->input->post('columna');
        $this->load->view('usuarios/index', $datos);
	  } else {
	  		$datos['filas']= $this->Usuario->obtener_todos();
        $datos['criterio'] = '';
        $datos['columna']  = '';
	  		$this->load->view('usuarios/index', $datos);
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
        $this->session->set_userdata('usuario', $email);
				$this->session->set_userdata('nombre', $datos['nombre']);
				$this->session->set_userdata('apellidos', $datos['apellidos']);
        redirect('index/index');
      } else {
        $mensaje = 'Error: usuario o contraseña incorrectos';
      }

    } elseif ($this->input->post('crear')) {
        redirect('usuarios/crear');
    } else {
      $mensaje = $this->session->flashdata('mensaje');
    }

    $this->load->view('usuarios/login', array('mensaje' => $mensaje));
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect('usuarios/login');
  }
  
  function editar() {
    if ($this->input->post('actualizar')) {
      $datos['nombre'] = $this->input->post('nombre');
      $datos['apellidos'] = $this->input->post('apellidos');
      $datos['email'] = $this->input->post('email');
      $datos['dni'] = $this->input->post('dni');
      $datos['direccion'] = $this->input->post('direccion');
      $datos['telefono'] = $this->input->post('telefono');
      if ($this->input->post('admin')== 'si') {
        $datos['admin'] = 'true';
      } else {
        $datos['admin'] = 'false';
      }

      $datos['id_usuario'] = $this->input->post('id_usuario');
      if(!$this->Usuario->actualizar_usuario($datos)){
        
      } else {
        redirect('usuarios/index');
      }
    } else {
      $datos = $this->Usuario->obtener_usuario();
      $this->load->view('usuarios/editar', $datos);
    }
  }
  
  function propiedades_usuario() {
  	if ($this->input->post('id_usuario')) {
  		/**
  		 * Aquí se obtiene todos los datos personales del usuario y los pedidos realizados.
  		 */
  		$data['usuario'] = $this->Usuario->datos_usuario();
  		$data['pedidos'] = $this->Usuario->pedidos_usuario();
  		$this->load->view('usuarios/propiedades_usuario', $data);
  	} else {
  		$data['mensaje'] = "No se cargado la vista correctamente por algún motivo";
  		$this->load->view('usuarios/error', $data);
  	}
  }
} 