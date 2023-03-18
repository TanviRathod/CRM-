<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    public $table="employees";
    protected $fillable=['id','first_name','last_name','compancy_id','email','phone'];

    public function compancy()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
