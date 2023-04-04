<?php
include "api/Database.php";
$db;
function getBrendovi(){
    try{
    if(!isset($db)){
        $db = new Database('heliotrope');
    }
        $db->select(table:"brand");
        if (((object) $db)->result != null):
            echo "<option value='0'>--Svi--</option>";
            while ($red = $db->result->fetch_object()):
                echo "<option value='{$red->id}'>{$red->brand_name}</option>";
            endwhile;
        endif; 
    }catch(Exception $e) {
    $odgovor['poruka']= $db->getLastQuery().'\nDošlo je do greške prilikom učitavanja parfema: ' . $e->getMessage();
    $json_odgovor=json_encode ($odgovor,JSON_UNESCAPED_UNICODE);
    echo $json_odgovor;
    }
}
?>