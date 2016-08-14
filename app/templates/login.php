<?php 

  $this->layout('master', [
      'title'=>'Log in',
      'desc'=>'Log in your account'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Welcome to Sale Detectives!</h2>
  </div>

<!-- Main section -->
<main class="signup-bg">
  <section class="signup">
  	<form action="index.php?page=login" method="post">
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" name="email" id="login-email" aria-describedby="emailHelp" placeholder="example@example.com" value="<?= isset($_POST['email']) ? ($_POST['email']) : '' ?>">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="login-password" placeholder="Password" value="<?= isset($_POST['password']) ? ($_POST['password']) : '' ?>">
                </div>
      
            </div>
            <div class="modal-footer">
              <?php if(isset($loginMessage)): ?>
              <small class="text-muted"><?= $loginMessage ?></small>
              <?php endif ?>
              <button type="button" class="btn btn-default" data-dismiss="modal">Forget my password</button>
              <input type="submit" name="login-button" class="btn btn-primary" value="Log In">
            </div>
    </form>
  </section>
</main>