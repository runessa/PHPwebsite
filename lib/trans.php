<?php


function tr($txt){
    static $trans = false; //static -jätab väärtuse meelde, kui funtsioon juba ei tööta - lang faili loetakse ainult esimene kord
    // kui vaikimisi keel
    if(LANG_ID == DEFAULT_LANG){
        return $txt;
    }
    // kui ei ole - otsida vastav lang fail
    if($trans === false){
        $fn = LANG_DIR.'lang_'.LANG_ID.'.php';
        if(file_exists($fn) and is_file($fn) and is_readable($fn)){
            require_once ($fn);
            $trans = $_trans; // lang_en.php saadud massiv
        }else{
            $trans = [];
        }
    }
    if(isset($trans[$txt])){
        return $trans[$txt];
    }
    // juhul, kui mingit vastavust ei leia - tagastatakse algtekst
    return $txt;
}
?>
