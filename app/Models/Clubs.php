<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'clubs';
    public $timestamps = false;
    public $fillable =[
        'intitule',
        'code'
    ];

}
?>
