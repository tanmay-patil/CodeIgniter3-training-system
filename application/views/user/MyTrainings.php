<?php

    echo "Welcome to my ".$tabName;
    // var_dump($mappedDataArray);

?>

<!-- INCLUDE JS SCRIPTS RELATED TO MY TRAININGS PAGE ONLY -->
<script type="text/javascript" src="<?php echo asset_url()."js/class.Trainings.js"; ?>"></script>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Sr. No</th>
        <th>Training</th>
        <th>Status</th>
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
        </tr>    
        <?php
            }
        ?>
    </tbody>
  </table>