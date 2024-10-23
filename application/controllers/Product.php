<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->input->is_ajax_request() === FALSE)
		{
			show_404();

			return;
		}

		$this->load->library('form_validation');
		$this->load->model('product_model');
	}

	/*
	/ -------------------------------------------------------------------------
	/ GET: /product
	/ -------------------------------------------------------------------------
	*/
	public function index()
	{
		$data = $this->product_model->all();

		if (empty($data) === TRUE)
		{
			$this->output->set_status_header(500);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => 'Tidak ada data produk'
					)
				)
			);
		}
		else
		{
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => TRUE,
						'message' => 'Daftar data produk',
						'data' => $data
					),
					JSON_NUMERIC_CHECK
				)
		);
		}
	}

	/*
	/ -------------------------------------------------------------------------
	/ POST: /product
	/ POST: /product/create
	/ -------------------------------------------------------------------------
	*/
	public function create()
	{
		$this->form_validation->set_rules(
			'name', 'nama produk',
			array('max_length[128]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'quantity', 'jumlah produk',
			array('integer', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'price', 'harga produk',
			array('greater_than_equal_to[0]', 'integer', 'required', 'trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$this->output->set_status_header(400);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => $this->form_validation->error_array()
					)
				)
			);
		}
		else
		{
			if ($this->product_model->create() === FALSE)
			{
				$this->output->set_status_header(500);
				$this->output->set_content_type('application/json')->set_output(json_encode(
						array(
							'success' => FALSE,
							'message' => 'Data produk gagal ditambahkan'
						)
					)
				);
			}
			else
			{
				$this->output->set_status_header(201);
				$this->output->set_content_type('application/json')->set_output(json_encode(
						array(
							'success' => TRUE,
							'message' => 'Data produk berhasil ditambahkan'
						)
					)
				);
			}
		}
	}

	/*
	/ -------------------------------------------------------------------------
	/ GET: /product/{id}
	/ GET: /product/show/{id}
	/ -------------------------------------------------------------------------
	*/
	public function show($id = NULL)
	{
		$data = $this->product_model->get($id);

		if ($this->product_model->exists($id) === FALSE)
		{
			$this->output->set_status_header(404);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => 'Data produk tidak ditemukan'
					)
				)
			);
		}
		else
		{
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => TRUE,
						'message' => 'Detail data produk',
						'data' => $data
					),
					JSON_NUMERIC_CHECK
				)
			);
		}
	}

	/*
	/ -------------------------------------------------------------------------
	/ POST: /product/update/{id}
	/ -------------------------------------------------------------------------
	*/
	public function update($id = NULL)
	{
		if ( ! $this->product_model->exists($id))
		{
			$this->output->set_status_header(404);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => 'Data produk tidak ditemukan'
					)
				)
			);

			return;
		}

		$this->form_validation->set_rules(
			'name', 'nama produk',
			array('max_length[128]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'quantity', 'jumlah produk',
			array('integer', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'produk', 'harga produk',
			array('greater_than_equal_to[0]', 'integer', 'required', 'trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$this->output->set_status_header(400);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => $this->form_validation->error_array()
					)
				)
			);
		}
		else
		{
			if ($this->product_model->update($id) === FALSE)
			{
				$this->output->set_status_header(500);
				$this->output->set_content_type('application/json')->set_output(json_encode(
						array(
							'success' => FALSE,
							'message' => 'Data produk gagal diubah'
						)
					)
				);
			}
			else
			{
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json')->set_output(json_encode(
						array(
							'success' => TRUE,
							'message' => 'Data produk berhasil diubah'
						)
					)
				);
			}
		}
	}

	/*
	/ -------------------------------------------------------------------------
	/ POST: /product/delete/{id}
	/ -------------------------------------------------------------------------
	*/
	public function delete($id = NULL)
	{
		if ( ! $this->product_model->exists($id))
		{
			$this->output->set_status_header(404);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => 'Data produk tidak ditemukan'
					)
				)
			);

			return;
		}

		if ($this->product_model->delete($id) === FALSE)
		{
			$this->output->set_status_header(500);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => FALSE,
						'message' => 'Data produk gagal dihapus'
					)
				)
			);
		}
		else
		{
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json')->set_output(json_encode(
					array(
						'success' => TRUE,
						'message' => 'Data produk berhasil dihapus'
					)
				)
			);
		}
	}
}
