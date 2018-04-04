<?php

?>

<link rel="stylesheet" href="<?php echo asset_url().'css/testView.css'; ?>">
<script type="text/javascript" src="<?php echo asset_url()."js/trainer/main.js"; ?>"></script>
<script type="text/javascript" src="<?php echo asset_url()."js/trainer/class.CreateTest.js"; ?>"></script>
<script type="text/javascript" src="<?php echo asset_url()."js/trainer/class.CreateTraining.js"; ?>"></script>

<div class="container-fluid ci-card-container">

    <form method="POST" action='<?php echo controller_url().TRAINER_CONTROLLER."/saveNewTest";?>'>

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
              <label for="ci_form_topic">Test topic</label>
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
              <label>Min. Passing Marks</label>
        </div>
        <div class="col-sm-9">
            <input type="number" class="form-control" name="ci_form_passing_marks" id="ci_form_passing_marks">
        </div>
      </div>
      <br/>
      
      <div class="row">
        <div class="col-sm-3">
              <label>Assign this test to</label>
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
        <div class="col-sm-6">
              <input type="button" id="ci_form_btn_create_question" class="ci-btn ci-btn-blue" value="+ New Question" onclick="addNewQuestion()">
        </div>
    </div>

    <div class="ci-card-container" id="ci_form_test_container">
        <div class="ci-card-container ci-form-question-container">
            <div class="row">
                <div class="col-sm-10">
                    <div class="ci-form-question-text">
                        <div class="row">
                            <div class="col-sm-3">
                                Q.1
                            </div>
                            <div class="col-sm-9">
                                <span class="float-right">Delete</span>
                            </div>
                        </div>
                    
                        <textarea class="form-control ci-form-question-input" rows="5" placeholder="Question text goes here.."></textarea>
                    </div>
                    <br/>

                    <div class="ci-form-option">55
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_1">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 1 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_1">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 2 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_1">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 3 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_1">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 4 text goes here..">
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>

    <div class="row">
        <input type="button" class="ci-btn ci-btn-green margin-auto ci-btn-wide" value="Save" onclick="saveNewTest()">
    </div>

    </form>

</div>