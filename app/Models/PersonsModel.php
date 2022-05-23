<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonsModel extends Model
{
    protected $table = 'persons';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'address'];

    public function search($keyword)
    {
        return $this->table('persons')->like('name', $keyword)->orLike('address', $keyword);
    }
}
