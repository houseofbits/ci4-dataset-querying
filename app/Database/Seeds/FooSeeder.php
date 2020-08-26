<?
namespace App\Database\Seeds;

use CodeIgniter\CLI\CLI;

class FooSeeder extends \CodeIgniter\Database\Seeder
{
    protected $batchSize = 1000;
    protected $count = 1000000;
    protected $cliOutput = true;

    public function run()
    {
        $data = [];

        $batchCount = $this->count / $this->batchSize;
        $batchIndex = 1;

        for($a = 1; $a <= $this->count; $a++){

            array_push($data, [
                'a' => $a,
                'b' => $a % 3,
                'c' => $a % 5
            ]);
            
            if(!($a%$this->batchSize)) { 
                
                $this->db->table('source')->insertBatch($data);
                
                $data = [];

                if ($this->cliOutput) {
                    CLI::write("Inserting batch {$batchIndex} of {$batchCount}");
                    $batchIndex++;
                }
            }
        }
    }
}


