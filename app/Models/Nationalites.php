<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalites extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'nationalites';
    public $timestamps = false;
    public $fillable =[
        'intitule',
        'code'
    ];

}
?>
