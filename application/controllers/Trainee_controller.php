<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainee_controller extends BASE_Controller {

    public function __construct(){        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
        parent::__construct();
        
        
		$this->load->view('header/all_script_links');
        $this->load->view('layout/top-bar');
    }

	public function index(){

        if($this->isLoggedIn()){

            // Check if trainer
            if($this->isTrainee()){
                redirect('../'.Trainee_CONTROLLER.'/home');
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

    public function home(){

        if($this->isLoggedIn()){

            // Check if trainer
            if($this->isTrainee()){
                $this->load->view('trainee/index');
                $this->load->view('user/index');
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

}
?>