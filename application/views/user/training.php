<?php
    // var_dump($training_json);
?>
 
<script>
  $(window).on("load", function() {

      // Mark the nav bar tab as selected
      $(ci_li_my_trainings).addClass("active");

  });
</script>

<div class="container-fluid ci-card-container">
  <!-- Let Bootstrap automatically handle the layout -->

  <div class="row">
    <div class="col-sm-2 ci-label">
      Training on 
    </div>
    <div class="col-sm-10 ci-topic">
      <?= $training_json->{"training_topic"}?>
    </div>
  </div>
  <br>
  
  <div class="row">
    <div class="col-sm-2 ci-label">
      Estimated Duration (Hours)
    </div>
    <div class="col-sm-10 ci-content">
          <?= htmlspecialchars($training_json->{"duration_hours"}) ?>
    </div>
  </div>
  <br>
  
  <div class="row">
    <div class="col-sm-2 ci-label">
      Author
    </div>
    <div class="col-sm-10 ci-content">
          <?= htmlspecialchars($training_json->{"created_by"}) ?>
    </div>
  </div>
  <br>
  
  <div class="row">
    <div class="col-sm-2 ci-label">
      Content 
    </div>
    <div class="col-sm-10 ci-content">
          <?= htmlspecialchars($training_json->{"training_content"}) ?>
    </div>
  </div>
</div>

  
