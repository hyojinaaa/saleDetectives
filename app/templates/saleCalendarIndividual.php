<?php 

  $this->layout('master', [
      'title'=>'Sale Calendar',
      'desc'=>'View Sale Calendar individual post'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Please make a comment and give nice ranking to author! </h2>
  </div>

<!-- Main section -->
<main class="sale-calendar">
  <section class="main">
  <article id="review-individual">
    <div class="dropdown pull-right">
      <button class="btn btn-default dropdown-toggle" type="button" id="edit-delete" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
        <li><a href="#">Edit</a></li>
        <li><a href="#">Delete</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Share on Facebook</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <img src="http://placehold.it/300x300">
      </div>
      <div class="col-lg-8">
        <h2>Topshop 50% Sale</h2>
        <p>Wellington</p>
        <p><small>From</small> 05/06/2016 <small>To</small> 03/02/2016</p>
        <p><a href="">Author Name</a>  |  <small>Written 07/06/2016</small></p>
    
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident,</p>
      </div>
   
     </div>
  </article>

  <hr>
  <h2 class="comments">Comments</h2>
    <ul class="media-list">
    <li class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placehold.it/100x100" alt="...">
        </a>
      </div>
      <div class="media-body">
        <form>
          <textarea class="form-control" id="comments-text" rows="3" placeholder="Write your comment"></textarea>
          <button type="submit" class="btn btn-primary" id="post-comment">Post my comment</button>
        </form>
      </div>

    </li>

    <li class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placehold.it/100x100" alt="...">
        </a>
      </div>
      <div class="media-body">
        <div class="dropdown pull-right">
        <button class="btn btn-default dropdown-toggle" type="button" id="edit-delete" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
          <li><a href="#">Edit</a></li>
          <li><a href="#">Delete</a></li>
        </ul>
      </div>
        <p>Hyojin Jung  |  <small>Commented 07/06/2016</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p>
      </div>
    </li>

    <li class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placehold.it/100x100" alt="...">
        </a>
      </div>
      <div class="media-body">
        <p>Hyojin Jung  |  <small>Commented 07/06/2016</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p>
      </div>
    </li>

    <li class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="http://placehold.it/100x100" alt="...">
        </a>
      </div>
      <div class="media-body">
        <p>Hyojin Jung  |  <small>Commented 07/06/2016</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p>
      </div>
    </li>
  </ul>
  </section>
</main>