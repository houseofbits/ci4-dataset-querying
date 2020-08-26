<?php

use App\Models\SourceModel;
use CodeIgniter\Test\ControllerTester;

class SourceDataTest extends \Tests\Support\DatabaseTestCase
{
	use ControllerTester;

	protected $seed = 'Tests\Support\Database\Seeds\TestFooSeeder';

	public function setUp(): void
	{
		parent::setUp();
	}

	public function testDatabaseData()
	{
		$model = new SourceModel();

		$data = $model->asArray()->findAll(5, 0);

		$this->assertEquals(count($data), 5);

		$this->assertArrayHasKey('a', $data[0]);
		
		$this->assertArrayHasKey('b', $data[0]);

		$this->assertArrayHasKey('c', $data[0]);				

	}

	public function testDataValidity()
	{
		$model = new SourceModel();
		
		$data = $model->asArray()->findAll(1, 1);

		$this->assertNotEmpty($data);

		$a = $data[0]['a'];
		$b = $data[0]['b'];
		$c = $data[0]['c'];				

		$this->assertEquals($b, $a % 3);

		$this->assertEquals($c, $a % 5);	
		
	}

	public function testSourceControllerJson()
	{

        $result = $this->withURI('http://docker.local/dbs/foo/tables/source/json/1/10')
                       ->controller(\App\Controllers\SourceController::class)
					   ->execute('jsonDataRouted');	
					   
		$body = $result->getBody();

		$this->assertNotEmpty($body);

		$data = json_decode($body);

		$this->assertNotNull($data);

		$this->assertEquals(count($data), 10);

		$this->assertIsObject($data[0]);

		$this->assertObjectHasAttribute('a', $data[0]);		

		$this->assertObjectHasAttribute('b', $data[0]);				

		$this->assertObjectHasAttribute('c', $data[0]);				
	}
}
