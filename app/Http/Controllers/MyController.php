<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Table_datas;
use App\Models\Type_datas;
use App\Models\Consommations;
// use App\Models\Utilisateurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MyController extends Controller
{

    public function login()
    {
        return view('pages/login');
    }

    public function loginUtil()
    {
        return view('pages/loginUtil');
    }

    public function logAdmin(Request $request)
    {

        $request->validate([
            // 'username' => 'required',
            'password' => 'required'
        ]);
        $user = Admins::where('username', '=', $request->username)->first();
        // echo $user;
        if ($user) {
            if ($request->password == $user->pwd) {
                # code...
                // $request->session()->put('loginId', $user->idadmin);
                Session::put('loginId', $user->idadmins);
                return view('pages/admin');
            } else {
                // echo "diso mdp";
                return back()->with('fail', 'Mot de passe incorrect');
            }
        } else {
            return back()->with('fail', 'Cette user n`est pas encore enregistrer');
        }
    }

    function insert(Request $request)
    {
        if (!empty($request)) {
            $modelName = 'App\Models\\' . $request['table'];
            $instance = app()->make($modelName);
            echo $instance;
            foreach ($instance->getFillable() as $fillable) {
                $instance[$fillable] = $request[$fillable];
            }
            $instance->save();
            return back()->with('success', 'insert effectuer');
        } else {
            return back()->with('fail', 'input invalide');
        }
    }

    function update(Request $request)
    {
        $modelName = 'App\Models\\' . $request['table'];
        $instance = app()->make($modelName);
        echo $instance->etat;
        $instance = $instance->find($request->id);
        echo $instance;
        foreach ($instance->getFillable() as $fillable) {
            $instance[$fillable] = $request[$fillable];
        }
        $instance->update();
        return back()->with('success', 'update effectuer');
    }

    function delete(Request $request)
    {
        $modelName = 'App\Models\\' . $request['table'];
        echo $request['table'];
        $instance = app()->make($modelName);
        $instance = $instance->find($request['id']);
        $instance->delete();
        return back();
    }

    public function admin()
    {
        $id = Session::get('loginId');
        if ($id) {
            return view('pages/admin');
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Session::forget('loginId');
        return redirect('/login');
    }

    // public function generatePDF(Request $request)
    // {
    //     $pdf = new Dompdf();
    //     $facture = Facture::where('idfacturepatient', '=', $request['idfacture'])->first();
    //     $patient = Patient::where('idpatient', '=', $facture->idpatient)->first();
    //     $detail = Detail::where('idfacturepatient', '=', $facture->idfacturepatient)->get();

    //     $data = [
    //         'facture' => $facture,
    //         'patient' => $patient,
    //         'detail' => $detail
    //     ];

    //     $html = view('pages.pdf.testpdf', $data)->render();
    //     $pdf->loadHtml($html);
    //     $pdf->getOptions()->set('title', 'exemple PDF');
    //     $pdf->render();
    //     $path = public_path('pdfs\\');
    //     $output = $path . "test.pdf";
    //     $pdf->stream($output);
    //     echo ('ok');
    // }

    public function typedata()
    {
        $data = [
            'table' => Type_datas::all()
        ];
        return view('pages/type', compact('data'));
    }

    public function data()
    {
        $data = [
            'data' => Table_datas::all(),
            'type' => Type_datas::all()
        ];
        return view('pages.data', compact('data'));
    }

    public function consommation()
    {
        $data = [
            'data' => Consommations::all()
        ];
        return view('pages.consommation', compact('data'));
    }

    public function import(Request $request)
    {
        $file = $request->file('csv_file');

        $handle = fopen($file, 'r');
        if ($handle !== false) {
            // ';' séparateur de champ
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {

                // Ajoutez une vérification pour vous assurer que toutes les colonnes nécessaires sont présentes dans le fichier CSV
                if (count($data) < 2) {
                    // Gérer le cas où le nombre de colonnes est insuffisant
                    return redirect()->back()->with('failed', 'Importation échouée. Le format du fichier CSV est incorrect.');
                }

                $code = $data[0];
                $valeur = $data[1];

                // Recherchez le type_data correspondant au code
                $typeData = DB::table('type_datas')->where('code', $code)->first();
                if ($typeData !== null) {
                    // Il y a une correspondance, vous pouvez accéder à $typeData->id en toute sécurité
                    $data = new Table_datas();
                    $data->idtype = $typeData->id; // Utilisez le nom correct de la colonne
                    $data->valeur = $valeur;
                    $data->save();
                } else {
                    // Aucune correspondance trouvée, vous pouvez gérer cela selon vos besoins
                    // Par exemple, ignorer l'insertion ou effectuer une autre action
                    // return redirect()->back()->with('failed', 'Importation échouée. Code introuvable : ' . $code);
                }
            }
            fclose($handle);
        }

        return redirect()->back()->with('success', 'Importation réussie.');
    }

    public function duree_grp()
    {
        $grp3_id = Type_datas::getGrp3();
        $grp2_id = Type_datas::getGrp2();

        $valeur_grp2 = Table_datas::getValeur($grp2_id);
        $valeur_grp3 = Table_datas::getValeur($grp3_id);

        $duree = $valeur_grp2 / $valeur_grp3;
        return $duree;
    }

    public function puissance_tranche()
    {
        $table_data = new Table_datas();
        $sol1 = $table_data->getPuissanceMax_panneau();

        $taux_data = $table_data->getValeurTaux_panneau();

        $puissance_tranche = [];

        foreach ($taux_data as $taux) {
            $puissance_tranche[] = $taux != 0 ? $sol1 / $taux : 0;
        }
        return $puissance_tranche;
    }

    public function getProduction()
    {

        $heure = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
        $grp3_id = Type_datas::getGrp3();
        $grp2_id = Type_datas::getGrp2();
        $grp1_id = Type_datas::getGrp1();

        $valeur_grp2 = Table_datas::getValeur($grp2_id);
        $valeur_grp3 = Table_datas::getValeur($grp3_id);
        $valeur_grp1 = Table_datas::getValeur($grp1_id);
        $duree = 1;

        $data = new Table_datas();
        $sol1 = $data->getPuissanceMax_panneau();
        $sol2 = $data->getTauxSol2();
        $sol3 = $data->getTauxSol3();
        $sol4 = $data->getTauxSol4();

        $tranche1 = ($sol1 * $sol2) / 100;
        $tranche2 = ($sol1 * $sol3) / 100;
        $tranche3 = ($sol1 * $sol4) / 100;

        $jirama_id = Type_datas::getJirama();
        $jirama = Table_datas::getValeur($jirama_id);

        $ret = [];
        for ($i = 0; $i < 10; $i++) {
            if ($i < 4) {
                $ret[$i] = $tranche1 + ($duree * $valeur_grp1) + $jirama;
                $reste_duree = $duree - 1;
            } else if ($i < 6) {
                $ret[$i] = $tranche2 + ($duree * $valeur_grp1) + $jirama;
                $duree = $duree - 1;
            } else {
                $ret[$i] = $tranche3 + ($duree * $valeur_grp1) + $jirama;
                $duree = $duree - 1;
            }

            $reste_duree--;

            if ($duree < 1) {
                $reste_duree = $duree;
                $duree = 0;
            }
        }
        return view('pages.production', ['ret' => $ret, 'heure' => $heure]);
    }

    public function getConsommation(Request $request)
    {
        $heure = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
        $taux = 100;
        $id = $request['id'];
        $conso = Consommations::where('id', '=', $id)->first();
        $taux_creuse = (float)$conso->taux_pers_h_creuse;
        $nbPers = (float)$conso->nb_pers;
        $consoFix = (float)$conso->consommation_fix;
        $puissMoy = (float)$conso->puissance_moy;
        $tauxEleve = $taux;
        $Consommation = [];
        $ConsommationFix = 0;
        $ConsommationEleve = 0;
        for ($i = 0; $i < count($heure); $i++) {
            if ($heure[$i] > 11 && $heure[$i] < 15) {
                $tauxEleve = $taux_creuse;
                $Consommation[$i] = ((($nbPers * $tauxEleve) / 100) * $puissMoy) + $consoFix;
            } else {
                $tauxEleve = $taux;
                $Consommation[$i] = ((($nbPers * $tauxEleve) / 100) * $puissMoy) + $consoFix;
            }
        }
        $data = [
            'conso' => $Consommation,
            'heure' => $heure,
            'prod' => $this->getProduction()
        ];
        return view('pages.conso', compact('data'));
    }
}
