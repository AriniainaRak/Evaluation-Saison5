<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristiques extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'caracteristiques';
    public $timestamps = false;
    public $fillable =[
        'intitule',
        'code'
    ];

}
?>
