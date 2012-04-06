<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades {
 
  function comprobar_logueo() {
    $CI =& get_instance();
    if (!$CI->session->userdata('id_usuario')) {
      $CI->session->set_flashdata('mensaje', 'Se requiere autorización');
      redirect('usuarios/login');
    }
  }
}
