<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gaming Store</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Gaming Store</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
            <?php if(!$this->session->userdata('logged_in')) : ?>
              <li><a href="<?php echo base_url(); ?>users/register">Create Account</a></li>
            <?php endif; ?>
          </ul>
          <?php if(!$this->session->userdata('logged_in')) : ?>
            <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>users/login">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Username" name="username">
                <input type="password" class="form-control" placeholder="Enter Paassword" name="password">
              </div>
              <button name="submit" type="submit" class="btn btn-default">Login</button>
            </form>
          <?php else : ?>
            <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>users/logout">
              <button name="submit" type="submit" class="btn btn-default">Logout</button>
            </form>
          <?php endif; ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <?php $this->load->view('layouts/includes/sidebar'); ?>
          </div>
        </div>
        <!-- Left Sidebar finished -->

        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading panel-heading-green">
              <h3 class="panel-title">Latest Releases</h3>
            </div>
            <div class="panel-body">