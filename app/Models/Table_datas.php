<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Table_datas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'table_datas';
    public $timestamps = false;
    public $fillable =[
        'idtype',
        'valeur'
    ];

    public function type_datum(){
        return $this->belongsTo(Type_datas::class, 'idtype');
    }

    public static function getValeur($id) {
        $query = DB::table('table_datas')->where('idtype', $id)->pluck('valeur')->first();
        return $query;
    }

    public function getPuissanceMax_panneau() {
		$data_id = Type_datas::getPuissanceMax_panneau();
		$puissance = $this->getValeur($data_id);

		return $puissance;
	}

    public function getValeurTaux_panneau() {
		$data_id = Type_datas::getTauxCode();
		$valeur_data = [];

			foreach($data_id as $id) {
				$valeur_data[] = $this->getValeur($id->id);
			}
		return $valeur_data;
	}

    public function getCapaciteJirama() {
		$data_id = Type_datas::getJirama();
		$capacite = $this->getValeur($data_id);

		return $capacite;
	}

    public function getTauxSol2() {
        $query = DB::table('table_datas')->where('idtype', 6)->pluck('valeur')->first();
		return $query;
	}

	public function getTauxSol3() {
        $query = DB::table('table_datas')->where('idtype', 7)->pluck('valeur')->first();
		return $query;
	}

	public function getTauxSol4() {
        $query = DB::table('table_datas')->where('idtype', 8)->pluck('valeur')->first();
		return $query;
	}

    // public function getProduction(){
    //     $table_data = new Table_datas();
    //     $production = $table_data->getProduction();

    //     return $production;
    // }
}
?>
