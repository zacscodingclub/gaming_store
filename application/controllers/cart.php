<?php
  class Cart extends CI_Controller{
    public $paypal_data= '';
    public $tax;
    public $shipping;
    public $total= 0;
    public $grand_total;

    // default view
    public function index() {
      // load view
      $data['main_content'] = 'cart';
      $this->load->view('layouts/main', $data);
    }

    // add to cart
    public function add() {
      $data = array(
                'id' => $this->input->post('item_number'),
                'qty' => $this->input->post('qty'),
                'price' => $this->input->post('price'),
                'name' => $this->input->post('title')
              );

      // insert into cart
      $this->cart->insert($data);

      // load view
      redirect('products');
    }

    // update cart
    public function update() {
      $data = $_POST;
      $this->cart->update($data);

      // load view
      redirect('cart', 'refresh');
    }
  }