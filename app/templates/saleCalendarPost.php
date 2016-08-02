<?php 

  $this->layout('master', [
      'title'=>'Sale Calendar',
      'desc'=>'Post to Sale Calendar'
    ]);

?>

<!-- Hero section -->
  <div class="jumbotron">
    <h2>Upload useful sale information with us!</h2>
  </div>

<!-- Main section -->
<main class="sale-calendar">
  <section class="main">
  <div id="review-post">
  <form>
  <fieldset class="form-group">
    <label for="brand-name">Brand Name</label>
    <input type="text" class="form-control" id="brand-name">
  </fieldset>

  <fieldset class="form-group">
    <label for="city">City</label>
    <select class="form-control" id="city">
      <option selected>Open this select menu</option>
      <option disabled>North Island</option>
      <option value="auckland">Auckland</option>
      <option value="wellington">Wellington</option>
      <option value="hamilton">Hamilton</option>
      <option value="tauranga">Tauranga</option>
      <option disabled>South Island</option>
      <option value="christchurch">Christchurch</option>
      <option value="dunedin">Dunedin</option>
      <option value="queenstown">Queenstown</option>
      <option value="others">Others</option>
    </select>
  </fieldset>

  <fieldset class="form-group">
    <label for="sale-percent">Sale Percentage</label>
    <input type="number" class="form-control" id="sale-percent">
  </fieldset>

  <div class="row">
    <div class="col-lg-6">
      <fieldset class="form-group">
        <label for="date-from" class="col-form-label">Date from</label>
          <input class="form-control" type="date" value="2011-08-19" id="date-from">
        </div>
      </fieldset>

    <div class="col-lg-6">
       <fieldset class="form-group">
    
      <label for="date-to" class="col-form-label">Date to</label>
        <input class="form-control" type="date" value="2011-08-19" id="date-to">
    </div>
  </fieldset>
  </div>
  
  <fieldset class="form-group">
    <label for="condition">Condition</label>
    <textarea class="form-control" id="condition" rows="3"></textarea>
  </fieldset>
  <fieldset class="form-group">
    <label for="brand-image">Upload Brand Image</label>
    <input type="file" class="form-control-file" id="brand-image">
  </fieldset>
 
  <button type="submit" class="btn btn-primary">Submit Sale Info</button>
</form>
</div>
</section>
</main>