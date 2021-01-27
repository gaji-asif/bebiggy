<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Template extends CI_Controller {

	
    /*User Dashboard*/
    public function page(){
		$this->load->view('template/page');
	}

	public function home(){
		$this->load->view('template/home');
	}

	public function course(){
		$this->load->view('template/course');
	}

	public function course_detail(){
		$this->load->view('template/course_detail');
	}

	public function about(){
		$this->load->view('template/about');
	}

		public function contact(){
		$this->load->view('template/contact');
	}
	public function blog(){
		$this->load->view('template/blog');
	}
	public function faq(){
		$this->load->view('template/faq');
	}

	}