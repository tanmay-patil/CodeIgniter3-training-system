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

    public function loadTrainingView($training_id){    

        // First fetch the training_json and pass it on to the view
        $training_json = $this->getTrainingJson($training_id);

        $data = array("training_id" => $training_id, "training_json" => $training_json);
        $this->load->view('user/training', $data);
    }

    public function loadTestView($test_id){  

        // First fetch the test_json and pass it on to the view
        $test_json = $this->getTestJson($test_id);

        $data = array("test_id" => $test_id, "test_json" => $test_json);
        $this->load->view('user/test', $data);
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
                            $mappedDataArray[$i]["training_json"] = $allTrainingsData[$j]->{"training_json"};
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

    public function isTrainingBelongingToUser($training_id){
        $user_id = $this->session->userdata("user_id");

        $assignments = $this->Public_model->checkTrainingExistenceForUser($user_id, $training_id);

        if($assignments["status"] ==200){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function isTestBelongingToUser($test_id){
        $user_id = $this->session->userdata("user_id");

        $assignments = $this->Public_model->checkTestExistenceForUser($user_id,$test_id);

        if($assignments["status"] ==200){
            return true;
        }
        else{
            return false;
        }
    }

    public function getTrainingJson($training_id){
        $result = $this->Public_model->getTrainingJson($training_id);
        $training_json = "";

        if($result["status"]==200){
            $training_json = $result["data"][0]->{"training_json"};
            $training_json = json_decode($training_json);
        }

        return $training_json;
    }

    public function getTestJson($test_id){
        $result = $this->Public_model->getTestJson($test_id);
        $test_json = "";

        if($result["status"]==200){
            $test_json = $result["data"][0]->{"test_json"};
            $test_json = json_decode($test_json);
        }

        return $test_json;
    }

}// end class

?>