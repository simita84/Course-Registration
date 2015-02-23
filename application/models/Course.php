<?php 
	Class Course extends CI_model
	{
		
		public function get_course_by_id($id)
		{
			$fetch_query="SELECT * FROM courses where id = ? ";
			return $this->db->query($fetch_query,$id)->result_array();
		}
		public function get_all_courses()
		{
			$fetch_query = "SELECT * from COURSES ";
			return $this->db->query($fetch_query)->result_array();
		}
		public function add_course($course)
		{	
			$course_details=array($course['name'],
								  $course['description'],
								   date("Y-m-d H:i:s"),
								   date("Y-m-d H:i:s") );
			$insert_query="INSERT INTO Courses (name,description,created_at,updated_at)
			                          VALUES (?,?,?,?) ";
			return $this->db->query($insert_query,$course_details);
		}
		public function remove_course_by_id($id)
		{
			$delete_query = "DELETE from COURSES where id = ? ";
			return $this->db->query($delete_query,$id);
		}
	}
?>