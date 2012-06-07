<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tienda extends CI_Model {
	
	/**
	 * En esta funcion se realizara las siguientes operaciones.
	 *   -> Nuevo Pedido.
	 *   -> Nueva Factura.
	 *   -> Añade las lineas de Factura.
	 *  En el proceso se comprobara si cada operación es correcta.
	 *  Si se encuentra algún problema se deshara el proceso por completo.
	 */
	function nuevo_pedido() {
		//Obtenemos los datos que serán necesarios para el proceso.
		
		$completado = true;
		$id_usuario = $this->session->userdata('id_usuario');
		$cesta = $this->session->userdata('cesta');
		
		//Iniciamos el Begin en el proceso escritura de la base de datos.
		$this->db->query("BEGIN");
		//Creamos el pedido primero.
		$this->db->query("insert into pedidos(id_usuario) values(?)", array($id_usuario));
		//Comprobamos si la operación es correcta.
		if($this->db->affected_rows() != 1) {
			$this->db->query("ROLLBACK");
			return $completado = false;
		}
		//Obtenemos el id del nuevo pedido.
		$datos = $this->db->query("Select id_pedido from pedidos where id_usuario = ? 
								   order by id_pedido desc limit 1",array($id_usuario))->row_array();
		$id_pedido = $datos['id_pedido'];
		//Creamos la nueva factura, con el id_pedido y id_usuario.
		$this->db->query("insert into facturas(id_usuario, id_pedido, dni, nombre_fat, apellidos, direccion, telefono)
						  select id_usuario, ?, dni, nombre_usu, apellidos, direccion, telefono
                          from usuarios where id_usuario = ?;",array($id_pedido, $id_usuario));
		//Comprobamos que se ha realizado correctamete.
		if($this->db->affected_rows() != 1) {
			$this->db->query("ROLLBACK");
			return $completado = false;
		}
		//Ahora obtenemos el numero de la factura.
		$datos = $this->db->query("Select id_factura from facturas where id_usuario = ? order by id_factura desc limit 1", array($id_usuario))->row_array();
		$id_factura = $datos['id_factura'];
		//Con un bucle añadimos todas las lines de facturas que son los productos que están en la cesta.
		foreach ($cesta as $id_producto) {
			$this->db->query("insert into linea_facturas(id_factura,id_producto,precio) select ?, id_producto, precio 
                              from productos where id_producto = ?", array($id_factura, $id_producto));
			//Se comprueba si el producto se añadio correctamente.
			if($this->db->affected_rows() != 1) {
				$this->db->query("ROLLBACK");
				return $completado = false;
			}
		}
		
		//Actualiza el stock de las piezas vendidas.
		foreach ($cesta as $id_producto) {
			$datos = $this->db->query("select stock from productos where id_producto = ?", array($id_producto))->row_array();
			$stock = $datos['stock'] - 1;
			$this->db->query("update productos set stock = ? where id_producto = ?", array($stock, $id_producto));
			//Se comprueba si el producto se actualizo correctamente.
			if($this->db->affected_rows() != 1) {
				$this->db->query("ROLLBACK");
				return $completado = false;
			}
		}
		//Si ha llegado hasta aquí en estado en true, es porque no ha generado ningún error.
		if($completado) {
			$this->db->query("COMMIT");
			return $completado;
		}
	}
	
	/**
	 * Devuelve la factura que esta asociada al pedido enviado.
	 */
	function obten_factura($id) {
		$id_pedido = $id;
		$datos = $this->db->query("Select id_usuario from pedidos where id_pedido = $id_pedido ")->row_array();
		$id_usuario = $datos['id_usuario'];
		if($id_usuario == $this->session->userdata('id_usuario')) {
			$datos['factura'] =  $this->db->query("Select * from facturas where id_pedido = $id_pedido ")->row_array();
			$factura = $datos['factura'];
			$id_factura = $factura['id_factura'];
			$datos['usuario'] =  $this->db->query("Select * from usuarios where id_usuario =$id_usuario")->row_array();
			$datos['filas'] = $this->db->query("Select * from linea_facturas natural join productos natural join piezas_compatibles natural join tipo_productos
                                                natural join categorias where id_factura = $id_factura")->result_array();
			return $datos;
		} else {
			
			return false;
		}
		
	}
 
}
