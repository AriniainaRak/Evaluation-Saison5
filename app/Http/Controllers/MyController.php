<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Caracteristiques;
use App\Models\Coefficients;
use App\Models\Clubs;
use App\Models\Nationalites;
use App\Models\Formations;
use App\Models\Postes;
use App\Models\Techniques;
use App\Models\Joueurs;
use App\Models\Note_joueurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function logUtil(Request $request)
    {
        $request->validate([
            // 'email' => 'required',
            'password' => 'required'
        ]);
        $user = Techniques::where('username', '=', $request->username)->first();
        if ($user) {
            if ($request->password == $user->pwd) {
                # code...
                Session::put('loginId', $user->id);
                // $data = [
                //     'calendrier' => calendrier::all(),
                //     'sport' => sport::all(),
                //     'lieu' => lieu::all()
                // ];
                return view('pages/technique');
            } else {
                return back()->with('fail', 'Mot de passe incorrect');
            }
        } else {
            return back()->with('fail', 'Cette Email n`est pas encore enregistrer');
        }
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

    public function fiche(Request $request)
    {
        $id = $request['id'];
        // echo $request ['id'];
        // echo $data['joueur'];
        // $joueur = Joueurs::where('id','=',$id)->firstOrFail();
        $joueur = Joueurs::where('id','=',$id)->get();
        // echo $joueur->nom;
        // dd($joueur);
        if($joueur){
            $data = [
                'joueur' =>  $joueur
            ];
            return view('pages.fiche')->with('joueur',$joueur);
        }else{
            return back();
        }
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

    public function nationalite()
    {

        $data = [
            'nationalite' => Nationalites::all()
        ];
        return view('pages/nationalite', compact('data'));
    }

    public function club()
    {

        $data = [
            'club' => DB::table('clubs')->get()
        ];
        return view('pages/club', compact('data'));
    }

    public function caracteristique()
    {
        $data = [
            'caracteristique' => Caracteristiques::all()
        ];
        return view('pages.caracteristique', compact('data'));
    }

    public function formation()
    {
        $data = [
            'formation' => Formations::all()
        ];
        return view('pages.formation', compact('data'));
    }

    public function poste()
    {
        $data = [
            'poste' => Postes::all()
        ];
        return view('pages.poste', compact('data'));
    }

    public function coefficient()
    {
        $data = [
            'coefficient' => DB::table('coefficients')->get(),
            'caracteristique' => Caracteristiques::all(),
            'poste' => Postes::all()
        ];
        return view('pages.coefficient', compact('data'));
    }

    public function joueur()
    {
        $data = [
            'joueur' => Joueurs::all(),
            'nationalite' => Nationalites::all(),
            'club' => DB::table('clubs')->get()
        ];
        return view('pages.joueur', compact('data'));
    }

    // public function equipe()
    // {
    //     $data = [
    //         'joueur' => Joueurs::all(),
    //         'formation' => Formations::all(),
    //         'poste' => Postes::all()
    //     ];
    //     return view('pages.formation', compact('data'));
    // }

    public function note_joueur()
    {
        $data = [
            'note_joueur' => Note_joueurs::all(),
            'joueur' => Joueurs::all(),
            'caracteristique' => Caracteristiques::all()
        ];
        return view('pages.notejoueur', compact('data'));
    }

    public function liste()
    {
        $joueurs = Joueurs::all();
        return view('pages.liste', compact('joueurs'));
    }

    public function recherche(Request $request)
    {
        // $data = [
        //     'joueur'=>Joueurs::all(),
        //     'poste'=>Postes::all(),
        //     'caracteristique'=>Caracteristiques::all()
        // ];
        // Récupérer les paramètres de recherche depuis la requête
        $nom = $request->input('nom');
        $poste = $request->input('poste');
        $nationalite = $request->input('nationalite');

        // Commencer la construction de la requête
        $query = Joueurs::query();

        // Appliquer les conditions de recherche si les paramètres sont fournis
        if ($nom) {
            $query->where('nom', 'like', '%' . $nom . '%');
        }

        if ($poste) {
            // Si poste est une clé étrangère, ajustez cette condition en conséquence
            $query->where('id_poste', $poste);
        }

        if ($nationalite) {
            // Si nationalite est une clé étrangère, ajustez cette condition en conséquence
            $query->where('id_nationalite', $nationalite);
        }

        // Exécuter la requête et récupérer les résultats
        $joueurs = $query->get();

        // Passer les résultats à la vue et afficher
        return view('pages.liste', compact('joueurs'));
    }

    public function insertJoueur(Request $request)
    {
        $image = $request->file('photo');
        $nom = $request->nom;
        $nationalite = $request->idnationalite;
        $club = $request->idclub;
        $name = $image->store('public/image');
        $name = str_replace('public/', '', $name);
        $data = [
            'nom' => $nom,
            'idnationalite' => $nationalite,
            'idclub' => $club,
            'photo' => $name
        ];
        Joueurs::create($data);
        return back();
    }

    public function importClub(Request $request)
    {
        // Validate the file input
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        // Get the uploaded file
        $file = $request->file('csv_file');
        $handle = fopen($file->path(), 'r');

        // Lire et ignorer la première ligne
        fgetcsv($handle, 0, ';');

        // Créer un tableau pour stocker les données
        $data = [];

        // Lire les données restantes
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            // Ajouter la ligne de données au tableau
            $data[] = $row;
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                // Vérifier si la ligne contient suffisamment de données
                if (count($row) >= 2) {
                    // Ajouter la ligne de données au tableau
                    $data[] = $row;
                } else {
                    // Gérer le cas où la ligne ne contient pas suffisamment de données
                    // Par exemple, ignorer la ligne ou enregistrer un message d'erreur
                    Log::warning("La ligne ne contient pas suffisamment de données : " . implode(', ', $row));
                }
            }
        }

        fclose($handle);

        // Insert the data into the database
        foreach ($data as $row) {
            // Assuming the first column contains the code_club and the second column contains the intitule
            $code = $row[0];
            $intitule = $row[1];

            // Create a new instance of the Club model
            $club = new Clubs;
            $club->code = $code;
            $club->intitule = $intitule;
            $club->save();
        }

        return back()->with('csvsuccess', 'Importation réussie.');
    }

    public function importNationalite(Request $request)
    {
        // Validate the file input
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        // Get the uploaded file
        $file = $request->file('csv_file');
        $handle = fopen($file->path(), 'r');

        // Lire et ignorer la première ligne
        fgetcsv($handle, 0, ';');

        // Créer un tableau pour stocker les données
        $data = [];

        // Lire les données restantes
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            // Ajouter la ligne de données au tableau
            $data[] = $row;
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                // Vérifier si la ligne contient suffisamment de données
                if (count($row) >= 2) {
                    // Ajouter la ligne de données au tableau
                    $data[] = $row;
                } else {
                    // Gérer le cas où la ligne ne contient pas suffisamment de données
                    // Par exemple, ignorer la ligne ou enregistrer un message d'erreur
                    Log::warning("La ligne ne contient pas suffisamment de données : " . implode(', ', $row));
                }
            }
        }

        fclose($handle);

        // Insert the data into the database
        foreach ($data as $row) {
            // Assuming the first column contains the code_club and the second column contains the intitule
            $code = $row[1];
            $intitule = $row[0];

            // Create a new instance of the Club model
            $nationalite = new Nationalites;
            $nationalite->code = $code;
            $nationalite->intitule = $intitule;
            $nationalite->save();
        }

        return back()->with('csvsuccess', 'Importation réussie.');
    }

    public function importCoefficients(Request $request)
    {
        // Valider le fichier d'entrée
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);
        // Obtenir le fichier téléchargé
        $file = $request->file('csv_file');
        $handle = fopen($file->path(), 'r');
        fgetcsv($handle, 0, ';'); // Sauter la première ligne du fichier CSV

        // Lire les données restantes
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            // echo  "Lecture : ".implode(";",$row)."\n";
            // Récupérer les données de la ligne
            $poste = $row[0];
            // echo $poste;
            $caracteristique = $row[1];
            // echo $caracteristique;
            $coef = $row[2];
            // echo $coef;

            // Ajouter des instructions de journalisation
            // Log::info("Poste : $poste, Caractéristique : $caracteristique, Coef : $coef");

            // Vérifier l'existence des données de référence
            $posteId = DB::table('postes')->where('intitule', $poste)->value('id');
            echo "poste id = " . $posteId;
            $caracteristiqueId = DB::table('caracteristiques')->where('code', $caracteristique)->value('id');
            // echo "caracteristique id = ".$caracteristiqueId;

            // Ajouter des instructions de journalisation
            // Log::info("Poste ID : $posteId, Caractéristique ID : $caracteristiqueId");

            if ($posteId !== null && $caracteristiqueId !== null) {
                // Insérer les données dans la base de données
                DB::table('coefficients')->insert([
                    'idcaracteristique' => $caracteristiqueId,
                    'idposte' => $posteId,
                    'valeur' => $coef
                ]);
            } else {
                // Gérer le cas où les données de référence n'existent pas
                Log::warning("Les données de référence pour la ligne ne sont pas trouvées : Poste = $poste, Caractéristique = $caracteristique");
            }
        }
        fclose($handle);
        return back()->with('csvsuccess', 'Importation réussie.');
    }


    public function importJoueur(Request $request)
    {
        // Valider le fichier d'entrée
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);
        // Obtenir le fichier téléchargé
        $file = $request->file('csv_file');
        $handle = fopen($file->path(), 'r');
        // $headers = fgetcsv($handle, 0, ';');
        fgetcsv($handle, 0, ';'); // Sauter la première ligne du fichier CSV
        // echo $headers[0];
        // Lire les données restantes
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            // echo  "<p>Lecture : ".implode(";",$row)."</p>";
            // Récupérer les données de la ligne
            $nom = $row[0];
            // echo $nom;
            $prenom = $row[1];
            // echo $caracteristique;
            $taille = $row[2];
            // echo $coef;
            $nationalite = $row[7];

            $club = $row[8];

            // Vérifier l'existence des données de référence
            $nationaliteId = DB::table('nationalites')->where('intitule', $nationalite)->value('id');
            // echo "<p>nationalite id = ".$nationaliteId."</p>";
            $clubId = DB::table('clubs')->where('code', $club)->value('id');
            // echo "<p>club id = ".$clubId."</p>";


            if ($nationaliteId !== null && $clubId !== null) {
                // Insérer les données dans la base de données
                echo "<p>Insertion en cours pour " . $nom." ".$prenom ." ". $taille ."</p>";
                DB::table('joueurs')->insert([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'taille' => $taille,
                    'idnationalite' => $nationaliteId,
                    'idclub' => $clubId
                ]);
                $joueurid = DB::table('joueurs')->where('nom', $nom)->value('id');
                // echo  "<p>Joueur ID = ".$joueurid;
                // echo $row[12];
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '1',
                    'valeur' => $row[9]
                ]);
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '2',
                    'valeur' => $row[10]
                ]);
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '3',
                    'valeur' => $row[11]
                ]);
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '4',
                    'valeur' => $row[12]
                ]);
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '5',
                    'valeur' => $row[13]
                ]);
                DB::table('note_joueurs')->insert([
                    'idjoueur' => $joueurid,
                    'idcaracteristique' => '6',
                    'valeur' => $row[14]
                ]);
            } else {
                // Gérer le cas où les données de référence n'existent pas
                return back()->with('csverror', 'Importation réussie.');
            }
            echo $joueurid;
            if ($row[3] == 1) {
                // echo "<p>Attaquant</p>";
                DB::table('poste_joueur')->insert([
                        'idjoue
                        ur' => $joueurid,
                        'idposte' => '1',
                        'valeur' => $row[3]
                    ]);
            }
            if ($row[4] == 1) {
                // echo "<p>Milieu</p>";
                DB::table('poste_joueur')->insert([
                        'idjoueur' => $joueurid,
                        'idposte' => '2',
                        'valeur' => $row[4]
                    ]);
            }
            if ($row[5] == 1) {
                // echo "<p>defense</p>";
                    DB::table('poste_joueur')->insert([
                            'idjoueur' => $joueurid,
                            'idposte' => '3',
                            'valeur' => $row[5]
                        ]);
            }
            if ($row[6] == 1) {
                // echo "<p>gardien</p>";
                DB::table('poste_joueur')->insert([
                    'idjoueur' => $joueurid,
                    'idposte' => '4',
                    'valeur' => $row[6]
                ]);
            }
        }
        fclose($handle);
        return back()->with('csvsuccess', 'Importation réussie.');
    }



    public function comparerJoueurs($idJoueur1, $idJoueur2) {
        // Récupérer les données des joueurs à partir de leur identifiant
        $joueur1 = Joueurs::findOrFail($idJoueur1);
        $joueur2 = Joueurs::findOrFail($idJoueur2);

        // Comparer les attributs des deux joueurs
        $comparaison = [];

        // Comparaison des attributs communs
        $attributsCommuns = ['taille', 'physique', 'vitesse', 'passe', 'tir', 'dribble', 'defense'];

        foreach ($attributsCommuns as $attribut) {
            $diff = $joueur1->$attribut - $joueur2->$attribut;
            if ($diff > 0) {
                $resultat = $joueur1->nom . ' a une meilleure ' . $attribut . ' que ' . $joueur2->nom . ' de ' . $diff;
            } elseif ($diff < 0) {
                $resultat = $joueur2->nom . ' a une meilleure ' . $attribut . ' que ' . $joueur1->nom . ' de ' . abs($diff);
            } else {
                $resultat = $joueur1->nom . ' et ' . $joueur2->nom . ' ont la même ' . $attribut;
            }
            $comparaison[$attribut] = $resultat;
        }

        // Renvoyer les résultats à la vue
        return view('comparaison', compact('joueur1', 'joueur2', 'comparaison'));
    }

    public function formerEquipe() {
        // Récupérer tous les joueurs disponibles
        $joueurs = Joueurs::all();

        // Appliquer les critères de formation pour former l'équipe
        $equipe = [];

        // Par exemple, former une équipe avec un gardien, des défenseurs, des milieux et des attaquants
        $gardien = Joueurs::where('poste', 'gardien')->orderBy('competence')->first();
        $defenseurs = Joueurs::where('poste', 'defenseur')->orderBy('competence')->take(4)->get();
        $milieux = Joueurs::where('poste', 'milieu')->orderBy('competence')->take(4)->get();
        $attaquants = Joueurs::where('poste', 'attaquant')->orderBy('competence')->take(2)->get();

        // Ajouter les joueurs à l'équipe
        $equipe[] = $gardien;
        $equipe = array_merge($equipe, $defenseurs->toArray());
        $equipe = array_merge($equipe, $milieux->toArray());
        $equipe = array_merge($equipe, $attaquants->toArray());

        // Retourner la vue avec l'équipe formée
        return view('equipe', compact('equipe'));
    }

    public function equipe(
    ) {
        // Récupérer tous les joueurs disponibles
        $joueurs = Joueurs::all();

        // Initialiser un tableau pour stocker les joueurs de l'équipe
        $equipe = [];

        // Analyser la formation pour déterminer le nombre de joueurs requis pour chaque position
        $positions = explode('-', $formation);

        // Vérifier si la formation est valide (ex. 4-4-2, 4-3-3)
        if (count($positions) != 3) {
            // Formation invalide, rediriger avec un message d'erreur
            return back()->with('error', 'Formation invalide.');
        }

        // Sélectionner les joueurs pour chaque position en fonction de la formation
        foreach ($positions as $position) {
            switch ($position) {
                case '4':
                    $joueursPourPosition = $joueurs->where('poste', 'defenseur')->take(4);
                    break;
                case '3':
                    $joueursPourPosition = $joueurs->where('poste', 'milieu')->take(3);
                    break;
                case '2':
                    $joueursPourPosition = $joueurs->where('poste', 'attaquant')->take(2);
                    break;
                default:
                    // Formation invalide, rediriger avec un message d'erreur
                    return back()->with('error', 'Formation invalide.');
            }

            // Ajouter les joueurs sélectionnés à l'équipe
            $equipe = array_merge($equipe, $joueursPourPosition->toArray());
        }

        // Retourner la vue avec l'équipe formée
        return view('equipe', compact('equipe'));
    }




}
