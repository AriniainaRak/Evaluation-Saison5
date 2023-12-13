<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    use HasFactory;
    protected $primaryKey = 'idadmins';
    protected $table = 'admins';
    public $timestamps = false;
    public $fillable =[
        'username',
        'pwd'
    ];

}
?>
