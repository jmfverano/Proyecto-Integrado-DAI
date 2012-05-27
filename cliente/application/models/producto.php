<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Model {

	/**
	 * ------------ Tabla Producto -----------
	 * id_tipo_producto |    tnomb_producto
	   -----------------+---------------------
	 	  			  1 | Cuerpo
	                  2 | Pastilla Puente
                 	  3 | Pastilla Mastil
	                  4 | Pastilla central
	                  5 | Set de pastillas
	                  6 | Mastil
	                  7 | Clavijero
	                  8 | Cuerdas
	                  9 | Cejuela
	                 10 | Puente
	                 11 | Potenciometro
	                 12 | Conexión Jack
	                 13 | Selector de Posición
	                 14 | Guarda Puas
	                 15 | Otros
	   -----------------+---------------------
	 La tabla de tipo de pruducto tiene estos productos en el momento de la creación.
	 */


	function obten_producto($busqueda=null, $datos_orden=null) {
		
		$producto = $this->session->userdata('producto');
		/**
		 * Obtiene el numero de filas que tiene en la base de datos.
		 */
		$numero = $this->db->query("Select *
				from productos
				$producto $busqueda ")->num_rows();

		/**
		 * Se comprueba que hay almenos más de 5 lineas de producto, si es mayor realiza todos
		 * los calculos para realizar el paginador.
		 * En esta primera versión el paginador se reiniciara si realiza un busqueda.
		 */
		if($numero > 5) {

			$datos['numero_paginas'] = $num_paginas = ceil($numero / 5);
			if($this->input->post('numero_pagina') && $this->input->post('numero_pagina') != 1) {

				$numero_pagina = $this->input->post('numero_pagina');
				$limit = 5;
				$offset = 5 * ($numero_pagina - 1);

				$datos_paginador = "limit $limit offset $offset";

			} else {
				$datos_paginador = "limit 5 offset 0";
			}
		} else {
			$datos_paginador = '';
		}

		$datos['filas'] = $this->db->query("Select *
				from productos natural join categorias natural join proveedores 
				natural join tipo_productos natural join piezas_compatibles
				$producto
				$busqueda
				$datos_orden
				$datos_paginador")->result_array();
		return $datos;
	}
	
	function obten_tipo_producto() {
		
		return $this->db->query("Select id_tipo_producto as id, tnomb_producto as tipo  from tipo_productos")->result_array();
	}
}