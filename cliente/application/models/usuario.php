<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {

	function obtener_id() {
		return $this->session->userdata('id_usuario');
	}

	function comprobar_usuario($email, $password){
		 
		return $this->db->query("select * from usuarios
  		                         where email = ? and password = md5(?) and admin = true", array($email, $password));	
	}

	function crear($email, $password, $nombre_usu, $apellidos) {
		$res = $this->_nombre_utilizado($email);
		$confirm_password = $this->input->post('confirm_password');
		if($email != '' && $password != '' && $confirm_password != '' && $nombre_usu != '' && $apellidos != '' && empty($res)
		&& $password == $confirm_password) {
			return $this->db->query("insert into usuarios (email, password, nombre, apellidos)
		                                     values (?,md5(?),?,?)",array($email, $password, $nombre_usu, $apellidos));
		} else {
			return false;
		}
	}

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
		
		return $this->db->query("select * from usuarios order by $orden $tipo")->result_array();
	}

	function obtener_usuario() {
		$id_usuario = $this->session->userdata('id_usuario');
		return $this->db->query("select * from usuarios where id_usuario = $id_usuario")->row_array();
	}

	function obtener_seleccion() {
		$criterio = $this->input->post('criterio');
		$columna  = $this->input->post('columna');
		return $this->db->query("select * from usuarios where $columna like '%$criterio%'")->result_array();
	}

	function actualizar_usuario($datos) {
		$this->db->where('id_usuario',$datos['id_usuario']);
		unset($datos['id_usuario']);
		return $this->db->update('usuarios',$datos);
	}

	function obtener_datos($email) {
		if ($email != '') { # Comprueba que el email no este vacio.
			return $this->db->query("select * from usuarios where email = ?", array($email))->row_array();
		} else {
			return false;
		}
	}

	function borrar() {
		$id_usuario = $this->session->userdata('id_usuario');
		return $this->db->query("delete from usuarios where id_usuario = ?", array($id_usuario));
	}

	function datos_usuario(){
		$id_usuario = $this->session->userdata('id_usuario');
		return $this->db->query("select * from usuarios where id_usuario = ?", array($id_usuario))->row_array();;
	}

	function pedidos_usuario() {
		$id_usuario = $this->session->userdata('id_usuario');
		return $this->db->query("select * from pedidos where id_usuario = ?", array($id_usuario))->result_array();
	}

	function insertar_nuevo() {
		 
		$datos['email'] = $this->input->post('email');
		$datos['password'] = md5($this->input->post('password'));
		$datos['nombre_usu'] = $this->input->post('nombre_usu');
		$datos['apellidos'] = $this->input->post('apellidos');
		$datos['dni'] = $this->input->post('dni');
		$datos['direccion'] = $this->input->post('direccion');
		$datos['telefono'] = $this->input->post('telefono');
		 
		return $this->db->insert('usuarios', $datos);  
	}
	
	function borrar_usuario() {
		
		$id_usuario = $this->input->post('id_usuario');
		return $this->db->query('delete from usuarios where id_usuario = ?', array($id_usuario));
		
	}
	/**
	 * Busca todos los productos que ha sido añadido en la cesta.
	 */
	function obten_productos_cesta() {
		
		$cesta = $this->session->userdata('cesta');
		$datos = array();
		$query = "Select * from productos natural join categorias natural join piezas_compatibles
				  natural join tipo_productos where id_producto =";
		$bool  = false;
		foreach ($cesta as $v) {
			
			if($v != '') {
				
				$query = "Select * from productos natural join categorias natural join piezas_compatibles
				natural join tipo_productos where id_producto = $v";
				$datos_new = $this->db->query($query)->result_array();
			}
			
			$datos = array_merge($datos, $datos_new);
		}

		return $datos;
	}
}
