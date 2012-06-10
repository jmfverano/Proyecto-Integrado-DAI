<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends CI_Model {

	function modificar_estado($id_pedido,$estado) {
		
		$this->db->query('UPDATE pedidos SET estado = ? WHERE id_pedido = ?', array($estado, $id_pedido));
		return $this->db->affected_rows();
	}
 
}
