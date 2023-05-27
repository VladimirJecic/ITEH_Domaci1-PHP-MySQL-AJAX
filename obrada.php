<?php
include "api/Database.php";
function getBrendovi(){
    try{
    if(!isset($db)){
        $db = new Database('heliotrope');
    }
        $db->select(columns:"*", table:"brand");
        if (((object) $db)->result != null):
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
function countKorpa(): void{
    $sum = 0;
    foreach ($_SESSION['cart'] as $p) {
        $sum += $p->quantity;
    }
    echo ($sum);
}
// GET ?vidi_korpu(ucitava stranicu korpa.php)
if (isset($_GET['vidi_korpu'])) {
    include 'korpa.php';
    exit();
}
//POST Dodaj u Korpu(povecava kolicinu izabranog proizvoda za 1)
if (isset($_POST['submit']) && $_POST['submit'] == "Dodaj u korpu") {
    
    $found = -1;
    $L = count($_SESSION['arrPerfume']);
    for ($i = 0; $i < $L; $i++) {
        if ($_SESSION['arrPerfume'][$i]->id == $_POST['id']) {

            header("Location: ./store.php#product".($i+1));
            $L2 = count($_SESSION['cart']);
            for($j=0;$j<$L2;$j++ ){
                if ($_SESSION['cart'][$j]->id == $_POST['id'])
                $found=$j;
            }
            if($found==-1){
                $_SESSION['cart'][] = $_SESSION['arrPerfume'][$i];
                $_SESSION['arrPerfume'][$i]->quantity += 1;
            }else{
                $_SESSION['cart'][$found]->quantity += 1;
            }
            break;
        }
    }
    exit();
}
//POST Ukloni iz Korpe(smanjuje kolicinu izbaranog proizvoda za 1)
if(isset($_POST['submit']) && $_POST['submit'] == "Oduzmi iz Korpe"){
    $L = count($_SESSION['cart']);
    for ($i = 0; $i < $L; $i++) {
        if ($_SESSION['cart'][$i]->id == $_POST['id']) {
            $_SESSION['cart'][$i]->quantity -= 1;
            if( $_SESSION['cart'][$i]->quantity == 0){
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);//'reindex' array
            }
            break;
        }
    }
    header('Location: ./'. (isset($_POST['self']) ? $_POST['self'] :'store.php'));
    exit();
}
//POST Isprazni Korpu
if (isset($_POST['submit']) && $_POST['submit'] == 'Isprazni Korpu') {
    unset($_SESSION['cart']);
    header('Location: ?vidi_korpu');
    exit();
}
//POST Izbaci(izbacuje izabrani proizvod iz korpe)
if (isset($_POST['submit']) && $_POST['submit'] == 'Izbaci') {
    $L = count($_SESSION['cart']);
    for ($i = 0; $i < $L; $i++) {
        if ($_SESSION['cart'][$i]->id == $_POST['id']) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);//'reindex' array
                break;
            }
        }
    
    header('Location: ?vidi_korpu');
    exit();
}

?>