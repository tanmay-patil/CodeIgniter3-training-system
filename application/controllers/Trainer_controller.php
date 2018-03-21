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

    public function goToCreateNewTraining(){
        // Check if trainer
        if($this->isTrainer()){
            
            // Fetch all the current users and pass it to the view
            $result = $this->getAllUsersList();
            $userList = array();

            if($result["status"] == 200){
                $userList = $result["data"];
            }

            $data = array("userList" => $userList);

            $this->load->view('trainer/createNewTraining', $data);
        }
        else{
            echo "Unauthorized access";
        }
    }

    public function goToCreateNewTest(){
        // Check if trainer
        if($this->isTrainer()){

            // Fetch all the current users and pass it to the view
            $result = $this->getAllUsersList();
            $userList = array();

            if($result["status"] == 200){
                $userList = $result["data"];
            }

            $data = array("userList" => $userList);

            $this->load->view('trainer/createNewTest', $data);
        }
        else{
            echo "Unauthorized access";
        }
    }

    public function saveNewTraining(){
        // Fetch all form data
        $formData["createdBy"] = $this->session->userdata("name");
        $formData["trainingTopic"] = $this->input->post('ci_form_topic');
        $formData["duration"] = $this->input->post('ci_form_duration');
        $formData["content"] = $this->input->post('ci_form_content');
        $formData["userAssign"] = $this->input->post('ci_checkbox_user');

        // Convert this data into json format
        $obj = new stdClass();
        $obj->{"created_by"} = $formData["createdBy"];
        $obj->{"duration_hours"} = $formData["duration"];
        $obj->{"training_topic"} = $formData["trainingTopic"];
        $obj->{"training_content"} = $formData["content"];

        $training_json = json_encode($obj);
        
        // Pass this object to base controller to further store it into database
        $result = $this->saveNewTrainingInDb($this->input->post('ci_form_topic'), $training_json);

        // If new training saved successfully, insert a user-training assignment
        if($result){
            echo "<h1>SUCCESSFULLY SAVED NEW TRAINING</h1>";
        }

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