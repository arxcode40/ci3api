<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_products_table extends CI_Migration {

	public function up() {
		$this->dbforge->add_field(
			array(
	      'id' => array(
	        'auto_increment' => TRUE,
	        'type' => 'BIGINT',
	        'unsigned' => TRUE
	      ),
	      'name' => array(
	        'constraint' => '128',
	        'type' => 'VARCHAR'
	      ),
	      'quantity' => array(
	        'type' => 'INT'
	      ),
	      'price' => array(
	        'type' => 'BIGINT'
	      ),
	      'created_at' => array(
	        'type' => 'DATETIME'
	      ),
	      'updated_at' => array(
	        'type' => 'DATETIME'
	      )
	    )
		);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('products');	
	}

	public function down() {
		$this->dbforge->drop_table('products');
	}
}
