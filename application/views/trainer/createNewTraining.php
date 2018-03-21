<?php
  // var_dump($userList);
?>

<div class="container-fluid ci-card-container">

    <form method="POST" action='<?php echo controller_url().TRAINER_CONTROLLER."/saveNewTraining";?>'>

      <div class="row">
          <div class="col-sm-3">
              <label for="ci_form_created_by">Created By</label>
          </div>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="ci_form_created_by" value='<?= $this->session->userdata("name"); ?>' disabled>
          </div>
      </div>
      <br/>
      
      <div class="row">
        <div class="col-sm-3">
              <label for="ci_form_topic">Training topic</label>
        </div>
        <div class="col-sm-9">
            <input name="ci_form_topic" type="text" class="form-control" id="ci_form_topic">
        </div>
      </div>
      <br/>
      
      <div class="row">
        <div class="col-sm-3">
              <label>Duration (in hours)</label>
        </div>
        <div class="col-sm-9">
            <input type="number" class="form-control" name="ci_form_duration" id="ci_form_duration">
        </div>
      </div>
      <br/>
      
      <div class="row">
        <div class="col-sm-3">
              <label>Training Content</label>
        </div>
        <div class="col-sm-9">
            <textarea class="form-control" rows="5" name="ci_form_content" id="ci_form_content"></textarea>
        </div>
      </div>
      <br/>
      
      <div class="row">
        <div class="col-sm-3">
              <label>Assign this training to</label>
        </div>
        <div class="col-sm-9">

          <?php 
            for($i=0; $i<count($userList); $i++){
          ?>
            <div class="checkbox">
              <label><input name="ci_checkbox_user[]" type="checkbox" value="<?= $userList[$i]->{"user_id"}; ?>"><?= $userList[$i]->{"name"}; ?></label>
            </div>
          <?php
            }
          ?>

        </div>
      </div>
      <br/>

      <div class="row">
          <div class="col-sm-3">
              
          </div>
          <div class="col-sm-9">
              <button type="submit" class="ci-btn ci-btn-blue">Submit</button>
          </div>        
      </div>
      <br/>

    </form>

</div>