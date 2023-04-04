<?php
require 'flight/Flight.php';
require 'jsonindent.php';

// $origin = 'http://localhost:8080';
// header("Access-Control-Allow-Origin: " . $origin);
Flight::register('db', 'Database', array('heliotrope'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci );
Flight::route('/', function(){
    echo 'hello world!';
});
// Flight::route('GET /parfemi/search/@q', function($q){
Flight::route('GET /parfemi/\?where=@where?&order=@order?', function($where,$order){
	header ("Content-Type: application/json; charset=utf-8");
    $where = rawurldecode(base64_decode($where));
	$db = Flight::db();
    try{
        // $q = explode("&", $q);
        $db->select(join_table1: "brand",join_table2: "image", where: $where,order: $order);
        $niz=array();
        while ($red=$db->result->fetch_object()){
            $niz[] = $red;
        }
        $odgovor['poruka']= $db->getLastQuery();
        $odgovor['niz'] = $niz;
        $odgovor['success'] = 'yes';
        $json_odgovor=json_encode($odgovor,JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    }catch (Exception $e) {
        //da li se ovo treba prikazati korisniku ili logavati negde,
        //logovati koristeci flightov logger?
        $odgovor['poruka']= $db->getLastQuery().'\nDošlo je do greške prilikom učitavanja parfema: ' . $e->getMessage();
        $json_odgovor=json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    }
});

Flight::route('POST /parfemi', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $poruka ='';
    if (!isset($_POST)) {
        $poruka.="Niste prosledili podatke\n"; 
        $odgovor['poruka']= $poruka;
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        // $targetFilePath = "uploads/".$_FILES["image"]["name"];
        $image = addslashes($_FILES['image']['tmp_name']);
        $image= file_get_contents($image);
        $image = base64_encode($image);
        $image_name = addslashes($_FILES['image']['name']);
        $_POST+= ["image" => $image]+["image_name" => $image_name];
        $podaci = (object)($_POST);
        if (
            !property_exists(
                $podaci,
                'name'
            ) || !property_exists(
                $podaci,
                'gender'
            ) || !property_exists(
                $podaci,
                'brand_id'
            )
            || !property_exists(
                $podaci,
                'tester'
            ) || !property_exists(
                $podaci,
                'price'
            )  || !property_exists(
                $podaci,
                'image'
            )
             || !property_exists(
                $podaci,
                'image_name'
            )
        ){
            $odgovor["poruka"] = "Niste prosledili korektne podatke ili su neka od polja ostala prazna";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;

        } else {
            try {
                $podaci_query = array();
                foreach ($podaci as $k => $v) {
                    $v = "'" . $v . "'";
                    $podaci_query[$k] = $v;
                }
                
                if ($db->insert(table: 'image', column_names: array('image', 'image_name'), column_values: array($podaci_query['image'], $podaci_query['name']))) {
                    $poruka.="\nSlika je sacuvana sa id-em:".$db->last_id;
                } else {
                    $poruka.="\nDoslo je do greske i slika nije sacuvana.\n";
                }
                $podaci_query["image_id"]=$db->last_id;
                if ($db->insert(table:"perfume",column_values: array($podaci_query["name"], $podaci_query["gender"], $podaci_query["brand_id"], $podaci_query["tester"],$podaci_query["price"],$podaci_query["image_id"]))) {
                    $odgovor["success"] = "yes";
                    $poruka.="\nParfem je sačuvan\n";
                    $db->commit();
                } else {
                    $poruka.= "\nDošlo je do greške pri ubacivanju parfema\n";
                    $db->rollback();
                }
                $odgovor["poruka"] = $poruka;
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;

            } catch (Exception $e) {
                $db->rollback();
                //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor u 
                $poruka.="\nUpit:".$db->getLastQuery();
                $poruka.="\nDošlo je do greške na serveru:\n".$e->getMessage();
                $odgovor["poruka"] = $poruka;
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } finally {
                if (!isset($odgovor["poruka"])) {
                    $odgovor["poruka"] = "Došlo je do nepredvidjene serverske greške pri ubacivanju parfema";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    echo $json_odgovor;
                    return false;
                }
            }
        }
    }
}
);
Flight::route('PUT /parfemi/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["poruka"] = "Niste prosledili podatke";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists(
                $podaci,
                'name'
            ) || !property_exists(
                $podaci,
                'gender'
            ) || !property_exists(
                $podaci,
                'brand_id'
            )
            || !property_exists(
                $podaci,
                'tester'
            ) || !property_exists(
                $podaci,
                'price'
            ) || !property_exists(
                $podaci,
                'image'
            )
        ) {
            $odgovor["poruka"] = "Niste prosledili korektne podatke ili su neka od polja ostala prazna";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;

        } else {
            try {
                $podaci_query = array();
                foreach ($podaci as $k => $v) {
                    $v = "'" . $v . "'";
                    $podaci_query[$k] = $v;
                }
                if ($db->update(table:"perfume",column_values: array($podaci_query["name"], $podaci_query["gender"], $podaci_query["brand_id"], $podaci_query["tester"],$podaci_query["price"],$podaci_query["image_id"]),
                where: "perfume.id=".$podaci_query["id"])) {
                    $odgovor["success"] = "yes";
                    $odgovor["poruka"] = "Perfem je uspešno ubačen";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    $db->commit();
                    echo $json_odgovor;
                    return false;
                } else {
                    $odgovor["poruka"] = "Došlo je do greške pri izmeni parfema";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    $db->rollback();
                    echo $json_odgovor;
                    return false;
                }
            } catch (Exception $e) {
                //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor u 
                $db->rollback();
                echo 'Message: ' . $e->getMessage();
            } finally {
                if (!isset($odgovor["poruka"])) {
                    $odgovor["poruka"] = "Došlo je do nepredvidjene serverske greške prilkikom izmene parfema";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    echo $json_odgovor;
                    return false;
                }
            }
        }
    }
}
);
Flight::route('PUT /novosti/@id', function($id){
	header ("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci_json = Flight::get("json_podaci");
	$podaci = json_decode ($podaci_json);
	if ($podaci == null){
	$odgovor["poruka"] = "Niste prosledili podatke";
	$json_odgovor = json_encode ($odgovor);
	echo $json_odgovor;
	} else {
	if (!property_exists($podaci,'naslov')||!property_exists($podaci,'tekst')||!property_exists($podaci,'kategorija_id')){
			$odgovor["poruka"] = "Niste prosledili korektne podatke";
			$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
	
	} else {
			$podaci_query = array();
			foreach ($podaci as $k=>$v){
				$v = "'".$v."'";
				$podaci_query[$k] = $v;
			}
			if ($db->update("novost", $id, array('naslov','tekst','kategorija_id'),array($podaci->naslov, $podaci->tekst,$podaci->kategorija_id))){
				$odgovor["poruka"] = "Novost je uspešno izmenjena";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			} else {
				$odgovor["poruka"] = "Došlo je do greške pri izmeni novosti";
				$json_odgovor = json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
	}
	}	




});


Flight::start();
?>