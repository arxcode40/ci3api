<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	public function not_found()
	{
		$this->output->set_status_header(404);
		$this->output->set_content_type('application/json')->set_output(json_encode(
				array(
					'success' => FALSE,
					'message' => 'Halaman tidak ditemukan'
				)
			)
		);
	}
}
