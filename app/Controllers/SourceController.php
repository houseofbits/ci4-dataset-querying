<?

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SourceModel;
use App\Entities\Source;

class SourceController extends ResourceController
{
    protected $modelName = SourceModel::class;
    protected $format    = 'json';
    private $csvChunkSize = 100;

    /**
     * This is using request data from GET so urls like this would work:
     * "source?page=1&page_size=100"
     */
    public function jsonData()
    {
        $page = $this->request->getGet('page');
        $pageSize = $this->request->getGet('page_size');
        
        return $this->respond($this->model->paginate($pageSize, 'data', $page));
    }
    /**
     * This is using CodeIgniter URI routing so urls like this is preferred:
     * "/source/2/100" where "/source/[page]/[page_size]"
     */
    public function jsonDataRouted($page = 0, $pageSize = 10)
    {        
        return $this->respond($this->model->paginate($pageSize, 'data', $page));
    }
    /**
     * Return CSV data in HTTP chunked encoding response
     */
    public function csvChunkedData(){

        $this->response
            ->setHeader('Transfer-encoding', 'chunked')        
//            ->setHeader('Content-Type', 'text/csv')         //To force CSV file download
            ->setHeader('Content-Type', 'text/plain')     //To render CSV output in browser
            ->noCache();
        $this->response->setBody('');
        //Send headers
        $this->response->send();

        $handle = fopen('php://output', 'w');

        $offset = 0;
        $data = 0;

        do {
            $data = $this->model->asArray()->findAll($this->csvChunkSize, $offset * $this->csvChunkSize);

            foreach ($data as $row)
            {
                fputcsv($handle, $row);
            }
            
            ob_end_flush();
            if (ob_get_level() > 0) {
                @ob_flush();
            }
            flush();
            ob_start();                 

            $offset++;

        }while(!empty($data));            
           
        fclose($handle);
    }
}