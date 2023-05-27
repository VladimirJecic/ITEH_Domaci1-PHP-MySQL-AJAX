<?php
require 'flight/Flight.php';
require 'jsonindent.php';
if (!isset($_SESSION)) {
    session_start();
}

Flight::register('db', 'Database', array('heliotrope'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);
Flight::route('/', function () {
    echo 'hello world!';
});

// Flight::route('GET /parfemi/search/@q', function($q){
Flight::route('GET /parfemi/\?where=@where?&order=@order?', function ($where, $order) {
    header("Content-Type: application/json; charset=utf-8");
    $where = rawurldecode(base64_decode($where));
    $db = Flight::db();
    try {
        // $q = explode("&", $q);
        $db->select(join_table1: "brand", join_table2: "image", where: $where, order: $order);
        $arrPerfume = array();
        while ($row = $db->result->fetch_object()) {
            $arrPerfume[] = $row;
        }
        $response['message'] = $db->getLastQuery();
        $response['arrPerfume'] = $arrPerfume;
        $_SESSION['arrPerfume'] = $arrPerfume;
        $response['success'] = 'yes';
        $response['query'] = "\nUpit:" . $db->getLastQuery();
        $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    } catch (Exception $e) {
        //da li se ovo treba prikazati korisniku ili logavati negde,
        //logovati koristeci flightov logger?
        $response['message'] = $db->getLastQuery() . 'Došlo je do greške prilikom učitavanja parfema: ' . $e->getMessage();
        $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    }
});
Flight::route('GET /parfemi/session', function () {
    header("Content-Type: application/json; charset=utf-8");
    if(isset($_SESSION['arrPerfume'])){
        $response['arrPerfume'] =$_SESSION['arrPerfume'];
        $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    }
});

Flight::route('POST /parfemi',function () {
        header("Content-Type: application/json; charset=utf-8");
        $db = Flight::db();
        $message = '';
        if (!isset($_POST)) {
            $message .= "Niste prosledili podatke\n";
            $response['message'] = $message;
            $json_response = json_encode($response);
            echo $json_response;
            return false;
        } else {
            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);
            $image_name = addslashes($_FILES['image']['name']);
            $_POST += ["image" => $image] + ["image_name" => $image_name];
            $data = (object) ($_POST);
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
                ) || !property_exists(
                    $data,
                    'image'
                )
                || !property_exists(
                    $data,
                    'image_name'
                )
            ) {
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

                    if ($db->insert(table: 'image', column_names: array('image', 'image_name'), column_values: array($data_query['image'], $data_query['image_name']))) {
                        $message .= "\nSlika je sacuvana sa id-em:" . $db->last_id;
                    } else {
                        $message .= "\nDoslo je do greske i slika nije sacuvana.\n";
                    }
                    $data_query["image_id"] = $db->last_id;
                    if ($db->insert(table: "perfume", column_values: array($data_query["name"], $data_query["gender"], $data_query["brand_id"], $data_query["tester"], $data_query["price"], $data_query["image_id"]))) {
                        $response["success"] = "yes";
                        $message .= "\nParfem je sačuvan\n";
                        //izmena u $_SESSION varijabli
                        $_SESSION['arrPerfume'][] =  (object)array("id"=> $db->last_id, "name"=>  $data->name, "gender"=>  $data->gender, "tester"=> $data->tester, "quantity"=>  0, "price"=> $data->price, "brand_id"=> $data->brand_id , "brand_name"=> $data->brand_name, "image_name"=> $data->image_name,"image"=> $data->image);
                        $db->commit();
                    } else {
                        $message .= "\nDošlo je do greške pri ubacivanju parfema\n";
                        $db->rollback();
                    }
                    $response["message"] = $message;
                    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                    echo $json_response;
                    return false;

                } catch (Exception $e) {
                    $db->rollback();
                    //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor  
                    $message .= "\nUpit:" . $db->getLastQuery();
                    $message .= "\nDošlo je do greške na serveru:\n" . $e->getMessage();
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

Flight::route('PUT /parfemi/update-korpa-quantity', function () {
    header("Content-Type: application/json; charset=utf-8");
    $data_json = Flight::get("json_podaci");
    try {
        $data = json_decode($data_json);
        if ($data == null) {
            $response["message"] = "Niste prosledili podatke";
            $json_response = json_encode($response);
            echo $json_response;
        } else {
            if (!property_exists($data, 'id') || !property_exists($data, 'quantity')) {
                $response["message"] = "Niste prosledili neko od polja ili je neko polje prazno";
                $json_response = json_encode($response);
                echo $json_response;
            }else{
                $L = count($_SESSION['cart']);
                for($i = 0;$i<$L;$i++){
                    if($_SESSION['cart'][$i]->id == $data->id){
                        $_SESSION['cart'][$i]->quantity = $data->quantity;
                        break;
                    }
                }
                $response["message"] = "Broj selektovanog proizvoda je azuriran na ".$data->quantity;
                $json_response = json_encode($response);
                echo $json_response;
            }
        }
    } catch (Exception $e) {
        
        $message = "Došlo je do greške na serveru:\n" . $e->getMessage();
        $response["message"] = $message;
        $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
        echo $json_response;
        return false;
    }
});

Flight::route('PUT /parfemi/@id', function ($id) {
        // header("Content-Type: application/json; charset=utf-8");
        
        $db = Flight::db();
        $message = '';
        $data_json = Flight::get("json_podaci");
        $data= json_decode($data_json);
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            $message .= "Niste prosledili podatke\n";
            $response['message'] = $message;
            $json_response = json_encode($response);
            echo $json_response;
            return false;
        } else {
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
                ) || !property_exists(
                    $data,
                    'image'
                )
                || !property_exists(
                    $data,
                    'image_name'
                )
            ) {
                $response["message"] = "Niste prosledili korektne podatke ili su neka od polja ostala prazna";
                $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                echo $json_response;
                return false;

            } else {
                try {
                    $data_query = array();
                    foreach ($data as $k => $v) {
                        $v = "'" . $v . "'";
                        $data_query[$k] = $v;
                    }
                    //sta raditi sa prethodnom slikom? -proveriti sa upitom da li je jos neko koristi i obrisati je ili je uvek obrisati...nista od toga nije uradjeno
                    if ($db->insert(table: 'image', column_names: array('image', 'image_name'), column_values: array($data_query['image'], $data_query['name']))) {
                        $message .= "\nSlika je sacuvana sa id-em:" . $db->last_id;
                    } else {
                        $message .= "\nDoslo je do greske i slika nije sacuvana.\n";
                    }
                    $data_query["image_id"] = $db->last_id;
                    if ($db->update(table: "perfume", column_values: array($data_query["name"], $data_query["gender"], $data_query["brand_id"], $data_query["tester"], $data_query["price"], $data_query["image_id"]),where: "id=$id")) {
                        $response["success"] = "yes";
                        $message .= "\nParfem je ažuriran\n";
                        //izmena u $_SESSION varijabli
                        $L = count($_SESSION['arrPerfume']);
                        for($i=0;$i<$L;$i++){
                            if($_SESSION['arrPerfume'][$i]->id == $id){
                                $_SESSION['arrPerfume'][$i] = (object)array("id"=> strval($id), "name"=>  $data->name, "gender"=>  $data->gender, "tester"=> $data->tester, "quantity"=> "0", "price"=> $data->price, "brand_id"=> $data->brand_id , "brand_name"=> $data->brand_name, "image_name"=> $data->image_name,"image"=> $data->image);
                                break;
                            }
                        }
                        $db->commit();
                        header("*Status: 204 No Content");
                    } else {
                        $message .= "\nDošlo je do greške pri ažuriranju parfema\n";
                        $message .= "\nUpit:" . $db->getLastQuery();
                        $db->rollback();
                    }
                    $response["message"] = $message;
                    $response["query"] = "\nUpit:" . $db->getLastQuery();
                    
                    // $json_response = json_encode($response, JSON_UNESCAPED_UNICODE); //jer PUT ne treba nista da vrati ako je uspeo?!
                    // echo $json_response;
                     return false;

                } catch (Exception $e) {
                    $db->rollback();
                    //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor  
                    $message .= "\nUpit:" . $db->getLastQuery();
                    $message .= "\nDošlo je do greške na serveru:\n" . $e->getMessage();
                    $response["message"] = $message;
                    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                    echo $json_response;
                    return false;
                } finally {
                    if (!isset($response["message"])) {
                        $response["message"] = "Došlo je do nepredvidjene serverske greške pri izmeni parfema";
                        $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                        echo $json_response;
                        return false;
                    }
                }
            }
        }
    }
);
Flight::route('DELETE /parfemi/@id', function ($id) {
        header("Content-Type: application/json; charset=utf-8");
        $db = Flight::db();
        $message = '';
        try {
            if ($db->delete(table: 'perfume', where: "id= $id")) {
                $response["success"] = "yes";
                $message .= "\nParfem je obrisan\n";
                //izmena u $_SESSION varijabli
                $L = count($_SESSION['arrPerfume']);
                for($i=0;$i<$L;$i++){
                    if($_SESSION['arrPerfume'][$i]->id == $id){
                        unset($_SESSION['arrPerfume'][$i]);
                        $_SESSION['arrPerfume'] = array_values($_SESSION['arrPerfume']);//'reindex' array
                        break;
                    }
                }
                $db->commit();
            } else {
                $message .= "\nDošlo je do greške pri brisanju parfema\n";
                $message .= "\nUpit:" . $db->getLastQuery();
                $db->rollback();
            }
            $response["message"] = $message;
            $response["query"] = "\nUpit:" . $db->getLastQuery();
            $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;
        } catch (Exception $e) {
            $db->rollback();
            //ovde je moguce proveriti uzrok i kasnije vratiti user-friendly odgovor  
            $message .= "\nUpit:" . $db->getLastQuery();
            $message .= "\nDošlo je do greške na serveru:\n" . $e->getMessage();
            $response["message"] = $message;
            $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
            echo $json_response;
            return false;
        } finally {
            if (!isset($response["message"])) {
                $response["message"] = "Došlo je do nepredvidjene serverske greške pri izmeni parfema";
                $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
                echo $json_response;
                return false;
            }
        }
    
    }
);
Flight::start();
?>