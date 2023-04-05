<?php
require 'flight/Flight.php';
require 'jsonindent.php';
if (!isset($_SESSION)) {
    session_start();
  }

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
        $arrPerfume=array();
        while ($row=$db->result->fetch_object()){
            $arrPerfume[] = $row;
        }
        $response['message']= $db->getLastQuery();
        $response['arrPerfume'] = $arrPerfume;
        $_SESSION['arrPerfume']= $arrPerfume;
        $response['success'] = 'yes';
        $json_response=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    }catch (Exception $e) {
        //da li se ovo treba prikazati korisniku ili logavati negde,
        //logovati koristeci flightov logger?
        $response['message']= $db->getLastQuery().'Došlo je do greške prilikom učitavanja parfema: ' . $e->getMessage();
        $json_response=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    }
});
// Flight::route('GET /parfemi/again',function(){
//     header ("Content-Type: application/json; charset=utf-8");
//     if(isset($_SESSION['arrPerfume'])){
//         $response['arrPerfume'] = $_SESSION['products'];
//         $response['success'] = 'yes';
//         $json_response=json_encode($response,JSON_UNESCAPED_UNICODE);
//         echo $json_response;
//     }
//     return false;
// });

Flight::route('POST /parfemi', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $message ='';
    if (!isset($_POST)) {
        $message.="Niste prosledili podatke\n"; 
        $response['message']= $message;
        $json_response = json_encode($response);
        echo $json_response;
        return false;
    } else {
        // $targetFilePath = "uploads/".$_FILES["image"]["name"];
        $image = addslashes($_FILES['image']['tmp_name']);
        $image= file_get_contents($image);
        $image = base64_encode($image);
        $image_name = addslashes($_FILES['image']['name']);
        $_POST+= ["image" => $image]+["image_name" => $image_name];
        $data = (object)($_POST);
        if (
            !property_exists(
                $data,
                'name'
            ) || !property_exists(
                $data,
                'gender'
            ) || !property_exists(
                $data,
                'brand_id'
            )
            || !property_exists(
                $data,
                'tester'
            ) || !property_exists(
                $data,
                'price'
            )  || !property_exists(
                $data,
                'image'
            )
             || !property_exists(
                $data,
                'image_name'
            )
        ){
            $response["message"] = "Niste prosledili korektne podatke ili su neka od polja ostala prazna";
            $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;

        } else {
            try {
                $podaci_query = array();
                foreach ($data as $k => $v) {
                    $v = "'" . $v . "'";
                    $data_query[$k] = $v;
                }
                
                if ($db->insert(table: 'image', column_names: array('image', 'image_name'), column_values: array($data_query['image'], $data_query['name']))) {
                    $message.="\nSlika je sacuvana sa id-em:".$db->last_id;
                } else {
                    $message.="\nDoslo je do greske i slika nije sacuvana.\n";
                }
                $data_query["image_id"]=$db->last_id;
                if ($db->insert(table:"perfume",column_values: array($data_query["name"], $data_query["gender"], $data_query["brand_id"], $data_query["tester"],$data_query["price"],$data_query["image_id"]))) {
                    $response["success"] = "yes";
                    $message.="\nParfem je sačuvan\n";
                    $db->commit();
                } else {
                    $message.= "\nDošlo je do greške pri ubacivanju parfema\n";
                    $db->rollback();
                }
                $response["message"] = $message;
                $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                echo $json_response;
                return false;

            } catch (Exception $e) {
                $db->rollback();
                //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor u 
                $message.="\nUpit:".$db->getLastQuery();
                $message.="\nDošlo je do greške na serveru:\n".$e->getMessage();
                $response["message"] = $message;
                $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                echo $json_response;
                return false;
            } finally {
                if (!isset($response["message"])) {
                    $response["message"] = "Došlo je do nepredvidjene serverske greške pri ubacivanju parfema";
                    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                    echo $json_response;
                    return false;
                }
            }
        }
    }
}
);
// Flight::route('PUT /parfemi/@id', function ($id) {
//     header("Content-Type: application/json; charset=utf-8");
//     $db = Flight::db();
//     $podaci_json = Flight::get("json_podaci");
//     $podaci = json_decode($podaci_json);
//     if ($podaci == null) {
//         $odgovor["poruka"] = "Niste prosledili podatke";
//         $json_odgovor = json_encode($odgovor);
//         echo $json_odgovor;
//         return false;
//     } else {
//         if (!property_exists(
//                 $podaci,
//                 'name'
//             ) || !property_exists(
//                 $podaci,
//                 'gender'
//             ) || !property_exists(
//                 $podaci,
//                 'brand_id'
//             )
//             || !property_exists(
//                 $podaci,
//                 'tester'
//             ) || !property_exists(
//                 $podaci,
//                 'price'
//             ) || !property_exists(
//                 $podaci,
//                 'image'
//             )
//         ) {
//             $odgovor["poruka"] = "Niste prosledili korektne podatke ili su neka od polja ostala prazna";
//             $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
//             echo $json_odgovor;
//             return false;

//         } else {
//             try {
//                 $podaci_query = array();
//                 foreach ($podaci as $k => $v) {
//                     $v = "'" . $v . "'";
//                     $podaci_query[$k] = $v;
//                 }
//                 if ($db->update(table:"perfume",column_values: array($podaci_query["name"], $podaci_query["gender"], $podaci_query["brand_id"], $podaci_query["tester"],$podaci_query["price"],$podaci_query["image_id"]),
//                 where: "perfume.id=".$podaci_query["id"])) {
//                     $odgovor["success"] = "yes";
//                     $odgovor["poruka"] = "Perfem je uspešno ubačen";
//                     $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
//                     $db->commit();
//                     echo $json_odgovor;
//                     return false;
//                 } else {
//                     $odgovor["poruka"] = "Došlo je do greške pri izmeni parfema";
//                     $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
//                     $db->rollback();
//                     echo $json_odgovor;
//                     return false;
//                 }
//             } catch (Exception $e) {
//                 //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor u 
//                 $db->rollback();
//                 echo 'Message: ' . $e->getMessage();
//             } finally {
//                 if (!isset($odgovor["poruka"])) {
//                     $odgovor["poruka"] = "Došlo je do nepredvidjene serverske greške prilkikom izmene parfema";
//                     $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
//                     echo $json_odgovor;
//                     return false;
//                 }
//             }
//         }
//     }
// }
// );


Flight::start();
?>