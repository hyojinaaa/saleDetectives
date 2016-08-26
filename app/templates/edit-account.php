<?php 

  $this->layout('master', [
      'title'=>'My account',
      'desc'=>'View your account state and edit'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>You can edit your account info at here!</h2>
  </div>

<!-- Main section -->
<main class="signup-bg">
  <section class="signup">
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data"> 
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="example@example.com" value="<?= $myAccount['email'] ?>">
                  
          <?php  if( isset($emailMessage) ) : ?>

                    <small class="text-muted" id="emailMessage"><?= $emailMessage ?></small>
                    
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                  <label for="username">User Name</label>
                  <input type="text" class="form-control" name="username" id="username" value="<?= $myAccount['username'] ?>">
                  <small class="text-muted" id="usernameMessage">User Name only has alphabets and numbers</small>
                </div>
          <fieldset class="form-group">
            <label for="image">Upload Profile Photo</label>
              <input type="file" class="form-control-file" id="image" name="image">
            <small class="text-muted review-error"><?= isset($imageError) ? $imageError : '' ?></small>
          <br>
 
    <img src="img/uploads/review/individual/<?= $myAccount['image'] ?>">
   
  <br>
    <small class="text-muted review-error"><?= isset($imageError) ? $imageError : '' ?></small>
  </fieldset>
  

            </div>
            <div class="modal-footer">
              <small class="text-muted" id="formMessage"></small>
              <input type="submit" name="update-account" class="btn btn-primary" value="Update Info">
            </div>
    </form>
  </section>
</main>