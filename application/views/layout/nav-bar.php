<?php
    $title = "";
    $controller = "";
    if($this->session->userdata("access_type") == 1){
        $title = "TRAINER HOME";
        $controller = TRAINER_CONTROLLER;
    }
    else if($this->session->userdata("access_type") == 2){
        $title = "TRAINEE HOME";
        $controller = TRAINEE_CONTROLLER;
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href='<?php echo controller_url().$controller."/home";?>'>
        <p class="inline"><?php echo $title;?></p>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php
                if($this->session->userdata("access_type") == 1){
            ?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" id="ci_tab_new_training" href="#">New Training</a>
                <a class="dropdown-item" id="ci_tab_new_test" href="#">New Test</a>
                </div>
            </li>
            <?php
                }
            ?>
            <li class="nav-item" id="ci_li_my_trainings">
                <a class="nav-link" id="ci_tab_my_trainings" href='<?php echo controller_url().$controller."/goToMyTrainings";?>'>My Trainings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ci_li_my_tests" id="ci_tab_my_tests" href='<?php echo controller_url().$controller."/goToMyTests";?>'>My Tests</a>
            </li>
        
        </ul>
    </div>
</nav>