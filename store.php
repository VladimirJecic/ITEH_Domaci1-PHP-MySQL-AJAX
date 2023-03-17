<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Heliotrope Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-control" content="public">
  <link rel="stylesheet" href="bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <script src="jquery/jquery.min.js">
    <script src="bootstrap/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }

    /* Remove the jumbotron's default bottom margin */
    .jumbotron {
      margin-bottom: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

    /* Note: Try to remove the following lines to see the effect of CSS positioning */
    .affix {
      top: 0;
      width: 100%;
      z-index: 1;
    }

    .affix+.container-fluid {
      padding-top: 70px;
    }
  </style>
  
  </head>
<?php
if (!isset($_SESSION)) {
    session_start();
}
ini_set('mysql.connect_timeout',300);
ini_set('default.connect_timeout',300);
include 'obrada.php';
?>
<body>

  <div id="header" class="container-fluid" style="background-color: #df73ff">

    <!-- <div class="container text-center">
    <h1>Online Store</h1>      
    <p>Mission, Vission & Values</p>
  </div> -->
    <div class="row">
      <div class="col-sm-1" style="align-items: center; justify-content: flex-end; padding-right: 0px;">
        <span class="glyphicon glyphicon-envelope">
      </div>
      <div class="col-sm-3" style="background-color:lavender;">
        <text-center>prodaja@heliotrope.rs</text-center>
      </div>

      <div class="col-sm-1"> <span class="glyphicon glyphicon-earphone"></div>
      <div class="col-sm-3">
        <text-center> +381 64 583 7198</text-center>
      </div>

      <div class="col-sm-2" style="background-color:lavender;"></div>
      <div class="col-sm-2 social" style="background-color:lavender;">
        <svg xmlns="svg/" height="4vh" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
          <path
            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="4vh" fill="currentColor" class="bi bi-facebook"
          viewBox="0 0 16 16">
          <path
            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
        </svg>
      </div>

    </div>

  </div>

  </div>
  <div class="row" style="background-color: #e6a3fa">
    <div class="col-sm-2"><img id="logo-small" class="img-responsive" src="img/logo1.png" alt="logo.png"></div>
    <div id="input" class="col-sm-5">
      <input type="text" name="search-input" id="search-input" placeholder="Pretraga po imenu">
      <!-- NE-zaboraviti labele,NIKADA,inace input poblesavi i duzina skroz poremeti layout -->
      <div>
        <input type="radio" name="gender1" id="male1" value="male">
        <label for="male1">Muški</label>
        <input type="radio" name="gender1" id="female1" value="female">
        <label for="female1">Ženski</label>
      </div>
      <container id="brend_sort_odabir">
        <abbr>Brend:</abbr>
        <select name="brend_odabir" title="brend_odabir" id="brend_odabir1">
          <option value="1">B1</option>
          <option value="2">B2</option>
          <option value="3">B3</option>
          <option value="4">B4</option>
        </select>
        <select name="sort_odabir" title="brend_odabir" id="sort_odabir">
          <option value="1">Cene->rastuće</option>
          <option value="2">Cene->opadajuće</option>
          <option value="3">Imena->rastuća(A-Z)</option>
          <option value="4">Imena->opadajuća(Z-A)</option>
        </select>
      </container>
      <div id="tester">
        <abbr>Tester:</abbr>
        <input type="radio" name="tester" id="yes1" value="yes">
        <label for="yes1">Da</label>
        <input type="radio" name="tester" id="no1" value="no">
        <label for="no1">Ne</label>
      </div>
      <container id="quantity">
        <abbr>Količina:</abbr>
        <select name="quantity_odabir" title="quantity_odabir" id="quantity_odabir">
          <?php
          $quantities = range(1, 10);
          foreach ($quantities as $q): ?>
            <option value="<?php echo $q ?>"> <?php echo $q ?> </option>
          <?php endforeach; ?>
        </select>
      </container>



    </div>
    <div id="submit" class="col-sm-1"><button type="submit" title="search-submit"><span
          class="glyphicon glyphicon-search"></button></div>
    <div id="benefits" class="col-sm-4">
      <row> <span class="glyphicon glyphicon-shopping-ok"></span>
        <h3>h3 heading <small>secondary text</small></h3>
      </row>
      <row> <span class="glyphicon glyphicon-shopping-ok"></span>
        <h3>h3 heading <small>secondary text</small></h3>
      </row>
      <row> <span class="glyphicon glyphicon-shopping-ok"></span>
        <h3>h3 heading <small>secondary text</small></h3>
      </row>
    </div>
  </div>

  <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="298.65">
    <div class="container-fluid">
      <div class="navbar-header" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Unos Novog Parfema</a></li>
          <li><a href="#">Izmena Parfema</a></li>
          <li><a href="#">Brisanje Parfema</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <div class="dropdown" style="display:flex; align-items: center;">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span style="font-size: 25px;" class="glyphicon glyphicon-shopping-cart">
                  <span class="badge">0</span>
                  <span class="caret"></span></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdown-menu">
                <li><a href="#">HTML</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="#">JavaScript</a></li>
                <li class="divider"></li>
                <li><a href="#">About Us</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" id="perfume-post">
    <!-- ovde napraviti skeleton, zatim u js dodati akciju na klik na dugme -->
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-5">
        <div class="row">
          <div class="panel panel-primary" style="height:35%">
            <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" style="height:160px; width:300px;"
                class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer"><input type="file" class="btn btn-info" value="Izaberi Sliku"
                style="width:100%"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="row">
          <div class="col-sm-2">
            <label for="perfume-name">Name:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" name="perfume-name" id="perfume-name" placeholder="Ime Parfema...">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <abbr>Pol:</abbr>
          </div>
          <div class="col-sm-6">
            <label for="male2">Muški</label>
            <input type="radio" name="gender2" id="male2" value="male">
              &nbsp &nbsp      
            <label for="female2">Ženski</label>
            <input type="radio" name="gender2" id="female2" value="female">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2"><abbr>Brend:</abbr></div>
          <div class="col-sm-6">
            <select name="brend_odabir" title="brend_odabir" id="brend_odabir2">
              <option value="1">B1</option>
              <option value="2">B2</option>
              <option value="3">B3</option>
              <option value="4">B4</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2"><abbr>Tester:</abbr></div>
          <div class="col-sm-6">
            <input type="radio" title="tester" name="tester" id="yes2" value="yes">
            <label for="ye2s">Da</label>
            &nbsp &nbsp  
            <input type="radio" title="tester" name="tester" id="no2" value="no">
            <label for="no2">Ne</label>
          </div>
        </div>
        <div class="row">
        <div class="col-sm-2"> 
        <label for="price">Cena:</label></div>
        <div class="col-sm-6"> 
        <input type="text" name="price" id="price" placeholder="U evrima..."> 
        </div>
      </div>
        <div class="row" id="parfem-submit">
          <input type="submit" id="parfem-submit"class="btn btn-info" value="Sačuvaj parfem">
        </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
  <br>
  <br>
  </div>





  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
    </div>
  </div><br><br>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
    </div>
  </div><br><br>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">BLACK FRIDAY DEAL</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"
              style="width:100%" alt="Image"></div>
          <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
        </div>
      </div>
    </div>
  </div><br><br>

  <footer class="container-fluid text-center">
    <p>Online Store Copyright</p>
    <form class="form-inline">Get deals:
      <input type="email" class="form-control" size="50" placeholder="Email Address">
      <button type="button" class="btn btn-danger">Sign Up</button>
    </form>
  </footer>

</body>

</html>
<!-- <script type="text/plain">

  // kreiramo niz blokova, odnosno niz svih id vrednosti div sekcija
  var nizBlokova = ["home", "perfume_post", "perfume_put", "perfume_delete", "kategorije_put", "error"];

  //na samom početku želimo da sakrijemo sve blokove, dok korisnik ne odabere tip tabele i HTTP zahteva
  function skloniBlokove() {
    //prolazimo kroz niz blokova

    for (const blok of nizBlokova) {
      //i vrednost display atributa u okviru css-a postavljamo na none, kako se ne bi prikazivali
      document.getElementById(blok).style.display = "none";
    }
    //osim ako ne postoji neki tekst u get_odgovor
    if (document.getElementById("get_odgovor").innerHTML != "" && $("input[name=odabir_tabele]:checked").length == 0) {
      document.getElementById('get_odgovor').style.display = "block";
    }
    if (document.getElementById("server_message").innerHTML != "") {
      alert(document.getElementById("server_message").innerHTML);
      document.getElementById("server_message").innerHTML = "";
    };

  }
  //pozivamo funkciju da se izvrši
  skloniBlokove();


  //definišemo event handler-e za svaki klik na formi
  //gde klikom na neki radio button za HTTP zahtev i određenu tabelu, želimo da se prikaže DIV element za tu kombinaciju
  //kombinacija je definisana u okviru prikaziBlok funkcije
  $("input[name=http_zahtev]").on("click", prikaziBlok);
  $("input[name=odabir_tabele]").on("click", resetHTTP);
  //$("button").on("click", posaljiZahtev);

  //prikaziBlok funkcija koristeći switch prolazi kroz sve tipove zahteva koji mogu biti odabrani
  //$("input[name=http_zahtev]:checked")[0].id je jQuery funkcija koja nam omogućava da 
  // dođemo do svih čekiranih input polja čiji je name http_zahtev 
  // i da pristupimo njegovom id-u jer su kao id postavljene vrednosti get post put delete 
  function prikaziBlok() {
    switch ($("input[name=http_zahtev]:checked")[0].id) {
      case "get":
        // u slučaju da odaberemo get, sakrićemo sve prethodno prikazane div-ove
        skloniBlokove();
        //obrisaćemo unutrašnji HTML get_odgovor bloka 
        document.getElementById("get_odgovor").innerHTML = "";
        // i prikazati ga da bude vidljiv, promenom atributa display sa none na block
        document.getElementById(nizBlokova[0]).style.display = "block";
        break;
      case "post":
        // u slučaju da odaberemo post, sakrićemo sve prethodno prikazane div-ove
        skloniBlokove();
        //proverićemo da li je odabrana tabela novosti ili kategorije
        if ($("input[name=odabir_tabele]:checked").length == 0) {
          //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
          document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
          document.getElementById(nizBlokova[6]).style.display = "block";
        } else {
          //ako jeste odabrana tabela, odnosno length nije 0
          //uzećemo koja je to tabela, odnosno id tog radio button-a
          var tabela = $("input[name=odabir_tabele]:checked")[0].id;
          if (tabela == "radio_kategorija") {
            //i u slučaju da je u pitanju tabela kategorije
            //prikazaćemo post formu za kategorije
            document.getElementById(nizBlokova[2]).style.display = "block";
          } else if (tabela == "radio_novosti") {
            //u suprotnom prikazaćemo post formu za novosti
            document.getElementById(nizBlokova[1]).style.display = "block";
          }
        }

        break;
      case "put":
        // u slučaju da odaberemo put, sakrićemo sve prethodno prikazane div-ove
        skloniBlokove();
        //proverićemo da li je odabrana tabela novosti ili kategorije
        if ($("input[name=odabir_tabele]:checked").length == 0) {
          //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
          document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
          document.getElementById(nizBlokova[6]).style.display = "block";
        } else {
          //ako jeste odabrana tabela, odnosno length nije 0
          //uzećemo koja je to tabela, odnosno id tog radio button-a
          var tabela = $("input[name=odabir_tabele]:checked")[0].id;
          if (tabela == "radio_kategorija") {
            //i u slučaju da je u pitanju tabela kategorije
            //prikazaćemo put formu za kategorije
            document.getElementById(nizBlokova[4]).style.display = "block";
          } else if (tabela == "radio_novosti") {
            //u suprotnom prikazaćemo put formu za novosti
            document.getElementById(nizBlokova[5]).style.display = "block";
          }
        }
        break;
      case "delete":
        //poslednja opcija nam je prikaz bloka za brisanje elemenata iz određene tabele
        skloniBlokove();
        //proverićemo da li je odabrana tabela novosti ili kategorije
        if ($("input[name=odabir_tabele]:checked").length == 0) {
          //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
          document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
          document.getElementById(nizBlokova[6]).style.display = "block";
        } else {
          //ako jeste odabrana tabela, odnosno length nije 0
          //prikazaćemo put formu za kategorije
          var tabela = $("input[name=odabir_tabele]:checked")[0].id;
          document.getElementById(nizBlokova[3]).style.display = "block";
        }
        break;
      default:
        break;
    }
  }
  //funkcija resetHTTP nam samo resetuje odabrane HTTP zahteve nakon promene odabrane tabele  
  function resetHTTP() {
    skloniBlokove();
    $("input[name=http_zahtev]").prop('checked', false);

  }


  //funkcija posaljiZahtev obrađuje pomoću AJAX-a zahteve koje šaljemo ka serveru
  function posaljiZahtev() {
    //na samom početku nam je bitno da su selektovani i zahtev i tabela
    if ($("input[name=odabir_tabele]:checked").length != 0 && $("input[name=http_zahtev]:checked").length != 0) {
      //ako jesu nastavljamo sa obradom zahteva
      //pamtimo koja je tabela u pitanju
      var tabela = $("input[name=odabir_tabele]:checked")[0].id;

      //i ponovo kroz switch prolazimo i obrađujemo svaki zahtev
      switch ($("input[name=http_zahtev]:checked")[0].id) {
        case "get":
          //kada je get u pitanju
          //proveravamo koja je tabela
          if (tabela == "radio_novosti") {
            //i nakon toga pozivamo getJSON funkciju kojoj prosleđujemo link endpoint-a našeg API-a
            //više od funkciji getJSON https://api.jquery.com/jquery.getjson/

            //getJSON funkcija ima 2 bitna parametra, a to su url koji prosleđujemo i success funkcija koja kojom obrađujemo podatke koje smo dobili
            //data parametar u okviru funkcije, predstavlja podatke poslate sa servera u JSON formatu
            $.getJSON("http://localhost:8080/rest/api/novosti", function (data) {
              //postavljamo unutrašnji HTML div bloka get_odgovor na pretty string reprezentaciju JSON objekta
              //string reprezentacija je mogla i da se postavi samo sa JSON.stringify(data)
              // ali postavljamo i parametre null i 2 kako bi prikaz JSONa bio čitljiv
              document.getElementById("get_odgovor").innerHTML = JSON.stringify(data, null, 2);
            });
          } else {
            //ponavljamo istu proceduru samo za tabelu kategorije
            $.getJSON("http://localhost:8080/rest/api/kategorije", function (data) {
              document.getElementById("get_odgovor").innerHTML = JSON.stringify(data, null, 2);
            });
          }
          break;
        case "post":
          if (tabela == "radio_novosti") {
            // kada je post zahtev u pitanju, potrebno je da 
            // prikupimo podatke koje hoćemo da pošaljemo iz forme
            var values = {
              "naslov": $("input[name=naslov_novosti]").val(),
              "tekst": $("#tekst_novosti").val(),
              "kategorija_id": parseInt($("#kategorija_odabir").val())
            };
            //ispisaćemo te podatke u konzoli kako bismo bili siguri da dobijamo dobar izlaz
            //konzoli pristupamo u brauzeru sa CTRL+Shift+i i biramo tab Console
            console.log(values);
            //post zahtev se obrađuje na sličan način kao get
            //potrebna su nam dva parametra u funkciji post
            //url na koji šaljemo podatke
            //koje podatke šaljemo
            //i success funkcija u okviru koje prikazujemo odgovor sa servera
            $.post("http://localhost:8080/rest/api/novosti", JSON.stringify(values), function (data) {
              alert("Odgovor od servera> " + data['poruka']);
            });
          } else {
            //na isti način radimo sa kategorijama, s tim što je potrebno da pokupimo njene vrednosti iz forme
            var values = {
              "kategorija": $("input[name=kategorija_naziv]").val(),
            }
            console.log(values);
            $.post("http://localhost:8080/rest/api/kategorije", JSON.stringify(values), function (data) {
              alert("Odgovor od servera> " + data['poruka']);
            });

          }
          break;
        case "put":
          if (tabela == "radio_novosti") {
            //osim vrednosti naslova,testa i kategorije novosti,treba nam i id_novosti koju menjamo
            id = $("#id_novosti").val();
            var values = {
              "naslov": $("input[name=naslov_novosti_put]").val(),
              "tekst": $("#tekst_novosti_put").val(),
              //preko input[name=kategorija_odabir] nije radilo iz nekog razloga
              "kategorija_id": parseInt($("#kategorija_odabir_put").val())
            }
            console.log(values);
            url1 = "http://localhost:8080/rest/api/novosti/" + id;
            $.ajax({
              contentType: "application/json",
              url: url1,
              type: 'PUT',
              data: JSON.stringify(values),
              success: function (result) {
                // Do something with the result
                alert("Odgovor od servera> " + result['poruka']);
              }
            });
            // $.put("http://localhost:8080/rest/api/novosti/" + id, JSON.stringify(values), function (data) {
            //     alert("Odgovor od servera> " + data['poruka']);
            // });
          } else {
            id = $("input[name = id_kategorije]").val();
            var values = {
              "kategorija": $("#kategorija_naziv_put").val()
            };
            console.log(values);
            $.ajax({
              contentType: 'application/json',
              url: "http://localhost:8080/rest/api/kategorije/" + id,
              type: 'PUT',
              data: JSON.stringify(values),
              success: function (result) {
                // Do something with the result
                alert("Odgovor od servera> " + result['poruka']);
              },
              error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
              }
            });
            // $.put("http://localhost:8080/rest/api/kategorije/" + id, JSON.stringify(values), function (
            // data) {
            //     alert("Odgovor od servera> " + data['poruka']);
            // });
          }
          break;
        case "delete":
          id = parseInt($("#brisanje").val());
          if (tabela == "radio_novosti") {
            console.log("Izabrano je brisanje novosti sa id-em:" +
              id);
            $.ajax({
              contentType: 'application/json',
              url: "http://localhost:8080/rest/api/novosti/" + id,
              type: 'DELETE',
              success: function (result) {
                // Do something with the result
                alert("Odgovor od servera> " + result['poruka']);
              },
              error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
              }
            });
          } else {
            console.log("Izabrano je brisanje kategorije sa id-em:" +
              id);
            $.ajax({
              contentType: 'application/json',
              url: "http://localhost:8080/rest/api/kategorije/" + id,
              type: 'DELETE',
              success: function (result) {
                // Do something with the result
                alert("Odgovor od servera> " + result['poruka']);
              },
              error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
              }
            });
          }
          break;

        default:
          console.log("default");
      }
    }
  }
</script> -->