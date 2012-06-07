<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->template->load('template','upload_form', array('error' => ' ' ));
		
	}

	function do_upload()
	{
		$config['upload_path'] = '/home/ulthane/web/proyecto/comun/imagen_producto/';
		var_dump(is_dir('/home/ulthane/web/proyecto/comun/imagen_producto/'));
		var_dump($_SERVER['SCRIPT_FILENAME']); 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']  = $this->session->userdata('id_producto_imagen');
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->template->load('template','upload_form', $error);
				
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->template->load('template','upload_success', $data);
				
		}
	}
}
?>