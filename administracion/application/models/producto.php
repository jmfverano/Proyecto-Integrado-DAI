<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Model {

	function obtener_productos() {
		return $this->db->query("Select * from productos natural join categorias natural join proveedores natural join tipo_productos")->result_array();
	}
		
	function alta_producto() {

		$nombre_prod  = $this->input->post('nombre_prod');
		$descripcion  = $this->input->post('descripcion');
		$fabricante   = $this->input->post('fabricante');
		$precio       = $this->input->post('precio');
		$stock        = $this->input->post('stock');
		$id_categoria = $this->input->post('id_categoria');
		$id_proveedor = $this->input->post('id_proveedor');
		$id_tipo_producto = $this->input->post('id_tipo_producto');
		
		if ($nombre_prod == '' or
		$descripcion == '' or
		$fabricante == '' or
		$precio == '' or
		$stock == '') {

			return false;

		} else {
			$this->db->query("insert into productos(nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_tipo_producto) values (?,?,?,?,?,?,?,?)",
			array($nombre_prod,$descripcion, $fabricante, $precio, $stock, $id_categoria, $id_proveedor, $id_tipo_producto));
			return true;
		}
	}

	function obten_proveedor() {
		
		return $this->db->query("Select * from proveedores")->result_array();
	}
	
function obten_categoria() {
		
		return $this->db->query("Select * from categorias")->result_array();
	}
	
function obten_tipo() {
	
		return $this->db->query("Select * from tipo_productos")->result_array();
	}
	
}