<?php
namespace App\Http\Controllers;

use Log;
use DB;
use Illuminate\Http\Request;

class Common  {

    //build footer et header, definir le genre
    /*
    *   @method buildTableFrames
    *
    *   @param string $genre (thead/tfoot)
    *
    *   @param  array liste des champs disponibles dans le tableau à construire
    *
    *   @param  string type de fichier de traduction utilisé
    *
    *   @return une chaine contenant les thead ou tfoot d'un table html
    *
    */
    public static function buildTableFrames ($genre,$champs,$msg_file) {
        $view = "<$genre><tr>";
        foreach ( $champs as $clef => $value ) {
            $orderable = true;
            if (in_array($clef, ["actions"])) {
                $orderable = false;
            }
            $view .= '<th '.($orderable ? '' : 'data-orderable=false').'>'.ltrans("$msg_file.".$clef).'</th>';
        }
        $view .= "</tr></$genre>";
        return $view;
    }

    /**
     * [buildBouton description]
     * @param  [type] $url   [description]
     * @param  [type] $icon  [description]
     * @param  [type] $texte [description]
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public static function buildBouton($url,$icon,$texte,$class) {
            return '
                  <a class="btn '.$class.'" href="'.$url.'" title="'.$texte.'">
                    <i class="'.$icon.'"></i> '.'' .'
                  </a>
            ';
    }

}
