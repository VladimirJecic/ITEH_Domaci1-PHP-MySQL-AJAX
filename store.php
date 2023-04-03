<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Heliotrope Perfumes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-control" content="public">

  <link rel="stylesheet" href="bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/style.css">

</head>
<?php
// phpinfo();
// echo $_SERVER['DOCUMENT_ROOT'];
if (!isset($_SESSION)) {
  session_start();
}
// ini_set('mysql.connect_timeout', 300);
// ini_set('default.connect_timeout', 300);
//include 'obrada.php';
?>

<body>

  <div id="header" class="container-fluid" style="background-color: #df73ff">

    <div class="row">
      <div class="col-sm-1" style="align-items: center; justify-content: flex-end; padding-right: 0px;">
        <span class="glyphicon glyphicon-envelope">
      </div>
      <div class="col-sm-3" style="background-color:lavender;">
        <text-center>prodaja@heliotrope.rs</text-center>
      </div>

      <div class="col-sm-1"> <span class="glyphicon glyphicon-earphone"></div>
      <div class="col-sm-3"><text-center> +381 64 583 7198</text-center></div>
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

  <div class="row" style="background-color: #e6a3fa">
    <div class="col-sm-2"><img id="logo-small" class="img-responsive" src="img/logo1.png" alt="logo.png"></div>
    <div id="input" class="col-sm-5">
      <input type="text" name="search-name" id="search-name" placeholder="Pretraga po imenu">
      <!-- NE-zaboraviti labele,NIKADA,inace input poblesavi i duzina skroz poremeti layout -->
      <div>
        <input type="radio" name="gender1" id="male1" value="M">
        <label for="male1">Muški</label>
        <input type="radio" name="gender1" id="female1" value="F">
        <label for="female1">Ženski</label>
      </div>
      <container id="brend_sort_odabir">
        <abbr>Brend:</abbr>
        <select name="brend_odabir" title="brend_odabir" id="brend_odabir1">
          <option value="0">--Svi--</option>
          <option value="1">B1</option>
          <option value="2">B2</option>
          <option value="3">B3</option>
          <option value="4">B4</option>
        </select>
        <select name="sort_odabir" title="brend_odabir" id="sort_odabir">
          <option value="perfume.price asc">Cene->rastuće</option>
          <option value="perfume.price desc">Cene->opadajuće</option>
          <option value="perfume.name asc">Imena->rastuća(A-Z)</option>
          <option value="perfume.name desc">Imena->opadajuća(Z-A)</option>
        </select>
      </container>
      <div id="tester1">
        <abbr>Tester:</abbr>
        <input type="radio" name="tester1" id="yes1" value="yes">
        <label for="yes1">Da</label>
        <input type="radio" name="tester1" id="no1" value="no">
        <label for="no1">Ne</label>
      </div>
      <!-- <container id="quantity">
        <abbr>Količina:</abbr>
        <select name="quantity_odabir" title="quantity_odabir" id="quantity_odabir">
          < ? php
          $quantities = range(1, 10);
          foreach ($quantities as $q): ?>
            <option value= "< ? php  echo $q ?>"> < ?php echo $q ?> </option>
          < ? php endforeach; ?>
        </select>
      </container> -->



    </div>
    <div id="div-search" class="col-sm-1"><button type="submit" name="search-submit" title="search-submit"><span
          class="glyphicon glyphicon-search"></button></div>
    <div id="benefits" class="col-sm-4">
      <div class="row">
        <span class="glyphicon glyphicon-ok"></span>
        <h2>100% Original</h2>
      </div>
      <div class="row">
        <span class="glyphicon glyphicon-ok"></span>
        <h2>Safe Purchase</h2>
      </div>
      <div class="row">
        <span class="glyphicon glyphicon-ok"></span>
        <h2>Free Shipment</h2>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-inverse sticky"> <!-- 298.65 -->
    <div class="container-fluid">
      <div class="navbar-header" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav" name="zahtev_header" id="zahtev_header">
          <li class="active"><a class="perfume-get" href="#perfume-get">Parfemi</a></li>
          <li><a class="perfume-post" href="#perfume-post">Unos Novog Parfema</a></li>
          <li><a class="perfume-put" href="#perfume-put">Izmena Parfema</a></li>
          <li><a class="perfume-delete" href="#perfume-delete">Brisanje Parfema</a></li>
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
                <li><a href="korpa.php">Vidi Korpu</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <pre class="container" id="error" style="color:#ff3333"></pre>
  <pre class="container" id="success" style="color:#33cc33"></pre>
  <div class="container" id="perfume-get" style="display: block;">
    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <img src="img/versace-eros-100ml.png" class="img-responsive" style="max-width:25 vw;" alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <img src="img/acqua_di_parma-magnolia_nobile-100ml.png" class="img-responsive" style="max-width:25 vw;"
            alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <img src="img/versace-eros-100ml.png" class="img-responsive" style="max-width:25 vw;" alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <img src="img/versace-eros-100ml.png" class="img-responsive" style="max-width:25 vw;" alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <img src="img/versace-eros-100ml.png" class="img-responsive" style="max-width:25 vw;" alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <img src="img/versace-eros-100ml.png" class="img-responsive" style="max-width:25 vw;" alt="Image">
          <h1><small>Bootstrap brand</small></h1>
          <h3><i>-Tailored Jeans-</i></h3>
          <p class="price"><b>$19.99</b></p>
          <p><button>Dodaj u korpu</button></p>
        </div>
      </div>
    </div>
  </div>
  <!-- <form action="." method="post" enctype="multipart/form-data"> -->
  <div class="container" id="perfume-post">
    <!-- ovde napraviti skeleton, zatim u  js dodati akciju na klik na dugme -->
    <form id="image_upload_form" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-5">
        <div class="row">
          <div class="panel panel-primary" style="height:35%">
            <div id="preview" class="panel-body">
              <img src="img/150x80.png" style="height:160px; width:300px;" class="img-responsive" style="width:100%"
                alt="Image">
            </div>
            <div class="panel-footer"><input type="file" id="upload-image" name="upload-image" class="btn btn-info"  accept="image/*"
                value="Izaberi Sliku" style="width:100%">
            </div>
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
            <input type="radio" name="gender2" id="male2" value="M">
            &nbsp &nbsp
            <label for="female2">Ženski</label>
            <input type="radio" name="gender2" id="female2" value="F">
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
            <input type="radio" name="tester2" id="yes2" value="yes">
            <label for="ye2s">Da</label>
            &nbsp &nbsp
            <input type="radio" name="tester2" id="no2" value="no">
            <label for="no2">Ne</label>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label for="perfume-price">Cena:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" name="perfume-price" id="perfume-price" placeholder="U evrima...">
          </div>
        </div>
        <div class="row" id="parfem-post">
          <input type="submit" name="parfem-post" id="parfem-post" class="btn btn-info" value="Sačuvaj parfem"
            style="margin-left: 10px">
        </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
    </form>
  </div>
  <div class="container" id="perfume-put"></div>
  <div class="container" id="perfume-delete"></div>
  <!-- </form> -->
  <br>
  <br>
  <footer class="container-fluid text-center">
    <p>@2023 Heliotrope, Sva prava zadržana</p>
    <form class="form-inline">Prijava za newsletter:
      <input type="email" class="form-control" size="50" placeholder="Email Addresa">
      <button type="button" class="btn btn-danger">Prijavi se</button>
    </form>
  </footer>
  <script src="js/mojskript.js" type="text/javascript"></script>
</body>

</html>