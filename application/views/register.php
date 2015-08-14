<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>

<form method="post" action="<?php echo base_url(); ?>users/register">
  <div class="form-group">
    <label>First Name*</label>
    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" />
  </div>
  <div class="form-group">
    <label>Last Name*</label>
    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" />
  </div>
  <div class="form-group">
    <label>Email Address*</label>
    <input type="email" name="email" class="form-control" placeholder="Enter Email" />
  </div>
  <div class="form-group">
    <label>User Name*</label>
    <input type="text" name="username" class="form-control" placeholder="Enter User Name" />
  </div>
  <div class="form-group">
    <label>Password*</label>
    <input type="password" name="pass1" class="form-control" placeholder="Enter Password" />
  </div>
  <div class="form-group">
    <label>Confirm Password*</label>
    <input type="password" name="pass2" class="form-control" placeholder="Reenter Password" />
  </div>
  <button name="submit" type="submit" class="btn btn-primary">Register</button>
</form>