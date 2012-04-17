<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
  }

  function index() {
  	# Se comprobara el logueo antes mostrar algun dato.
  	$this->utilidades->comprobar_logueo(); 
  	$data['filas'] = $this->Producto->obtener_productos();
  	$this->load->view('productos/index', $data);
  }
  
  function alta() {
  	
  	if ($this->input->post('alta')) {
  		if (!$this->Producto->alta_producto()) {
  			
  			$data['mensaje']      = "Se ha praducido un error";
  			$data['nombre']       = $this->input->post('nombre');
		    $data['descripcion']  = $this->input->post('descripcion');
		    $data['fabricante']   = $this->input->post('fabricante');
		    $data['precio']       = $this->input->post('precio');
		    $data['stock']        = $this->input->post('stock');
		    $data['id_categoria'] = $this->input->post('id_categoria');
		    
  			$this->load->view('productos/alta',$data);
  		} else {
  			redirect('productos/index');
  		}
  	} elseif ($this->input->post('cancelar')) {
  		redirect('productos/index');
  	} else {
  		    
  			$data['nombre']       = '';
		    $data['descripcion']  = '';
		    $data['fabricante']   = '';
		    $data['precio']       = '';
		    $data['stock']        = '';
		    $data['id_categoria'] = '2';
  		$this->load->view('productos/alta', $data);
  	}
  	
  }
}