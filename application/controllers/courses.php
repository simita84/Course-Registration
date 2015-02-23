<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {

	protected $course_name;
	protected $course_description;
	protected $courses=array();

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{ 
		 $this->load->model('Course');
		 $courses=$this->Course->get_all_courses();
		 $this->load->view('courses/index',array('courses'=> $courses )); 		 				   
	}

	public function add_course()
	{
		if( $this->input->post("form_action") == "add_course" )
		{
			$course_name 		= $this->input->post("course_name",TRUE );
			$course_description = $this->input->post("course_desc",TRUE );
			if($course_name && $course_description)
			{
				$course_details=array('name'		 => $course_name , 
					           		  'description'  => $course_description );
				$this->load->model('Course');
				$add_course=$this->Course->add_course($course_details);
				
				if($add_course)
				{
					$this->session->set_flashdata("success_message","Course added successfully");
				}
			}
			else if(!$course_name || !$course_description)
			{
				$this->session->set_flashdata("error_message","Please fill in all fields");
			}
			 
		}
	redirect(base_url('/'));
	}

	public function delete_confirmation()
	{	
	//Preventing user to visit ~ courses/delete_confirmation directly
		if($this->input->post('action')=="remove_course")
		{
		    if($this->input->post('id'))
			{
			    $id = $this->input->post('id');
			    $course = array();
			    $this->load->model('Course');
				$course = $this->Course->get_course_by_id($id);
				if($course)
				{
					$this->load->view('courses/delete',array('course_details' =>$course ) );  
				}
				 
			}
	    }
		else
		{
			redirect(base_url('/'));
		}	
	}
	public function remove_course()
	{

		if($this->input->post('action')=="confirm")
		{
			 if($this->input->post('id'))
			{
				//Retrieve course id from input 
				$id            = $this->input->post('id');
				//Load Course Model
				$this->load->model('Course');
				$remove_course = $this->Course->remove_course_by_id($id);
				if($remove_course){
					$this->session->set_flashdata("success_message","Course deleted successfully");
				}
				else{
					$this->session->set_flashdata("error_message","Course cannot be deleted");
				}
				redirect(base_url('/'));
			}
			else
			{
				$this->session->set_flashdata("error_message","Course id not passed 
					                           So,course cannot be deleted");
				redirect(base_url('/') );
			}
		}
		else if($this->input->post('action')=="No")
		{
			$this->session->set_flashdata("error_message","Course deletion was cancelled by user");
			redirect(base_url('/'));
		}
		//Preventing user to visit ~ courses/remove_course directly
		else
		{
			redirect(base_url('/'));
		}
		
	}
}

//end of main controller