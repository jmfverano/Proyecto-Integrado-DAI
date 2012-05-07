<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends CI_Model {

	function obtener_todos() {
		/*
		 * Se obtiene todos los datos, indicando el orden.
		*/
	
		if ($this->input->post('orden')) {
			if($this->session->userdata('orden') == $this->input->post('orden')) {
				if ($this->session->userdata('tipo') == "asc") {
					$this->session->set_userdata('tipo','desc');
					$tipo = $this->session->userdata('tipo');
					$orden = $this->input->post('orden');
				} else  {
					$this->session->set_userdata('tipo','asc');
					$tipo = $this->session->userdata('tipo');
					$orden = $this->input->post('orden');
				}
			} else {
				$orden = $this->input->post('orden');
				$this->session->set_userdata('orden',$orden);
				$this->session->set_userdata('tipo','asc');
				$tipo = $this->session->userdata('tipo');
			}
		} else {
			$this->session->set_userdata('orden','nombre_usu');
			$orden = $this->session->userdata('orden');
			$this->session->set_userdata('tipo','asc');
			$tipo = $this->session->userdata('tipo');
		}
		
		
		if($this->input->post('criterio') && $this->input->post('columna')) {
			$criterio = $this->input->post('criterio');
			$columna  = $this->input->post('columna');
			return $this->db->query("select * from provedores where $columna like '%$criterio%' order by $orden $tipo")->result_array();
		} else {
			return $this->db->query("select * from proveedores order by $orden $tipo")->result_array();
		}
	}
}