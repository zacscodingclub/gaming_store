<?php
  class Users extends CI_Controller {

    public function register(){
      // validation rules
      $this->form_validation->set_rules('first_name','First Name', 'trim|required');
      $this->form_validation->set_rules('last_name','First Name', 'trim|required');
      $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('username','Username', 'trim|required|min_length[4]|max_length[16]');
      $this->form_validation->set_rules('pass1','Password', 'trim|required|min_length[4]|max_length[50]');
      $this->form_validation->set_rules('pass2','Confirm Password', 'trim|required|matches[pass1]');

      if($this->form_validation->run() == FALSE){
        // load view
        $data['main_content'] = 'register';
        $this->load->view('layouts/main', $data);
      } else {
        if($this->User_model->register()) {
          $this->session->set_flashdata('registered', 'You are now registered and can login.');
          redirect('products');
        }
      }
      
    }

    public function login() {
      //validation rules
      $this->form_validation->set_rules('username','Username', 'trim|required|min_length[4]|max_length[16]');
      $this->form_validation->set_rules('password','Password', 'trim|required|min_length[4]|max_length[50]');

      $username = $this->input->post('username');
      $password = md5($this->input->post('password'));

      $user_id = $this->User_model->login($username, $password);

      //validate user
      if($user_id){
        // user data
        $data = array(
                'user_id' => $user_id,
                'username' => $username,
                'logged_in' => true,
                );

        // set session userdata
        $this->session->set_userdata($data);

        // set message
        $this->session->set_flashdata('pass_login', 'You are logged in');
        redirect('products');
      } else {
        // set error
        $this->session->set_flashdata('fail_login', 'Sorry, the login info is incorrect.  Please try again.');
        redirect('products');
      }
    }

    public function logout(){
      // unset user data
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('username');
      $this->session->sess_destroy();

      redirect('products');
    }
  }