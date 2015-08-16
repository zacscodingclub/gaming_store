<?php
  // get categories
  function get_categories_h() {
    $CI = get_instance();
    $categories = $CI->Product_model->get_categories();
    return $categories;
  }

  function get_popular_h() {
    $CI = get_instance();
    $popular_products = $CI->Product_model->get_popular();
    return $popular_products;
  }