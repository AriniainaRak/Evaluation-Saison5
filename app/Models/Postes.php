<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postes extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'postes';
    public $timestamps = false;
    public $fillable =[
        'intitule',
        'code'
    ];

}
?>
