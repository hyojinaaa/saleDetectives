<?php 

  $this->layout('master', [
      'title'=>'Sale Calendar',
      'desc'=>'View sale information'
    ]);

?>


<!-- Hero section -->
  <div class="jumbotron">
    <h2>Sale schedules and information are all here!</h2>
  </div>

<!-- Main section -->
<main class="sale-calendar">
  <section class="main">

    <button class="btn review-btn">Add upcoming sale</button> 
    <div class="row">
      
      <div class="col-lg-7">
        <div class="cal1" id="calendar"></div>
      </div>
      <div class="col-lg-4">
        <h4>Sales in this month</h4>
        <hr>
        <ul class="list-group">
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
          <li class="list-group-item">
            <h4>Topshop all 40%</h4>
            <p>Auckland</p>
          </li>
         
          
        </ul>
      </div>
    </div>
    </section>
</main>
