<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$array['error'] = null;
		$this->load->view('login', $array);
	}
}
