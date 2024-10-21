<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->input->is_cli_request() === FALSE)
		{
			show_404();

			return;
		}
	}

	public function index()
	{
		$this->load->library('migration');

    if ($this->migration->current() === FALSE)
    {
    	show_error($this->migration->error_string());
    }
	}
}
