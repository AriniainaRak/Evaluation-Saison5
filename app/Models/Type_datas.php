<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type_datas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'type_datas';
    public $timestamps = false;
    public $fillable =[
        'code',
        'nom'
    ];

    public static function getType($code) {
        $query = DB::table('type_datas')->where('code', 'LIKE', $code)->pluck('id')->first();
        return $query;
    }

    public static function getGrp3() {
        $query = DB::table('type_datas')->where('code', 'LIKE', 'GRP3')->pluck('id')->first();
        return $query;
    }

    public static function getGrp2() {
        $query = DB::table('type_datas')->where('code', 'LIKE', 'GRP2')->pluck('id')->first();
        return $query;
    }

    public static function getGrp1() {
        $query = DB::table('type_datas')->where('code', 'LIKE', 'GRP1')->pluck('id')->first();
        return $query;
    }

    public static function getTauxCode() {
        $query ="SELECT id FROM type_datas WHERE code LIKE 'SOL%' AND code <> 'SOL1' ";
        $result = DB::select($query);

        return $result;
    }

    public static function getPuissanceMax_panneau() {
        $result = DB::table('type_datas')->where('code', 'LIKE', '%SOL1%')->pluck('id')->first();
        return $result;
    }

    public static function getJirama() {
        $query = DB::table('type_datas')->where('code', 'LIKE', 'JIR1')->pluck('id')->first();
        return $query;
    }

}
?>
