<?php 
class Products extends CI_Controller{
  public function index(){
    $data['main_content'] = "products";
    // Load View
    $this->load->view("layouts/main", $data);
  }
}