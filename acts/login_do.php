<?php

// võtame kätte vormi poolt edastatud andmed
$username = $http->get('kasutaja');
$passwd = $http->get('parool');
//koostame päringu kasutaja kontrollimiseks andmebaasis
$sql = 'SELECT * from user'.
    ' where username='.fixDb($username).
    ' AND password='.fixDb(md5($passwd));
$res = $db->getArray($sql);
// Teeme päringu tulemuse kontrolli
if($res == false){
    // loome veateade ja paneme see sessiooni
    $sess->set('error', 'Probleem sisselogimisega');
    // siis tuleb kasutaja suunata tagasi sisselogimisvormi
    $link = $http->getLink(array('act' => 'login'));
    $http->redirect($link);
}else{
    //Siis tuleb avada kasutaja sessioon
    $sess->createSession($res[0]);
    // Tuleb suunata kasutajad pealehele
    //Kui ma väljastan kasutajaandmed sessiooni kontrolliks
    $http->redirect();
}
