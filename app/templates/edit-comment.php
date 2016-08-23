<?php 

  $this->layout('master', [
      'title'=>'Review',
      'desc'=>'View reviews post'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Edit your comment </h2>
  </div>

<!-- Main section -->
<main class="review">
  <section class="main">
  




  <h2 class="comments">Comments</h2>
<li class="media">

      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placehold.it/100x100" alt="...">
        </a>
      </div>

      <div class="media-body">
        <form action="index.php?page=edit-comment&id=<?= $_GET['id'] ?>" method="post">
          <textarea class="form-control" name="comment" id="comments-text" rows="3" placeholder="Write your comment"><?=  $comment ?></textarea>
          <small class="text-muted review-error"><?= isset($commentError) ? $commentError : '' ?></small>
          <input type="submit" class="btn btn-primary" name="edit-comment" id="post-comment" value="Edit my comment">
        </form>
          

      </div>
        
    </li>
  </section>
</main>
