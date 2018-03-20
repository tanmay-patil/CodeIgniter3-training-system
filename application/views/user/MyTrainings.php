<?php

    // echo "Welcome to my ".$tabName;
    // var_dump($mappedDataArray);

    $controller = "";
    if($this->session->userdata("access_type") == 1){
        $controller = TRAINER_CONTROLLER;
    }
    else if($this->session->userdata("access_type") == 2){
        $controller = TRAINEE_CONTROLLER;
    }

?>

<script>
    $(window).on("load", function() {

        // Mark the nav bar tab as selected
        $(ci_li_my_trainings).addClass("active");

    });
</script>

<!-- INCLUDE JS SCRIPTS RELATED TO MY TRAININGS PAGE ONLY -->
<script type="text/javascript" src="<?php echo asset_url()."js/class.Trainings.js"; ?>"></script>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Sr. No</th>
        <th>Training</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php
            for($i=0; $i<count($mappedDataArray); $i++){
        ?>
        <tr <?php echo 'class="' . ($mappedDataArray[$i]["status"] == "0" > 1 ? 'table-warning' : '') . '"' ?>>
            <td><?= $i+1; ?></td>
            <td><?= $mappedDataArray[$i]["training_topic"]; ?></td>
            <td><?php echo($value = ($mappedDataArray[$i]["status"] == "1") ? 'Completed' : 'Not Completed'); ?></td>
            <td>
                <a href='<?php echo controller_url().$controller."/goToViewTraining/".$mappedDataArray[$i]["training_id"]; ?>'>
                    <button class="ci-btn ci-btn-blue">View</button>
                </a>    
            </td>
        </tr>    
        <?php
            }
        ?>
    </tbody>
  </table>