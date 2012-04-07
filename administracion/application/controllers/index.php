<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
  
  }
  
  function index()
  {
    /*
	 * Al entrar en el index antes se comprobara que se a iniciado la sesión, si no es así lo llevará al login.
	 */
  	$this->utilidades->comprobar_logueo(); 
	
  	if ($this->input->post('usuarios')){
        redirect('usuarios/index');
  	} else if ($this->input->post('productos')) {
  		  redirect('productos/index');
  	} else {
  		$this->load->view('index/menu');
  	}
  }
}