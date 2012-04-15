<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {
  
  function obtener_id() {
    return $this->session->userdata('id_usuario');
  }
  
  function comprobar_usuario($email, $password){
  	
  		return $this->db->query("select * from usuarios 
  		                         where email = ? and password = md5(?) and admin = true", array($email, $password));	
  }
  
  function crear($email, $password, $nombre, $apellidos) {
    $res = $this->_nombre_utilizado($email);
    $confirm_password = $this->input->post('confirm_password');
  	if($email != '' && $password != '' && $confirm_password != '' && $nombre != '' && $apellidos != '' && empty($res)
  	   && $password == $confirm_password) {
	  	  return $this->db->query("insert into usuarios (email, password, nombre, apellidos) 
		                                     values (?,md5(?),?,?)",array($email, $password, $nombre, $apellidos));
	  } else {
		  return false;
	  }
  }
  
  function obtener_todos() {
  	/*
  	 * Se obtiene todos los datos, indicando el orden.
  	 */
  	 if ($this->input->post('orden')) {
  	 	$orden = $this->input->post('orden');
  	 } else {
  	 	$orden = "nombre";
     return $this->db->query("select * from usuarios order by $orden asc")->result_array();
  	 }
  }
  
  function obtener_usuario() {
     $id_usuario = $this->input->post('id_usuario');
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

  function borrar($id_usuario) {
    return $this->db->query("delete from usuarios where id_usuario = ?", array($id_usuario));
  }
}
