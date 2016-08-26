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
<main class="sale-calendar">
  <section class="main">
  
  <h1>Search Results for "<span class="search"><?= $this->e($searchTerm) ?></span>"</h1>

<?php if(strlen($searchTerm) > 0): ?>
  <?php if($searchResults > 0): ?>
    <?php foreach($searchResults as $Result): ?>

      <hr>
  <div class="row">
      <div class="col-lg-5 review-img">

        <a href="index.php?page=review-individual&reviewid=<?= $Result['id'] ?>">

        
          <img src="img/uploads/review/stream/<?= $Result['image1'] ?>">
          <img src="img/uploads/review/stream/<?= $Result['image2'] ?>">
        
        </a>
      </div>
      <div class="col-lg-7 review-p">
          <br>
          <h4 id="review-heading"><a href="index.php?page=review-individual&reviewid=<?= $Result['id'] ?>"><?= $Result['score_title'] ?></h4>
          <div class="col-lg-6">
            <p><?= $Result['created_at'] ?></p>
          </div>
          <div class="col-lg-6">
            <a href="#"><p><?= $Result['score_username'] ?></p></a>
          </div>
          <a href="index.php?page=review-individual&reviewid=<?= $Result['id'] ?>"><p class="review-stream"><?= $Result['score_description'] ?></p></a>
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