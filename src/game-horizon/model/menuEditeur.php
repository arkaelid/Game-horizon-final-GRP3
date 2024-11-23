<?php 

namespace Model;

class MenuEditeur {

function getMenu(){
    $json=file_get_contents('../menu/menuEditeur.json');
    $json=json_decode($json,true);
    return $json;
}


function setMenu($menu){
    $json = json_encode($menu);
    file_put_contents("../menu/menuEditeur.json",$json);
    return true;

}
}