<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainee_controller extends BASE_Controller {

    public function __construct(){        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
        parent::__construct();
        
        if($this->isLoggedIn()){

            // Check if trainer
            if($this->isTrainee()){
                $this->load->view('header/all_script_links');
                $this->load->view('layout/top-bar');
                $this->load->view('layout/nav-bar');
            }
            else{
                // Redirect to login page
                redirect('../'.LOGIN_CONTROLLER.'');
            }
        }
        else{
            // Redirect to login page
            redirect('../'.LOGIN_CONTROLLER.'');
        }		
    }

	public function index(){
        redirect('../'.Trainee_CONTROLLER.'/home');
    }

    public function home(){
        $this->load->view('trainee/index');
    }
    
    /* FUNCTIONS TO BE TRANSFERRED INTO BASE CONTROLLER */
    public function goToMyTrainings(){
        $mappedDataArray = array(); // will contain training names mapped to the user
        $mappedDataArray = $this->getUserTrainingMappedData();        
        $this->loadMyTrainingsView($mappedDataArray);
    }

    public function goToMyTests(){
        $mappedDataArray = array(); // will contain training names mapped to the user
        $mappedDataArray = $this->getUserTestMappedData();      
        $this->loadMyTestsView($mappedDataArray);
    }

    public function goToViewTraining($training_id){    

        // Check if this training belongs to this user
        if($this->isTrainingBelongingToUser($training_id)){
            $this->loadTrainingView($training_id);
        }
        else{
            echo "Unauthorized acccess";
        }
    }

    public function goToViewTest($test_id){    

        // Check if this test belongs to this user
        if($this->isTestBelongingToUser($test_id)){
            $this->loadTestView($test_id);
        }
        else{
            echo "Unauthorized acccess";
        }
    }
    //------------------------------------------------------

}
?>