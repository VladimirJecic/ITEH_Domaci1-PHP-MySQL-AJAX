<?php
include "Database.php";
$mydb = new Database('heliotrope');
if (isset($_POST['parfem-post']))
{
    //operacija ce se sastojati iz 2 inserta,prvo se pamti slika
    //zatim sa id-em slike, koji cu nekako dobiti nazad od baze
    //pravim drugi insert gde cu ubaciti ostale podatke o parfemu
    //i zapamtiti ga
    if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
        echo "Please select an image.";
    }
    else{
        $image = addslashes($_FILES['image']['tmp_name']);
        $name = addslashes($_FILES['image']['name']);
        $image= file_get_contents($image);
        $image = base64_encode($_image);
        // $q="INSERT INTO IMAGES(image,name) values ('$image','$image')";
        if($mydb->insert(table:'perfume_image',column_names:array('image','name'),column_values:array("'".$image."'","'".$name."'"))){
            echo "<br/>Image uploaded.";
        } else{
            echo "<br/>Image uploaded.";
        }
       echo "<br/>New record inserted succcessfully with id=".$mydb->last_id;
    }
}

//da li je uopste poslat zahtev
// if (isset($_POST['posalji'])) {
//     unset($_SESSION['message']);
//     if ($_POST['odabir_tabele'] != null && $_POST['http_zahtev'] != null) {

//         switch ($_POST['http_zahtev']) {
//             case 'get':
//                 if ($_POST['odabir_tabele'] == 'novosti') {
//                     $mydb->select();
//                     if (isset($mydb->result) && $mydb->records > 0) {
//                         $_SESSION['get_odgovor'] = $mydb->result->fetch_all();
//                     }
//                 } else if ($_POST['odabir_tabele'] == 'kategorija') {
//                     $mydb->select(table: "kategorija", join_table: "novost", join_key1: "id", join_key2: "id");
//                     if (isset($mydb->result) && $mydb->records > 0) {
//                         $_SESSION['get_odgovor'] = $mydb->result->fetch_all();
//                     }

//                 }
//                 if(!isset($_SESSION['get_odgovor'])){;$_SESSION['message']='doslo je do problema prilikom obrade GET zahteva';}
//                 //ova linija je bitna da se ne bi sa svaki refreshom ponovo desao select bez potrebe
//                 header('Location: ./index.php');
//                 unset($_POST);
//                 exit();
//             case 'post':
//                 $m = "novost/kategorija nije ubacena";
//                 if ($_POST['naslov_novosti'] != null && $_POST['tekst_novosti'] != null && $_POST['kategorija_odabir'] != null) {
//                     $m= $mydb->insert(column_values: array("'" . $_POST['naslov_novosti'] . "'", "'" . $_POST['tekst_novosti'] . "'", "NOW()", $_POST['kategorija_odabir'])) ? "novost ubacena" : "novost nije ubacena";
//                 } else if ($_POST['kategorija_naziv'] != null) {
//                     $m= $mydb->insert(table: 'kategorija', column_names: array('kategorija'), column_values: array("'" . $_POST['kategorija_naziv'] . "'")) ? "kategorija ubacena" : "kategorija nije ubacena";

//                 }
//                 $_SESSION['message']= $m;
//                 //ova linija je bitna da se ne bi sa svaki refreshom ponovo desao post/put/delete
//                 header('Location: ./index.php');
//                 unset($_POST);
//                 exit();
//             case 'put':
//                 $m='novost/kategorija nije azurirana';
//                 if($_POST['naslov_novosti_put'] !=null && $_POST['tekst_novosti_put']!=null && $_POST['kategorija_odabir_put']!=null && $_POST['id_novosti']!=null){
//                     $m=($mydb->update(column_values: array("'".$_POST['naslov_novosti_put']."'","'".$_POST['tekst_novosti_put']."'","NOW()",$_POST['kategorija_odabir_put']),where:'novost.id='.$_POST['id_novosti'])? 'novost azurirana': 'novost nije azurirana');
//                 }else if($_POST['id_kategorije']!=null && $_POST['kategorija_naziv_put']!=null ){
//                     $m=($mydb->update(table:"kategorija",column_names: array('kategorija'),column_values: array("'".$_POST['kategorija_naziv_put']."'"),where:'kategorija.id='.$_POST['id_kategorije'])? 'kategorija azurirana': 'kategorija nije azurirana');
//                 }
//                 $_SESSION['message']= $m;
//                 //ova linija je bitna da se ne bi sa svaki refreshom ponovo desao post/put/delete
//                 header('Location: ./index.php');
//                 unset($_POST);
//                 exit();
//             case 'delete':
//                 $m='brisanje novosti/kategorije neuspesno';
//                 if($_POST['brisanje']!=null && is_numeric($_POST['brisanje'])){
//                     if($_POST['odabir_tabele']=='novosti'){
//                         $m=($mydb->delete(where:'novost.id ='.($_POST['brisanje']))?'brisanje novosti uspesno':'brisanje novosti neuspesno');
//                     }else if($_POST['odabir_tabele']=='kategorija'){
//                         $m=($mydb->delete("kategorija",where:'kategorija.id ='.($_POST['brisanje']))?'brisanje kategorije uspesno':'brisanje kategorije neuspesno');
//                     }
//                 }
//                 $_SESSION['message']= $m;
//                 //ova linija je bitna da se ne bi sa svaki refreshom ponovo desao post/put/delete
//                 header('Location: ./index.php');
//                 unset($_POST);
//                 exit();
//             default:
//                 $m='nedozvoljena vrednost http_zahteva:' + $_POST['http_zahtev'];
//                 $_SESSION['message']= $m;
//                 unset($_POST);
//                 exit();
//         }


//     } else {
//         $m='nije selektovan neki od radio buttona';
//         $_SESSION['message']= $m;
//         exit();
//     }
// }

?>