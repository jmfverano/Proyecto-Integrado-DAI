<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Model {

	function obtener_productos() {
		return $this->db->query("Select * from productos natural join categorias")->result_array();
	}

	function alta_producto() {

		$nombre       = $this->input->post('nombre');
		$descripcion  = $this->input->post('descripcion');
		$fabricante   = $this->input->post('fabricante');
		$precio       = $this->input->post('precio');
		$stock        = $this->input->post('stock');
		$id_categoria = $this->input->post('id_categoria');

		if ($nombre == '' or
		$descripcion == '' or
		$fabricante == '' or
		$precio == '' or
		$stock == '') {

			return false;

		} else {
			$this->db->query("insert into productos(nombre, descripcion, fabricante, precio, stock, id_categoria) values (?,?,?,?,?,?)",
			array($nombre,$descripcion, $fabricante, $precio, $stock, $id_categoria));
			return true;
		}
	}

}