<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	protected $table = 'products';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('date');
	}

	public function all()
	{
		$products = $this->db->get($this->table)->result_array();

		return array_map(
			function($product)
			{
				$product['createdAt'] = mdate('%Y-%m-%dT%H:%i:%sZ', human_to_unix($product['created_at']));
				unset($product['created_at']);
				$product['updatedAt'] = mdate('%Y-%m-%dT%H:%i:%sZ', human_to_unix($product['updated_at']));
				unset($product['updated_at']);

				return $product;
			},
			$products
		);
	}

	public function exists($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		return (bool) $this->db->get($this->table)->num_rows();
	}

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		$product = $this->db->get($this->table)->row_array();
		$product['createdAt'] = mdate('%Y-%m-%dT%H:%i:%sZ', human_to_unix($product['created_at']));
		unset($product['created_at']);
		$product['updatedAt'] = mdate('%Y-%m-%dT%H:%i:%sZ', human_to_unix($product['updated_at']));
		unset($product['updated_at']);

		return $product;
	}

	public function create()
	{
		$product = array(
			'name' => $this->input->post('name'),
			'quantity' => $this->input->post('quantity'),
			'price' => $this->input->post('price'),
			'created_at' => mdate('%Y-%m-%d %H:%i:%s'),
			'updated_at' => mdate('%Y-%m-%d %H:%i:%s')
		);

		$this->db->trans_start();
		$this->db->set($product);
		$this->db->insert($this->table);
		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	public function update($id)
	{
		$product = array(
			'name' => $this->input->post('name'),
			'quantity' => $this->input->post('quantity'),
			'price' => $this->input->post('price'),
			'updated_at' => mdate('%Y-%m-%d %H:%i:%s')
		);

		$this->db->trans_start();
		$this->db->set($product);
		$this->db->where('id', $id);
		$this->db->update($this->table);
		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	public function delete($id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		$this->db->trans_complete();

		return $this->db->trans_status();
	}
}
