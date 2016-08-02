<?php 

  $this->layout('master', [
      'title'=>'Home',
      'desc'=>'Home Page'
    ]);

?>

<!-- Hero section -->
<main>
  <div class="jumbotron">
    <img src="img/fight.png">
    <h2>Be Planned,<br>And Do a Wise Purchase,<br>With Us!</h2>
    <p><a class="btn btn-primary btn-lg" href="#" role="button">Go to Sale Calendar</a></p>
  </div>

  <div id="detectives">
  <img src="img/detectives.jpg">
</div>

<!-- Main section -->
<div id="sale-info">
  <div class="row">
    <div class="col-lg-2 col-lg-offset-4 home-sale">
      <h2>Today's <br>Sale</h2>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-2 home-sale">
      <h2>Tomorrow's <br>Sale</h2>
    </div>
  </div><!-- /.row -->
</div>

<div id="top-reviews">
  <h2 id="top-reviews-heading">Top 3 reviews of this week</h2>
  <div id="container">
    <div class="row">
      <div class="col-lg-4 home-review">
        <img src="http://placehold.it/150x150" class="img-circle">
        <h4>Review Title</h4>
        <p><small>Author Name</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. </p>
      </div>
      <div class="col-lg-4 home-review">
        <img src="http://placehold.it/150x150" class="img-circle">
        <h4>Review Title</h4>
        <p><small>Author Name</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. </p>
      </div>
      <div class="col-lg-4 home-review">
        <img src="http://placehold.it/150x150" class="img-circle">
        <h4>Review Title</h4>
        <p><small>Author Name</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. </p>
      </div>
    </div>
  </div>
</div>



</main>
