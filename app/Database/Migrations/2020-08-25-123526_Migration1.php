<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration1 extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'a' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'b' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],
            'c' => [
                'type' => 'INT',
                'unsigned' => TRUE,
            ],                        
        ]);
        $this->forge->addKey('a', TRUE);
        $this->forge->addKey('b', TRUE);
        $this->forge->addKey('c', TRUE);                
        $this->forge->createTable('source');
	}

	public function down()
	{
		$this->forge->dropTable('source');
	}
}
