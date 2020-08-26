<?php namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Database\Seeds\FooSeeder as AppFooSeeder;

class TestFooSeeder extends AppFooSeeder
{   
    /** Reduce dataset size to speed up tests */
    protected $batchSize = 100;
    protected $count = 1000;
    protected $cliOutput = false;
}
