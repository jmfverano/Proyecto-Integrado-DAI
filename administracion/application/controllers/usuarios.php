<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
    $this->load->model('Usuario');
  }

  function index() {
	  if ($this->input->post('editar')) {
	  		redirect('usuarios/editar');
	  } elseif ($this->input->post('borrar')) {
		  	redirect('usuarios/borrar');
	  } elseif ($this->input->post('voler')) {
		  	redirect('administracion/index');
	  } else {
	  		$datos= $this->Usuario->obtener($this->session->userdata('id_usuario'));
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
        redirect('administracion/index');
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
} 