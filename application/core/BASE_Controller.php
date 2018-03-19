<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Base controller for all the controllers of this application
class BASE_Controller extends CI_Controller {

    public function __construct(){      
        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
        parent::__construct();

    }

    public function setSessionData($data){
		$sessionData = array(
		'username'  => $data->username,
		'access_type'     => $data->type);

		$this->session->set_userdata($sessionData);
    }    
    
	public function logout(){
		// Destroy the session
		$this->session->sess_destroy();
    }
    
    public function isLoggedIn(){
        if($this->session->userdata("access_type") != null){
            return true;
        }
        else{
            return false;
        }
	}
	
    public function isTrainer(){
        if($this->session->userdata("access_type") == 1){
            return true;
        }
        else{
            return false;
        }
	}
	
	
    public function isTrainee(){
        if($this->session->userdata("access_type") == 2){
            return true;
        }
        else{
            return false;
        }
    }

}// end class

?>