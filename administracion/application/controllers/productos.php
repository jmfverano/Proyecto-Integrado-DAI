<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
  
  function __construct() {		
    CI_Controller::__construct();
  }

  function index() {
  	# Se comprobara el logueo antes mostrar algun dato.
  	$this->utilidades->comprobar_logueo(); 
 	
  	if(!$this->input->post('columna') || !$this->input->post('criterio')) {
  		$data['columna'] = '';
  		$data['criterio'] = '';
  		$data['filas'] = $this->Producto->obtener_productos();
  		$this->template->load('template','productos/index', $data);
  		
  	} else {
  		
  		$data['columna'] = $this->input->post('columna');
  		$data['criterio'] = $this->input->post('criterio');
  		$data['filas'] = $this->Producto->obtener_productos_criterio();
  		$this->template->load('template','productos/index', $data);
  	} 
  	
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
		    $data['id_tipo_producto'] = $this->input->post('id_tipo_producto');
		    
  			$this->template->load('template','productos/alta',$data);
  			
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
		    
		    #Se obtienen las categorias existentes.
		    $filas = $this->Producto->obten_categoria();
		    $aux_cat = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_cat += array($id_categoria => $tipo_instrumento); 
		    }
		   
		    #Se obtienen los provedores existentes.
		    $filas = $this->Producto->obten_proveedor();
		    $aux_pro = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_pro += array($id_proveedor => $nombre_prov); 
		    }
		    
		    #Se obtienen los tipo de productos existentes.
		    $filas = $this->Producto->obten_tipo();
		    $aux_tipo = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_tipo += array($id_tipo_producto => $tnomb_producto);
		    }
		    #Se obtiene los datos de las compatibilidad entre tipo de productos.
  			$filas = $this->Producto->obten_piezas_compatibles();
		    $aux_piezas = array();
		    foreach ($filas as $fila) {
		    	extract($fila);
		    	$aux_piezas += array($id_piezas => $pc_nombre);
		    }
		    
		    $data['proveedor'] = $aux_pro;
		    $data['categoria'] = $aux_cat;
		    $data['tipo'] = $aux_tipo;
		    $data['pieza_compatible'] = $aux_piezas;
		    
  		$this->template->load('template','productos/alta',$data);
  	}
  	
  }
}