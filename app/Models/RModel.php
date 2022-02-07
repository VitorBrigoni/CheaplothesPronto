<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $timestamps = true; //Professor, utilizei aqui para assegurar que o laravel crie o created_at e o updated_at
    public $increment = true;
    protected $fillable = [];

    //Criei essa RModel para poder programar validações e dados antes de chamar o save (pesquisei para descobrir como fazia :)

    public function beforeSave(){
        return true;
    }

    public function save(array $options = []){
        try{
            If(!$this->beforeSave()){
                return false;
            }
            return parent::save($options);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}