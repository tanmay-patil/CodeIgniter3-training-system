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
}
