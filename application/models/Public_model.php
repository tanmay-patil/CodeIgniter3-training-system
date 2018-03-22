<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_model extends CI_Model  {

	public function __construct()
	{
		$db_obj = $this->load->database('db1',TRUE);
		$connected = $db_obj->initialize();
		if (!$connected) {
			echo "Not connected ";
		}
		else if($connected){
			// echo "Connected successfully";
		} 
    }
    
    public function getSingleUserAssignments($user_id, $table_name){
        $response = array();

		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
            $count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
    }
    
    public function getAllRecords($table_name){
        $response = array();

		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
            $count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
	}
	
	public function checkTrainingExistenceForUser($user_id, $training_id){
        $response = array();

		$this->db->select('*');
		$this->db->from(TRAINING_ASSIGNMENT);
		$this->db->where('user_id',$user_id);
		$this->db->where('training_id',$training_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
	}
		
	public function checkTestExistenceForUser($user_id, $test_id){
        $response = array();

		$this->db->select('*');
		$this->db->from(TEST_ASSIGNMENT);
		$this->db->where('user_id',$user_id);
		$this->db->where('test_id',$test_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
	}
	
	public function getTrainingJson($training_id){
		$response = array();

		$this->db->select('*');
		$this->db->from(TRAININGS);
		$this->db->where('training_id',$training_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
	}
	
	public function getTestJson($test_id){
		$response = array();

		$this->db->select('*');
		$this->db->from(TESTS);
		$this->db->where('test_id',$test_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$count = 0;
			$rows = array();
			foreach ($query->result() as $row){
				// Prepare a response
                $rows[$count] = $row;
                $count++;
            }
            $response = array('status' => 200, 'message' => 'Record Found', 'data'=> $rows);
		}
		else{			
			// Prepare a response
			$response = array('status' => 404, 'message' => 'Record Not Found');
		}

		return $response;
	}

	public function insertNewTraining($training_topic, $training_json){
		$response = array();
		
		$data = array(
			"training_topic" => $training_topic,
			"training_json" => $training_json
		);

		$this->db->insert(TRAININGS,$data);

		// If query successful
		if($this->db->affected_rows() == 1){
			$insert_id = $this->db->insert_id();
			$response = array('status' => 200, 'message' => 'Record Inserted Successfully', 'inserted_training_id'=> $insert_id);
		}
		else{
			$response = array('status' => 400, 'message' => 'Failed to insert the training');
		}

		return $response;
	}

	public function insertUserTrainingAssignment($user_id, $training_id){
		$response = array();
		
		$data = array(
			"user_id" => $user_id,
			"training_id" => $training_id,
			"status" => 0	
		);

		$this->db->insert(TRAINING_ASSIGNMENT,$data);

		// If query successful
		if($this->db->affected_rows() == 1){
			$insert_id = $this->db->insert_id();
			$response = array('status' => 200, 'message' => 'Record Inserted Successfully', 'inserted_training_id'=> $insert_id);
		}
		else{
			$response = array('status' => 400, 'message' => 'Failed to insert the training');
		}

		return $response;
	}
}
