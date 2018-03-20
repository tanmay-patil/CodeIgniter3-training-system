<?php

    echo "Welcome to my ".$tabName;
    var_dump($mappedDataArray);

    $controller = "";
    if($this->session->userdata("access_type") == 1){
        $controller = TRAINER_CONTROLLER;
    }
    else if($this->session->userdata("access_type") == 2){
        $controller = TRAINEE_CONTROLLER;
    }

?>

<!-- INCLUDE JS SCRIPTS RELATED TO MY TESTS PAGE ONLY -->
<script type="text/javascript" src="<?php echo asset_url()."js/class.Tests.js"; ?>"></script>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Sr. No</th>
        <th>Test</th>
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
            <td><?= $mappedDataArray[$i]["test_name"]; ?></td>
            <td><?php echo($value = ($mappedDataArray[$i]["status"] == "1") ? 'Passed' : 'Not Passed'); ?></td>
            <td>
                <a href='<?php echo controller_url().$controller."/goToViewTest/".$mappedDataArray[$i]["test_id"]; ?>'>
                    <button class="ci-btn ci-btn-blue">
                        <?php echo ($mappedDataArray[$i]["status"] == "0" > 1 ? 'Take the test' : 'Retake the test')?>
                    </button>
                </a>   
            </td>
        </tr>    
        <?php
            }
        ?>
    </tbody>
  </table>