<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'formations';
    public $timestamps = false;
    public $fillable =[
        'nom',
        'attaquant',
        'milieu',
        'defense'
    ];

}
?>
