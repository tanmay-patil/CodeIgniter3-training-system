<?php
    echo "VIEW-TEST";
    var_dump($test_json);
    $header = $test_json->{"header"};
?>

<script>
  $(window).on("load", function() {

      // Mark the nav bar tab as selected
      $(ci_li_my_trainings).addClass("active");

  });
</script>

<link rel="stylesheet" href="<?php echo asset_url().'css/testView.css'; ?>">

<div class="container-fluid ci-card-container">
  <!-- Let Bootstrap automatically handle the layout -->

  <div class="row">
    <div class="col-sm-2 ci-label">
      Training on 
    </div>
    <div class="col-sm-10 ci-topic">
      <?= $header->{"test_name"}?>
    </div>
  </div>
  <br>
  
  <div class="row">
    <div class="col-sm-2 ci-label">
      Estimated Duration (Hours)
    </div>
    <div class="col-sm-10 ci-content">
          <?= htmlspecialchars($header->{"duration_hours"}) ?>
    </div>
  </div>
  <br>
  
  <div class="row">
    <div class="col-sm-2 ci-label">
      Author
    </div>
    <div class="col-sm-10 ci-content">
          <?= htmlspecialchars($header->{"created_by"}) ?>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-sm-10 ci-content">
        <!--Radio group-->
        <label class="ci-radio-container">One
        <input type="radio" checked="checked" name="radio">
        <span class="checkmark"></span>
        </label>
        <label class="ci-radio-container">Two
        <input type="radio" name="radio">
        <span class="checkmark"></span>
        </label>
        <label class="ci-radio-container">Three
        <input type="radio" name="radio">
        <span class="checkmark"></span>
        </label>
        <label class="ci-radio-container">Four
        <input type="radio" name="radio">
        <span class="checkmark"></span>
        </label>
        <!--Radio group-->
    </div>
  </div>
  <br>



</div>