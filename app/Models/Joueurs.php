<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueurs extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'joueurs';
    public $timestamps = false;
    public $fillable =[
        'nom',
        'idnationalite',
        'idclub',
        'photo'
    ];

    public function nationalite()
    {
        return $this->belongsTo(Nationalites::class, 'idnationalite');
    }

    public function club()
    {
        return $this->belongsTo(Clubs::class, 'idclub');
    }

}
?>
