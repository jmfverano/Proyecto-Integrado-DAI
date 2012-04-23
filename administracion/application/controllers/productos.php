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
  			$data['nombre_prod']  = $this->input->post('nombre_prod');
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
  		    
  			$data['nombre_prod']       = '';
		    $data['descripcion']  = '';
		    $data['fabricante']   = '';
		    $data['precio']       = '';
		    $data['stock']        = '';
		    
		    #Se obtienen las categorias  existentes.
		    $filas = $this->Producto->obten_categoria();
		    $aux_cat = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_cat += array($id_categoria => $tipo_instrumento); 
		    }
		   
		    #Se obtienen los provedores  existentes.
		    $filas = $this->Producto->obten_proveedor();
		    $aux_pro = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_pro += array($id_proveedor => $nombre_prov); 
		    }
		    $data['proveedor'] = $aux_pro;
		    $data['categoria'] = $aux_cat;
  		$this->load->view('productos/alta', $data);
  	}
  	
  }
}