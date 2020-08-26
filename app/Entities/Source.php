<?

namespace App\Entities;

use CodeIgniter\Entity;

class Source extends Entity
{
    protected $attributes = [
        'a' => null,
        'b' => null,
        'c' => null
    ];

    /**
     * @return int
     */
    public function getA(): int
    {
        return $this->attributes['a'];
    }
    /**
     * @return int
     */
    public function getB(): int
    {
        return $this->attributes['b'];
    }    
    /**
     * @return int
     */
    public function getC(): int
    {
        return $this->attributes['c'];
    }
}