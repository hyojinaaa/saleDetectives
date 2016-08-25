<?php 

  $this->layout('master', [
      'title'=>'Search result',
      'desc'=>'View searh result'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Here is the result for your search request</h2>
  </div>

<!-- Main section -->
<main class="account">
  <section class="main">
  
  <h2>Search result for : <strong><?= $this->e($searchTerm) ?></strong></h2>
    <hr>

  <?php if(strlen($searchTerm) > 0): ?>
    <?php if(strlen($searchResult) > 0): ?>
      <?php foreach($searchResult as $Result): ?>
  <div class="row">
      <div class="col-lg-5 review-img">

        <a href="index.php?page=review-individual&reviewid=<?= $Result['id'] ?>">

        
          <img src="img/uploads/review/stream/<?= $Result['image1'] ?>">
          <img src="img/uploads/review/stream/<?= $Result['image2'] ?>">
        
        </a>
      </div>
      <div class="col-lg-7 review-p">
          <br>
          <h4 id="review-heading"><a href="index.php?page=review-individual&reviewid=<?= $item['id'] ?>"><?= $Result['search_title'] ?></h4>
          <div class="col-lg-6">
            <p><?= $Result['created_at'] ?></p>
          </div>
          <div class="col-lg-6">
            <a href="#"><p><?= $Result['username'] ?></p></a>
          </div>
          <a href="index.php?page=review-individual&reviewid=<?= $item['id'] ?>"><p class="review-stream"><?= $Result['search_description'] ?></p></a>
      </div>
  </div>
<?php endforeach; ?>
<?php else: ?>
    <p>There was no results for "<i><?= $this->e($searchTerm) ?></i>"</p>
  <?php endif; ?>
<?php else: ?>
  <p>Please put something into the search bar</p>
<?php endif; ?>
  </section>
</main>