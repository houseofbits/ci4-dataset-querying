<?php namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;
use App\Database\Migrations\Migration1 as AppMigration1;

class Migration1 extends AppMigration1
{
	protected $DBGroup = 'tests';
}
