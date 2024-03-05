<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coefficients extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'coeffficients';
    public $timestamps = false;
    public $fillable =[
        'idcaracteristique',
        'idposte',
        'valeur'
    ];

    public function joueur()
    {
        return $this->belongsTo(Joueurs::class, 'idjoueur');
    }

    public function poste()
    {
        return $this->belongsTo(Postes::class, 'idposte');
    }

}
?>
