<?php 

namespace Controller\editeur;
use Controller\editeur\MainEditeur;
use Controller\editeur\sessionEditeur;

class Jeu extends sessionEditeur {


    public function getjeuxEditeurEnLigne()
    {
      parent::checkConnected();
        $jeux = new \Model\jeu();
        $nomEditeur = $_SESSION["nom_societe"];
        $vosJeux=$jeux->getjeuxEditeurEnLigne($nomEditeur);

            MainEditeur::$view->title = 'Liste de vos jeux en ligne';
            MainEditeur::$view->h1_title = 'Liste de vos Jeux en ligne ';
            MainEditeur::$view->jeux = $vosJeux;
            $this->factoGetControlleurGenre(jeux: $jeux);
            MainEditeur::$view->Display('editeur/jeuxEditeurEnLigne');
          }
      
    
public function getjeuxEditeurEnAttente() {
  parent::checkConnected();
        $jeux = new \Model\jeu();
        $nomEditeur = $_SESSION["nom_societe"];
        $vosJeux=$jeux->getjeuxEditeurEnAttente($nomEditeur);
         MainEditeur::$view->title = 'Liste de vos jeux en Attente';
         MainEditeur::$view->h1_title = 'Liste de vos Jeux en Attente de Validation';
         MainEditeur::$view->jeux = $vosJeux;
         $this->factoGetControlleurGenre(jeux: $jeux);
         MainEditeur::$view->Display('editeur/jeuxEditeurEnAttente');
}

public function factoGetControlleurGenre($jeux) {
  $categories = $jeux->getCategories();
  $controlleurs = $jeux->getControlleurs();
  $genres= $jeux->getGenres();


  MainEditeur::$view->categories = $categories;
  MainEditeur::$view->controlleurs = $controlleurs;
  MainEditeur::$view->genres = $genres;

}

public function soumettreJeuView() {
  parent::checkConnected();
  $jeux = new \Model\jeu();
  $nomEditeur = $_SESSION["nom_societe"];
  $vosJeux=$jeux->getjeuxEditeurEnLigne($nomEditeur);
  $this->factoGetControlleurGenre(jeux: $jeux);
  MainEditeur::$view->jeux = $vosJeux;
  MainEditeur::$view->Display('editeur/soumettreJeu');
}


public function soumettreJeu(): never {
  parent::checkConnected();
  $typeJeu = htmlspecialchars($_POST['typeJeu'], ENT_QUOTES, 'UTF-8');
  if (!empty($_POST['idJeuParent'])) {
    $idJeuParent = intval($_POST['idJeuParent']);
} else {
    $idJeuParent = null;
}  
  $nomJeu = htmlspecialchars($_POST['nomJeu'], ENT_QUOTES, 'UTF-8');
  $prix = htmlspecialchars($_POST['prix'], ENT_QUOTES, 'UTF-8');
  $resume = htmlspecialchars($_POST['resume'], ENT_QUOTES, 'UTF-8');
  $dateSortie = htmlspecialchars($_POST['dateSortie'], ENT_QUOTES, 'UTF-8');
  $idGenre = htmlspecialchars($_POST['idGenre'], ENT_QUOTES, 'UTF-8');
  $imageCard = $_FILES['imageCard'];
  $gif = $_FILES['gif'];
  $imageBanniere = $_FILES['imageBanniere'];
  $idGenre = $_POST['idGenre'];
  $idCategorie = $_POST['categories'];
  $controlleurs = $_POST['controlleurs'];
  $medias = $_FILES['medias'];
  $mediaFileNames = [];

  if (!empty($medias['name'][0])) {
    foreach ($medias['name'] as $key => $name) {
      if ($medias['error'][$key] === 0) {
        $mediaFileName = uniqid() . '_' . basename($name);
        $mediaPath = $link . $mediaFileName;
        move_uploaded_file($medias['tmp_name'][$key], $mediaPath);
        $mediaFileNames[] = $mediaFileName;
      }
    }
  }
  
  $link = "../public/img/";


  if ($imageCard['error'] === 0) {
    //$cardFileName = uniqid() . '_' . basename($imageCard['name']); // Nom unique pour éviter les conflits
    $cardPath = $link . basename($imageCard['name']);
    move_uploaded_file($imageCard['tmp_name'], $cardPath);
} 


  if ($gif['error'] === 0) {
    //$gifFileName = uniqid() . '_' . basename($gif['name']); // Nom unique pour éviter les conflits
    $gifPath = $link .basename($gif['name']) ;
    move_uploaded_file($gif['tmp_name'], $gifPath);
} 

if ($imageBanniere['error'] === 0) {
  $imagePath = $link . basename($imageBanniere['name']);
  move_uploaded_file($imageBanniere['tmp_name'], $imagePath);
}

  $jeu = new \Model\jeu();

  $jeu->soumettreJeu(
    $typeJeu,
    $idJeuParent,
    $nomJeu,
    $prix,
    $resume,
    $dateSortie,
    basename($gif['name']),
    basename($imageCard['name']),
    basename($imageBanniere['name']),
    $idGenre,
    $idCategorie,
    $controlleurs
  );

header('location: /jeuxenattente');
exit();
}


public function getjeu($vars=[]){
  parent::checkConnected();
  $id= intval($vars['id']);
  $jeu = new \Model\jeu();
  $jeu = $jeu->getjeuById($id);
  //parent::verifieEditeur($jeu['id_editeur']);


      if(isset($jeu) && !isset($jeu['id'])){
        $title= $jeu['nom_jeu'];
        $h1_title=$jeu['nom_jeu'];
      }
      else {
        $title='Aucun jeu trouvé';
        $h1_title='Aucun jeu trouvé';

    }
      MainEditeur::$view->title = $title;
      MainEditeur::$view->h1_title = $h1_title;
      MainEditeur::$view->jeu = $jeu;

      MainEditeur::$view->Display('editeur/jeu');
}



public function updateJeuView($vars=[]){
  parent::checkConnected();
  $id= intval($vars['id']);
  $jeu = new \Model\jeu();
  $jeu = $jeu->getjeuById($id);

      if(isset($jeu) && !isset($jeu['id'])){
        $title= $jeu['nom_jeu'];
        $h1_title=$jeu['nom_jeu'];
      }
      else {
        $title='Aucun jeu trouvé';
        $h1_title='Aucun jeu trouvé';
      }
      MainEditeur::$view->title = $title;
      MainEditeur::$view->h1_title = $h1_title;
      MainEditeur::$view->jeu = $jeu;

      MainEditeur::$view->Display('editeur/modifierJeu');
}

function updateJeu() {
  parent::checkConnected();

    $nomJeu = htmlspecialchars($_POST['nomJeu']);
    $prix = htmlspecialchars($_POST['prix']);
    $resume = htmlspecialchars($_POST['resume']);
    $dateSortie = htmlspecialchars($_POST['dateSortie']);
    $idJeu = htmlspecialchars($_POST['idJeu']);
    
    if (empty($nomJeu) || empty($prix) || empty($resume) || empty($dateSortie)) {
        die('Tous les champs sont obligatoires.');
    }

    $jeu = new \Model\jeu();
    $jeu->updateJeu($nomJeu,$prix,$resume,$dateSortie,$idJeu);

  header('Location: /jeuxenligne');
  exit();
}

}