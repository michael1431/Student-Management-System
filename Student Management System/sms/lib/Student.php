
<?php

    $filepath = realpath(dirname(__FILE__));
    
    include_once ($filepath.'/Database.php');

?>

<?php

class Student{

	private $db;
  
    public function __construct() {
       $this->db = new Database();
    }

    public function getStudents(){
    	$query = "SELECT *FROM tbl_student";
    	$result = $this->db->select($query);
    	return $result;
    }

    public function insertStudent($name,$roll){
    	$name = mysqli_real_escape_string($this->db->link,$name);
    	$roll = mysqli_real_escape_string($this->db->link,$roll);
    	if(empty($name)|| empty($roll)){
    		$msg = "<div class = 'alert alert-danger' style='text-align:center'><strong>Error !</strong> Field Must Not Be Empty!</div>";
    		return $msg;
    	}else{
    		$std_query = "INSERT INTO tbl_student(name,roll) VALUES ('$name','$roll')";
    		$insert_data = $this->db->insert($std_query);

    		$attd_query = "INSERT INTO tbl_attendence(roll) VALUES ('$roll')";
    		$insert_data = $this->db->insert($attd_query);

    		if($insert_data){
    			$msg = "<div class = 'alert alert-success' style='text-align:center'><strong>Success!</strong> Student Data Insert Successfully.</div>";
    		return $msg;
    		}else{
    			$msg = "<div class = 'alert alert-danger' style='text-align:center'><strong> Failed!</strong> Student Data Not Inserted!</div>";
    		return $msg;
    		}

    	}


    }

    public function insertAttendence($cur_date,$attend = array()){

    	$query = "SELECT DISTINCT att_time FROM tbl_attendence";

    	$getdata = $this->db->select($query);

    	while($result = $getdata->fetch_assoc()){
    		// check attendence
    		// only distinct date er value gulo niye asbo database tekhe
    		// jate same date e attendence r neya na jai
    		
    		$db_data = $result['att_time'];
    		
    		if($cur_date == $db_data){

    			$msg = "<div class = 'alert alert-danger' style='text-align:center'><strong>Error !</strong> Attendence Already Taken Today!</div>";
    		 return $msg;
    		}
    	}

    	//  Attend name er maddome amra array pass kortechi so foreach loop calabo
    	foreach ($attend as $atn_key => $atn_value) {
    		// array modde je roll ache oita key and value modde jeta ache atn_value
    		if($atn_value == "present"){
    			$attend_insert_query = "INSERT INTO tbl_attendence(roll,attend,att_time) VALUES('$atn_key','present',now())";
    			$data = $this->db->insert($attend_insert_query);
    		}elseif($atn_value == "absent"){
    			$attend_insert_query = "INSERT INTO tbl_attendence(roll,attend,att_time) VALUES('$atn_key','absent',now())";
    			$data = $this->db->insert($attend_insert_query);
    		}
    	}

    	if($data){
    			$msg = "<div class = 'alert alert-success' style='text-align:center'><strong>Success!</strong> Attendence Taken Successfully.</div>";
    		return $msg;
    	}else{
    			$msg = "<div class = 'alert alert-danger' style='text-align:center'><strong>Error!</strong> Attendence Not Taken!</div>";
    		return $msg;
    	}



    }

    public function getDateList(){
    	$query = "SELECT DISTINCT att_time FROM tbl_attendence";

    	$result = $this->db->select($query); 
    	return $result;


    }

    public function getAllStudentByDate($dt){

    	$dt = mysqli_real_escape_string($this->db->link,$dt);

    	// code for inner join two table
    	$query = "SELECT tbl_student.name, tbl_attendence.*
    		FROM tbl_student
    	    INNER JOIN tbl_attendence
    		ON tbl_student.roll = tbl_attendence.roll
    		WHERE att_time = '$dt'";
    	$result = $this->db->select($query); 
    	return $result;
    }

    public function UpdateAttendence($dt,$attend){
    	// jehetu attend hocche array so foreach loop calate hobe

    	foreach ($attend as $atn_key => $atn_value) {
    		// array modde je roll ache oita key and value modde jeta ache atn_value
    		if($atn_value == "present"){
    			$query = "UPDATE tbl_attendence
    				SET attend = 'present'
    				WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
    			    $update_data = $this->db->update($query);

    		}elseif($atn_value == "absent"){
    			
    			   $query = "UPDATE tbl_attendence
    				SET attend = 'absent'
    				WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
    			    $update_data = $this->db->update($query);
    		}
    	}

    	if($update_data){
    			$msg = "<div class = 'alert alert-success' style='text-align:center'><strong>Success!</strong> Attendence Updated Successfully.</div>";
    		return $msg;
    	}else{
    			$msg = "<div class = 'alert alert-danger' style='text-align:center'><strong>Error!</strong> Attendence Not Updated!</div>";
    		return $msg;
    	}

    }

    
    
}



