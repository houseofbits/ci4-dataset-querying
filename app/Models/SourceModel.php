<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Source;

class SourceModel extends Model
{
    protected $table         = 'source';
    protected $allowedFields = ['a', 'b', 'c'];
    protected $returnType    = Source::class;
}