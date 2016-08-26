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
<main class="account">
  <section class="main">
  <?php if($_SESSION['privilege'] == 'admin'): ?>
    <h3 class="admin">Administer</h3>
  <?php endif; ?>
  <img src="<?= $userData['profile_photo'] ?>">
  <a href=""><h2><?= $userData['username'] ?></h2></a>
  <h3>Email Address : <?= $userData['email'] ?></h3>

  <h3>My ranking point: <?= $userData['star_point'] ?> pt</h3>
  <form action="index.php?page=edit-account&id=<?= $userData['id'] ?>" method="post">
    <input type="submit" class="btn review-btn" value="Update your info" name="edit-account">
  </form>
  <hr>
  <h3>Active Log</h3>
    <div class="row" id="active-log">
      <div class="col-lg-4 col-lg-offset-2">
        <h4>My Reviews</h4>
      </div>
      <div class="col-lg-4">
        <h4>My comments</h4>
      </div>
    </div>
  </section>
</main>