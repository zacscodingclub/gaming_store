<?php
  class Product_model extends CI_Model{
    // get all prodcuts
    public function get_products() {
      $this->db->select('*');
      $this->db->from('products');
      $query = $this->db->get();
      return $query->result();
    }

    // get single prodcut
    public function get_product_details($id) {
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where('id', $id);

      $query = $this->db->get();
      return $query->row();
    }
    
    // get categories
    public function get_categories() {
      $this->db->select('*');
      $this->db->from('categories');
      $query = $this->db->get();
      return $query->result();
    }

    // get popular products
    public function get_popular() {
      $this->db->select('P.*, COUNT(O.product_id) as total');
      $this->db->from('orders AS O');
      $this->db->join('products AS P', 'O.product_id = P.id', 'INNER');
      $this->db->group_by('O.product_id');
      $this->db->order_by('total','desc');
      $query = $this->db->get();
      return $query->result();
    }

    // add order to database
    public function add_order($order_data){
      $insert = $this->db->insert('orders', $order_data);
      return $insert;
    }
  }