<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consommations extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'consommations';
    public $timestamps = false;
    public $fillable =[
        'nb_pers',
        'puissance_moy',
        'consommation_fix',
        'taux_pers_h_creuse'
    ];

}
?>
