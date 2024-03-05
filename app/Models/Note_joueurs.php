<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note_joueurs extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'note_joueurs';
    public $timestamps = false;
    public $fillable =[
        'idjoueur',
        'idcaracteristique',
        'valeur'
    ];

    public function joueur()
    {
        return $this->belongsTo(Joueurs::class, 'idjoueur');
    }

    public function caracteristique()
    {
        return $this->belongsTo(Caracteristiques::class, 'idcaracteristique');
    }

}
?>
