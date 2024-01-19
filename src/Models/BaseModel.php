<?php

namespace Webly\Core\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function newEntity($data = null) 
    {        
        return new $this->returnType();
    }

    public function save($data): bool
    {
        if(gettype($data) == 'array') {
            if(empty($data['id'])) {
                unset($data['id']);
            }
            return parent::save($data);
        }

        if($data->hasChanged()) {
            return parent::save($data);
        }

        return true;
    }    
}
