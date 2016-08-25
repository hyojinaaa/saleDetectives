<?php 

  $this->layout('master', [
      'title'=>'Review',
      'desc'=>'Post your review'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Edit your post</h2>
  </div>

<!-- Main section -->
<main class="review">
  <section class="main">
  <div id="review-post">
  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data"> 
  <fieldset class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $review['title'] ?>">
    <small class="text-muted review-error"><?= isset($titleError) ? $titleError : '' ?></small>
  </fieldset>

  <fieldset class="form-group">
    <label for="review-about">Review about</label>
    <select class="form-control" id="review-about" name="review-about">
     <option selected><?= $review['review_about'] ?></option>
      <option value="clothes">Clothes</option>
      <option value="bags">Bags</option>
      <option value="shoes">Shoes</option>
      <option value="acc">Accessories</option>
      <option value="others">Others</option>
    </select>
  </fieldset>

  <fieldset class="form-group">
    <label for="store-location">Store Location</label>
    <input type="text" class="form-control" id="store-location" name="location" value="<?= $review['location'] ?>">
    <small class="text-muted review-error"><?= isset($locationError) ? $locationError : '' ?></small>
  </fieldset>
  
  <fieldset class="form-group">
    <label for="review-text">My review</label>
    <textarea class="form-control" id="review-text" rows="10" name="description"><?= $review['description'] ?></textarea>
    <small class="text-muted review-error"><?= isset($textError) ? $textError : '' ?></small>
  </fieldset>
  <fieldset class="form-group">
    <label for="image">Upload Image</label>
    <input type="file" class="form-control-file" id="image" name="image1">
    <input type="file" class="form-control-file" id="image" name="image2">
    <small class="text-muted review-error"><?= isset($imageError) ? $imageError : '' ?></small>
<br>
 
    <img src="img/uploads/review/individual/<?= $review['image1'] ?>">
    <img src="img/uploads/review/individual/<?= $review['image2'] ?>">
  
  <br>
    <small class="text-muted review-error"><?= isset($imageError) ? $imageError : '' ?></small>
  </fieldset>
  
  <small class="text-muted review-error"><?= isset($reviewError) ? $reviewError : '' ?></small>
  <br>
  <button type="submit" class="btn btn-primary" name="edit-review" value="Submit">Submit Review</button>
</form>
</div>
</section>
</main>
