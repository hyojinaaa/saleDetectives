<?php 

  $this->layout('master', [
      'title'=>'Review',
      'desc'=>'Post your review'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Upload your review, we are so looking forward to share it!</h2>
  </div>

<!-- Main section -->
<main class="review">
  <section class="main">
  <div id="review-post">
  <form>
  <fieldset class="form-group">
    <label for="title">Title</label>
    <input type="title" class="form-control" id="title">
    <small class="text-muted">Title must have the brand name.</small>
  </fieldset>

  <fieldset class="form-group">
    <label for="review-about">Review about</label>
    <select class="form-control" id="review-about">
     <option selected>Open this select menu</option>
      <option value="clothes">Clothes</option>
      <option value="bags">Bags</option>
      <option value="shoes">Shoes</option>
      <option value="acc">Accessories</option>
      <option value="others">Others</option>
    </select>
  </fieldset>

  <fieldset class="form-group">
    <label for="store-location">Store Location</label>
    <input type="text" class="form-control" id="store-location">
  </fieldset>
  
  <fieldset class="form-group">
    <label for="review-text">My review</label>
    <textarea class="form-control" id="review-text" rows="10"></textarea>
  </fieldset>
  <fieldset class="form-group">
    <label for="image">Upload Image</label>
    <input type="file" class="form-control-file" id="image">
  </fieldset>
 
  <button type="submit" class="btn btn-primary">Submit Review</button>
</form>
</div>
</section>
</main>
