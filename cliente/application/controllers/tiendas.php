<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas extends CI_Controller {

	function index(){
		
		$this->template->load('template','tiendas/index');
		
	}
	/**
	 * Se comprueba que el usuario este logeado y se inicia el proceso de creación.
	 * Si por algún motivo se sale de la linea de la creación se permitira volver a ella
	 * o eliminar el proceseso.
	 */
	function creacion_instrumento($id_categoria=null) {
		/*
		 * Primero comprueba que este iniciada al sessión, sino no le deja.
		 */
		$this->utilidades->comprobar_logueo();
		
		if($id_categoria !=null) {
			
			if($id_categoria == 1 || $id_categoria == 2) {
				
				$this->session->set_userdata('id_categoria', $id_categoria);
			} else {
				
				$datos['mensaje'] = "Se ha producido un error, vuelve a intentarlo.";
				$this->template->load('template','usuarios/error', $datos);
			}
		}
		
		if ($this->input->post('anadir_producto')) {
			
			if (!$this->session->userdata('id_piezas')) {
				$this->session->set_userdata('id_piezas',$this->input->post('id_piezas'));
			}
			$id_producto = $this->input->post('id_producto');
			$id_tipo_producto = $this->input->post('id_tipo_producto');
			$cesta = $this->session->userdata('cesta');
			$numero_paso = $this->session->userdata('numero_paso');
			unset($cesta[$numero_paso]);
			$cesta += array($numero_paso => $id_producto);
			$this->session->set_userdata('cesta',$cesta);
			$this->comprobar_producto($id_tipo_producto);
			$this->proceso_creacion();
				
		} elseif ($this->input->post('orden') ||  $this->input->post('continuar')) {
			
			$this->proceso_creacion();
			
		} elseif ($this->input->post('anterior')) { 
			
			$numero_paso = $this->session->userdata('numero_paso');
			$numero_paso--;
			$this->session->set_userdata('numero_paso', $numero_paso);
			$this->proceso_creacion();
			
		} else {
			/*
			 * Comprueba que el numero de paso que va y si existe la cesta.
			 */
			if (!$this->session->userdata('cesta')) {
				$cesta = array();
				$this->session->set_userdata('cesta',$cesta);
				$this->session->set_userdata('numero_paso', 1);
				$this->proceso_creacion();
			} else {
				if($this->input->post('elimina_cesta')) {
					$this->session->unset_userdata('cesta');
					$this->session->unset_userdata('id_categoria');
					$this->session->unset_userdata('numero_paso');
					$this->session->unset_userdata('id_piezas');
					$this->session->unset_userdata('completado');
					redirect('tiendas/index');
				} else {
					$this->template->load('template','tiendas/vaciar_cesta');
				}
			}
		}
	}
	
	/**
	 * Controla todos los pasos que se hacen hasta llegar al fin de la creación del instrumento.
	 */
	private function proceso_creacion() {
		
		$numero_paso = $this->session->userdata('numero_paso');
		$id_instumento = $this->session->userdata('id_instrumento');
		
		switch ($numero_paso) {
			case 1:
				#Selecciona el cuerpo del instrumento.
				$datos['mensaje'] = "Selecciona un cuerpo para tú guitarra.";
				$producto = "where id_tipo_producto = 1 and id_categoria = " . $this->session->userdata('id_categoria') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto, $busqueda);
			break;
			case 2:
				#Selecciona el mástil de instrumento.
				$datos['mensaje'] = "Selecciona el Mástil.";
				$producto = "where id_tipo_producto = 6 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " . 
				$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 3:
				#Selecciona las pastillas de instrumento.
				$datos['mensaje'] = "Selecciona pastillas.";
				$producto = "where id_tipo_producto in (2,3,4,5) and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 4:
				#Selecciona el clavijero del instrumento.
				$datos['mensaje'] = "Selecciona el clavijero.";
				$producto = "where id_tipo_producto = 7 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
						     $this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 5:
				#Selecciona la cejuela del instrumento.
				$datos['mensaje'] = "Selecciona la cejuela.";
				$producto = "where id_tipo_producto = 9 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 6:
				#Selecciona el puente del instrumento.
				$datos['mensaje'] = "Selecciona el puente.";
				$producto = "where id_tipo_producto = 10 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 7:
				#Selecciona los potenciometros del instrumento.
				$datos['mensaje'] = "Selecciona los potenciometros.";
				$producto = "where id_tipo_producto = 11 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 8:
				#Selecciona la conexión jack.
				$datos['mensaje'] = "Selecciona la conexión Jack.";
				$producto = "where id_tipo_producto = 12 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 9:
				#Selector de Posición.
				$datos['mensaje'] = "Selector de Posición.";
				$producto = "where id_tipo_producto = 13 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
							$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 10:
				#Selector de Pickguard.
				$datos['mensaje'] = "Selector de Pickguard.";
				$producto = "where id_tipo_producto = 14 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas = " .
						$this->session->userdata('id_piezas') . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 11:
				#Selector de Cuerdas.
				$datos['mensaje'] = "Selector de Cuerdas.";
				$producto = "where id_tipo_producto = 8 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas in (" .
						$this->session->userdata('id_piezas').",4)" . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			case 12:
				#Otras partes compatibles con tu guitarra.
				$datos['mensaje'] = "Otras partes compatibles con tu guitarra.";
				$producto = "where id_tipo_producto = 15 and id_categoria = " . $this->session->userdata('id_categoria') . " and id_piezas in (" .
						$this->session->userdata('id_piezas').",4)" . " and stock > 0 ";
				$busqueda = $this->comprueba_busqueda();
				$datos['busqueda'] = $busqueda;
				$datos['filas'] = $this->Producto->obten_producto_creacion($producto);
			break;
			default:
				#Aquí entrara cuando el numero sea superior a 12, siendo así cuando se ha terminado la creación.
				$this->instrumento_completado();
			break;
		}
		$datos['columna'] = '';
		$datos['criterio'] = '';
		$this->template->load('template','tiendas/creacion_guitarra', $datos);
		
	}
	
	private function comprueba_busqueda() {
		
		if ($this->busqueda_criterio() && $this->input->post('columna') == 'id_producto') {
		
			if ($this->session->userdata('producto') == '') {
		
				$busqueda = "and " . $this->session->userdata('columna') .
				" = " . $this->session->userdata('criterio') ;
			} else {
					
				$busqueda = "and " . $this->session->userdata('columna') .
				" = " . $this->session->userdata('criterio') ;
			}
				
		} elseif ($this->busqueda_criterio()) {
		
				
			if ($this->session->userdata('producto') == '') {
					
				$busqueda = "and " . $this->session->userdata('columna') . " like " .
						" '%" . $this->session->userdata('criterio') ."%'";
			} else {
				$busqueda = "and " . $this->session->userdata('columna') . " like " .
						" '%" . $this->session->userdata('criterio') ."%'";
			}
		} else {
		
			$busqueda = '';
		}
		
		return $busqueda;
	}
	
	/**
	 *  Se comprueba si la vista mando datos al controlador, si es así se gualdaran en las variables de
	 *  sessión para complementar la sentencia SQL.
	 *  @return Devuelve verdadero si la vista envio datos y falso sino.
	 */
	private function busqueda_criterio() {
	
		if ($this->input->post('buscar') && $this->input->post('criterio') != '' &&
		    $this->session->userdata('tipo_producto') != $this->input->post('tipo_producto')) {
				
			$this->session->set_userdata('criterio',$this->input->post('criterio'));
			$this->session->set_userdata('columna', $this->input->post('columna'));
			$this->session->set_userdata('tipo_producto', $this->input->post('tipo_producto'));
				
			return true;
				
		} elseif ($this->input->post('buscar') && $this->input->post('criterio') != '') {
				
			$this->session->set_userdata('criterio',$this->input->post('criterio'));
			$this->session->set_userdata('columna', $this->input->post('columna'));
				
			return true;
				
		} else {
				
			$this->session->set_userdata('criterio','');
			$this->session->set_userdata('columna', '');
				
			return false;
		}
	}
	
	/**
	 * Comprueba si llega desde la seleccion de pastillas.
	 */
	private function comprobar_producto($id_tipo_producto) {
		if($id_tipo_producto != 4 && $id_tipo_producto != 2 && $id_tipo_producto != 3) {
			$numero_paso = $this->session->userdata('numero_paso');
			$numero_paso++;
			$this->session->set_userdata('numero_paso', $numero_paso);
		} elseif($this->input->post('continuar')) {
			$numero_paso = $this->session->userdata('numero_paso');
			$numero_paso++;
			$this->session->set_userdata('numero_paso', $numero_paso);
		} 	
	}
	
	/**
	 * Terminar creación de producto, se alamacenará todos los datos en la base de datos.
	 * La operción teniendo encuenta los posibles problemas, si hay algún problema se olvera al estado anterior.
	 */
	function instrumento_completado() {
		
		$this->utilidades->comprobar_logueo();
		
		if($this->input->post('realizar_pedido')) {
			// Aquí se realiza toda la operación, creando una factura nueva contodo lo que ello conlleva. 
			if($this->Tienda->nuevo_pedido()) {
				
				$this->session->unset_userdata('cesta');
				$this->session->unset_userdata('id_categoria');
				$this->session->unset_userdata('numero_paso');
				$this->session->unset_userdata('id_piezas');
				$this->session->unset_userdata('completado');
				$this->session->set_flashdata('mensaje', 'Proceso completado.');
				redirect('usuarios/index');							
			} else {
				$this->session->set_flashdata('mensaje', 'Se ha producido un error, intentelo denuevo.');
				$this->template->load('template','usuarios/cesta', $datos);
				
			}
		} elseif ($this->input->post('elimina_cesta')) {
			
			$this->session->unset_userdata('cesta');
			$this->session->unset_userdata('id_categoria');
			$this->session->unset_userdata('numero_paso');
			$this->session->unset_userdata('id_piezas');
			$this->session->unset_userdata('completado');
			redirect('tiendas/index');
			
		} else {
			
			$this->session->set_userdata('completado', true);
			redirect('usuarios/cesta');
			
		}
	}
	
	/**
	 * Muestra la factura con todo detalle.
	 */
	function muestra_factura($id_pedido) {
		if(is_numeric($id_pedido)) {
			$datos = $this->Tienda->obten_factura($id_pedido);
			//var_dump($datos);
			$this->load->view('usuarios/factura',$datos);
			
		} else {
			
			$datos['mensaje'] = "Los datos recibidos no son correctos.";
			$this->template->load('template','usuarios/error', $datos);	
		}
	}
	
	/**
	 * Se obtiene los datos y genera la factura en pdf.
	 */
	  function obtener_factura_en_pdf($id_pedido) {
	  	//Obtiene la factura, las filas y el usuario.
	  	$datos = $this->Tienda->obten_factura($id_pedido);
	  	
	  	require_once('/var/www/web/proyecto/cliente/application/libraries/tcpdf/config/lang/spa.php');
	  	require_once('/var/www/web/proyecto/cliente/application/libraries/tcpdf/tcpdf.php');
	  	// Crear el documento
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// Muy importante poner esta linea sino dara un error, como que ya fue generado.
		ob_end_clean();
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Music Band Center S.L');
		$pdf->SetTitle('Factura Pedido Numero');
		$pdf->SetSubject('Music Band Center Sopote Web');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		// add a page
		$pdf->AddPage();
		// set font
		$pdf->SetFont('times', 'B', 10);
		
		//Imagen para la factura.
		$pdf->Image('/var/www/web/proyecto/cliente/estilos/logo_plano.png', 90,5,40,15);
		$factura = $datos['factura'];
		//$pdf->Text(90,5,"Music Band Center S.L");
		$pdf->Ln();
		$pdf->Text(9,20,"Número de Factura: ".$factura['id_factura'].".");
		$pdf->Ln();
		$pdf->Text(9,25,"Número de Pedido: ".$factura['id_pedido'].".");
		$pdf->Ln();
		$pdf->Text(9,30,"Fecha: ".$factura['fecha'].".");
		$pdf->Ln();
		$pdf->Text(95,35," Datos del Cliente.");
		$pdf->Ln();
		$pdf->Text(9,40,"DNI: ".$factura['dni'].".");
		$pdf->Ln();
		$pdf->Text(9,45,"Nombre: ".$factura['nombre_fat'] ." ". $factura['apellidos'].".");
		$pdf->Ln();
		$pdf->Text(9,50,"Dirección: ".$factura['direccion'] .".");
		$pdf->Ln();
		$pdf->Text(9,55,"Teléfono: ".$factura['telefono'] .".");
		$pdf->Ln();
		$pdf->Text(9,60,"    ");
		$pdf->Ln();
		
		// Datos de la celda.
		$filas = $datos['filas'];
		$total = 0;
		$iva = 0;
		// Fila de cabecera!!
		$pdf->Cell(15,5,'Código',1);
		$pdf->Cell(90,5,'Nombre Producto',1);
		$pdf->Cell(25,5,'Fabricante',1);
		$pdf->Cell(35,5,'Compatible',1);
		$pdf->Cell(20,5,'Precio',1);
		$pdf->Ln();
		foreach ($filas as $var) {
			extract($var);
			// Ahora se crea una linea de la factura.
			$pdf->Cell(15,5,$id_producto,1);
			$pdf->Cell(90,5,$nombre_prod,1);
			$pdf->Cell(25,5,$fabricante,1);
			$pdf->Cell(35,5,$pc_nombre,1);
			$pdf->Cell(20,5,$precio."€",1);
			$pdf->Ln();
			$total += $precio;
		}
		
		$iva = ($total * 18)/100;
		$total = $total + $iva;
		$pdf->Cell(165,5,'IVA',1);
		$pdf->Cell(20,5,$iva."€",1);
		$pdf->Ln();
		$pdf->Cell(165,5,'Total a Pagar',1);
		$pdf->Cell(20,5,$total."€",1);
		
		//Close and output PDF document
		$pdf->Output("factura_numero".$factura['id_factura'].".pdf", 'I');
		
		// Muy importante poner esta linea sino dara un error, como que ya fue generado.
		ob_end_clean();
				
	  }
}
