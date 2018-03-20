<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Base controller for all the controllers of this application
class BASE_Controller extends CI_Controller {

    public function __construct(){      
        
        //use the line parent::__construct(); when you want a constructor in the child class to do something, AND execute the parent constructor
        parent::__construct();

        // Load the public model for all controllers
		$this->load->model('Public_model');

    }

    public function setSessionData($data){
		$sessionData = array(
		'user_id'  => $data->user_id,
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

    public function test(){
        echo "HELLO FROM BASE CONTROLLER";
    }

    public function loadMyTrainingsView($mappedDataArray){
        $data = array("tabName" => "MyTrainings","mappedDataArray" => $mappedDataArray);
        $this->load->view('user/MyTrainings', $data);
    }

    public function loadMyTestsView($mappedDataArray){ 
        $data = array("tabName" => "MyTests", "mappedDataArray" => $mappedDataArray); 
        $this->load->view('user/MyTests', $data);
    }

    public function getSingleUserAssignment($type){   
        $user_id = $this->session->userdata("user_id"); 

        switch ($type) {
            case 'training':
                $assignments = $this->Public_model->getSingleUserAssignments($user_id, TRAINING_ASSIGNMENT);
                break;

            case 'test':
                $assignments = $this->Public_model->getSingleUserAssignments($user_id, TEST_ASSIGNMENT);
                break;
            
            default:
                $assignments = "";
                break;
        }

        return $assignments;
    }

    public function getAllRecords($tableName){
        $result = $this->Public_model->getAllRecords($tableName);
        return $result;
    }

    public function getUserTrainingMappedData(){
        $mappedDataArray = array();
        $assignmentData = $this->getSingleUserAssignment('training');
        if($assignmentData["status"] == 200){
            $assignmentData = $assignmentData["data"];
            $allTrainingsData = $this->getAllRecords(TRAININGS);

            if($allTrainingsData["status"] == 200){
                $allTrainingsData = $allTrainingsData["data"];

                // Traverse Assignment Array
                for($i=0; $i<count($assignmentData); $i++){
                    $mappedDataArray[$i]["training_id"] = $assignmentData[$i]->{"training_id"};
                    $mappedDataArray[$i]["status"] = $assignmentData[$i]->{"status"};

                    // Traverse All Trainings Array
                    for($j=0; $j<count($allTrainingsData); $j++){
                        // Map training id to training topic
                        if($assignmentData[$i]->{"training_id"} == $allTrainingsData[$j]->{"training_id"}){
                            $mappedDataArray[$i]["training_topic"] = $allTrainingsData[$j]->{"training_topic"};
                        }
                    }

                }
            }            
        }
        return $mappedDataArray;
    }

    public function getUserTestMappedData(){
        $mappedDataArray = array();
        $assignmentData = $this->getSingleUserAssignment('test');
        if($assignmentData["status"] == 200){
            $assignmentData = $assignmentData["data"];
            $allTrainingsData = $this->getAllRecords(TESTS);

            if($allTrainingsData["status"] == 200){
                $allTrainingsData = $allTrainingsData["data"];

                // Traverse Assignment Array
                for($i=0; $i<count($assignmentData); $i++){
                    $mappedDataArray[$i]["test_id"] = $assignmentData[$i]->{"test_id"};
                    $mappedDataArray[$i]["status"] = $assignmentData[$i]->{"status"};

                    // Traverse All Trainings Array
                    for($j=0; $j<count($allTrainingsData); $j++){
                        // Map training id to training topic
                        if($assignmentData[$i]->{"test_id"} == $allTrainingsData[$j]->{"test_id"}){
                            $mappedDataArray[$i]["test_name"] = $allTrainingsData[$j]->{"test_name"};
                            $mappedDataArray[$i]["test_json"] = $allTrainingsData[$j]->{"test_json"};
                        }
                    }

                }
            }            
        }
        return $mappedDataArray;
    }

}// end class

?>