<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tiendas extends CI_Controller {

	function __construct() {
		CI_Controller::__construct();
		$this->load->model('Usuario');
	}
}