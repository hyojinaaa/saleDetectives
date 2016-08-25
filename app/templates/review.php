<?php 

  $this->layout('master', [
      'title'=>'Review',
      'desc'=>'View reviews'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Write a review of your clothes and share with us! </h2>
  </div>

<!-- Main section -->
<main class="review">
  <section class="main">
  <a class="btn review-btn" href="index.php?page=review-post">Write a Review</a> 

  
<?php foreach($allReviews as $item): ?>
  <hr>
  <div class="row">
      <div class="col-lg-5 review-img">

        <a href="index.php?page=review-individual&reviewid=<?= $item['id'] ?>">

        
          <img src="img/uploads/review/stream/<?= $item['image1'] ?>">
          <img src="img/uploads/review/stream/<?= $item['image2'] ?>">
        
        </a>
      </div>
      <div class="col-lg-7 review-p">
          <br>
          <h4 id="review-heading"><a href="index.php?page=review-individual&reviewid=<?= $item['id'] ?>"><?= $item['title'] ?></h4>
          <div class="col-lg-6">
            <p><?= $item['created_at'] ?></p>
          </div>
          <div class="col-lg-6">
            <a href="#"><p><?= $item['username'] ?></p></a>
          </div>
          <a href="index.php?page=review-individual&reviewid=<?= $item['id'] ?>"><p class="review-stream"><?= $item['description'] ?></p></a>
      </div>
  </div>

<?php endforeach ?>

  

  <nav class="pagination-nav">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

</section>
</main>