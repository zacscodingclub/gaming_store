<?php
  class Cart extends CI_Controller{
    public $paypal_data = '';
    public $tax;
    public $shipping;
    public $total = 0;
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

    // process form
    // paypal integration
    public function process(){
      if($_POST){
        foreach($this->input->post('item_name') as $key => $value){
          $item_id = $this->input->post('item_code')[$key];
          $product = $this->Product_model->get_product_details($item_id);

          // assign data to Paypal
          $this->paypal_data .='&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($product->title);
          $this->paypal_data .='&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($item_id);
          $this->paypal_data .='&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($product->price);
          $this->paypal_data .='&L_PAYMENTREQUEST_0_QTY'.$key.'='.urlencode($this->input->post('item_qty')[$key]);

          $subtotal =($product->price * $this->input->post('item_qty')[$key]);
          $this->total = $this->total + $subtotal;

          $paypal_product['items'] = array(
                    'item_name'     =>$product->title,
                    'item_price'    =>$product->price,
                    'item_code'     =>$item_id,
                    'item_qty'      =>$this->input->post('item_qty')[$key]
                    );

          $order_data = array(
                    'product_id'    => item_id,
                    'user_id'       => $this->session->userdata('user_id'),
                    'transaction_id'=> 0,
                    'qty'           => $this->input->post('item_qty')[$key],
                    'address'      => $this->input->post('address'),
                    'address2'      => $this->input->post('address2'),
                    'city'          => $this->input->post('city'),
                    'state'         => $this->input->post('state'),
                    'zipcode'       => $this->input->post('zipcode')
                    );

          // add order data to db
          $this->Product_model->add_order($order_data);

        }
      }

      // get grand total
      $this->grand_total = $this->total + $this->tax + $this->shipping;

      // array of costs
      $paypal_product['assets'] = array(
                  'tax_total'      => $this->tax,
                  'shipping_cost'  => $this->shipping,
                  'grand_total'    => $this->total
                  );

      $_SESSION["paypal_products"] = $paypal_product;
    }
  }