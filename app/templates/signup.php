<?php 

  $this->layout('master', [
      'title'=>'Sign up',
      'desc'=>'Register your account'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Welcome to Sale Detectives!</h2>
  </div>

<!-- Main section -->
<main class="signup-bg">
  <section class="signup">
  	<form action="index.php?page=signup" method="post" id="register">
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="example@example.com">
                  
					<?php  if( isset($emailMessage) ) : ?>

                  	<small class="text-muted" id="emailMessage"><?= $emailMessage ?></small>
                  	
                  	<?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  <small class="text-muted" id="passwordMessage"></small>
                </div>
                <div class="form-group">
                  <label for="confirm-password">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Type your password again">
                  <small class="text-muted" id="confirmPasswordMessage"></small>
                </div>
                <div class="form-group">
                  <label for="username">User Name</label>
                  <input type="text" class="form-control" name="username" id="username">
                  <small class="text-muted" id="usernameMessage">User Name only has alphabets and numbers</small>
                </div>
            </div>
            <div class="modal-footer">
              <small class="text-muted" id="formMessage"></small>
              <input type="hidden" name="new-account-button">
              <input type="submit" id="new-account" class="btn btn-primary" value="Sign Up">
              <!-- <input id="new-account" type="submit" name="new-account" value="Sign Up"> -->
            </div>
    </form>
  </section>
</main>