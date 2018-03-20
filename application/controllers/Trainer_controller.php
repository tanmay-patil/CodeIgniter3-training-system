<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer_controller extends BASE_Controller {

    public function __construct(){  
        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
		parent::__construct();
        
        if($this->isLoggedIn()){

            // Check if trainer
            if($this->isTrainer()){
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
        //  redirect('../'.TRAINER_CONTROLLER.'/home');
    }

    public function home(){
        $this->load->view('trainer/index');
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
    //------------------------------------------------------
}
?>