// kreiramo niz blokova, odnosno niz svih id vrednosti div sekcija
const nizBlokova = ["error", "perfume-get", "perfume-post", "perfume-put", "perfume-delete", "success"];

///////////////////////////<EventHandlers>////////////////////////////////////////////
document.getElementById("zahtev_header").addEventListener("click", function (e) {
  if (e.target && e.target.matches("li>a")) {
    prikaziBlok();
  }
});
$("form#image_upload_form").submit(function (e) {
  e.preventDefault();
  posaljiZahtev("post");
});
document.getElementsByName("search-submit")[0].addEventListener("click", function (e) {
  posaljiZahtev("get");
  // prikaziBlok("perfume-get");
});
// document.getElementByClass("perfume-put")[0].addEventListener("click", function (e) {
//   posaljiZahtev("get");
//   prikaziBlok("perfume-put");
// });
// document.getElementByClass("perfume-delete")[0].addEventListener("click", function (e) {
//   posaljiZahtev("get");
//   prikaziBlok("perfume-delete");
// });
$("#upload-image").change(function () {
  imagePreview(this);
});
////////////////////////////</EventHandlers>////////////////////////////////////////////

function postaviAktivniNavbar() {
  // Highlights current active nav-bar element,(adds active class to the current button)
  var header = document.getElementById("zahtev_header");
  var lis = header.querySelectorAll("li");
  for (var i = 0; i < lis.length; i++) {
    lis[i].addEventListener("click", function () {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace("active", "");
      this.className += "active";
    });
  }
}
//na samom početku želimo da sakrijemo sve blokove, sem aktivnog
function skloniBlokove() {
  //prolazimo kroz niz blokova
  for (const blok of nizBlokova) {
    //i vrednost display atributa u okviru css-a postavljamo na none, kako se ne bi prikazivali
    document.getElementById(blok).style.display = "none";
  }
}

function prikaziBlok(blok) {
  skloniBlokove();
  if (!nizBlokova.includes(blok)) {
    var blok = document.getElementsByClassName("active")[0].childNodes[0].className;
  }
  for (var i = 0; i < nizBlokova.length; i++) {
    if (blok == nizBlokova[i]) {
      document.getElementById(blok).style.display = "block";
      break;
    }
  }
}
//Preview image on upload
function imagePreview(fileInput) {
  if (fileInput.files && fileInput.files[0]) {
    var fileReader = new FileReader();
    fileReader.onload = function (event) {
      $('#preview').html('<img src="' + event.target.result + '" width="300 height="auto""/>');
    };

    fileReader.readAsDataURL(fileInput.files[0]);
  }
}

function validatePost() {
  var errMessage = '';
  if ($("#perfume-name").val() == '') {
    errMessage += "Ime parfema ne sme biti prazno\n"
  }
  if ($("input[name=gender2]:checked").length == 0) {
    errMessage += "Pol mora biti čekiran\n";
  }
  if ($("input[name=tester2]:checked").length == 0) {
    errMessage += "Tester mora biti čekiran\n";
  }
  if (!/^((0|[1-9][0-9]*)\.[0-9]*|(0|[1-9][0-9]*))$/.test($("#perfume-price").val())) {
    errMessage += "Cena mora biti broj\n";
  }
  if ($("input[name=upload-image]").val() == '') {
    errMessage += "Slika mora biti selektovana\n";
  }
  if (errMessage != '') {
    throw errMessage;
  }
}
function getFilters() {
  let filters = {
    "where": null,
    "order": null
  };
  if ($("#search-name").val() != '') {
    filters["where"] = `LOWER(perfume.name)  LIKE '\%${$("#search-name").val()}\%'`;
  }
  if ($("input[name=gender1]:checked").length != 0) {
    if (filters["where"] == null) {
      filters["where"] = `perfume.gender='${$("input[name = gender1]:checked")[0].value}'`;
    }
    else {
      filters["where"] += ` AND perfume.gender='${$("input[name = gender1]:checked")[0].value}'`;
    }
  }
  if (parseInt($("#brend_odabir1").val()) != 0) {
    if (filters["where"] == null) {
      filters["where"] = `perfume.brand_id=${parseInt($("#brend_odabir1").val())}`;
    }
    else {
      filters["where"] += ` AND perfume.brand_id=${parseInt($("#brend_odabir1").val())}`;
    }
  }
  if ($("input[name=tester1]:checked").length != 0) {
    if (filters["where"] == null) {
      filters["where"] = `perfume.tester='${$("input[name = tester1]:checked")[0].value}'`;
    }
    else {
      filters["where"] += ` AND perfume.tester='${$("input[name = tester1]:checked")[0].value}'`;
    }
  }
  filters["order"] = `${$("#sort_odabir").val()}`;
  filters["where"] = btoa(encodeURIComponent(filters["where"]));
  return filters;

}
//funkcija posaljiZahtev obrađuje pomoću AJAX - a zahteve koje šaljemo ka serveru
function posaljiZahtev(tipZahteva) {
  try {
    switch (tipZahteva) {
      case "get":
        // SELECT * FROM perfume JOIN brand ON (perfume.brand_id=brand.id) JOIN image ON (perfume.image_id=image.id)
        // WHERE LOWER(perfume.name)  LIKE '%versace%' AND perfume.gender = 'M' AND brand.name = 'Versace' AND perfume.tester = 'no'
        // ORDER BY perfume.name desc;
        let f = getFilters;
        $.ajax({
          type: "GET",
          url: "http://localhost:8080/iteh/domaci/ITEH_Domaci1-PHP-MySQL-AJAX/api/parfemi/",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          data: getFilters(),
          success: function (data) {
            if ('message' in data) {
              if ('success' in data) {
                console.log(data['message']);
              } else {
                console.error(data['message']);
              }
            }
            if ('arrPerfume' in data) {
              arrPerfume = data['arrPerfume'];
              var getType = document.getElementsByClassName("active")[0].childNodes[0].className;
              switch (getType) {
                case "perfume-get":
                  fillPerfumeGet(arrPerfume);
                  scrollProductIntoView();
                  break;
                case "perfume-put":
                  fillPerfumePut(arrPerfume);
                  scrollProductIntoView();
                  break;
                case "perfume-delete":
                  fillPerfumeDelete(arrPerfume);
                  scrollProductIntoView();
                  break;
                default:
                  console.log("Nepredvidjen aktivni blok" + getType);
              }

              if (arrPerfume.length == 0) {
                var div_empty_response = document.createElement('div');
                div_empty_response.classList.add('alert');
                div_empty_response.classList.add('alert-warning');
                div_empty_response.innerHTML = "<h4><strong>!</strong> Nije nadjen nijedan parfem za unete podatke pretrage.</h4></div>";
                document.getElementById("perfume-get").appendChild(div_empty_response);

              }
            } else {
              console.error("vracena je neinicijalizovana data['arrPerfume']");
            }
          }
        });
        break;
      case "post":
        validatePost();
        var formData = new FormData();
        formData.append('name', $("#perfume-name").val());
        formData.append('gender', $("input[name=gender2]:checked")[0].value);
        formData.append('brand_id', $("#brend_odabir2").val());
        formData.append('tester', $("input[name=tester2]:checked")[0].value);
        formData.append('price', parseFloat($("#perfume-price").val()));
        formData.append('image', $("#upload-image").prop('files')[0]);
        $.ajax({
          // contentType: 'application/json', ovo je pogresno zato sto ne saljem json u ovom slucaju
          //vec zelim da posaljem multi-part data koji cu uzeti kasnije iz $_POST varijable, u suprotnom $_POST
          // je prazna i moram da koristim php://input' da bih izvukao input 
          contentType: 'multipart/form-data',
          url: 'http://localhost:8080/iteh/domaci/ITEH_Domaci1-PHP-MySQL-AJAX/api/parfemi',
          type: 'POST',
          async: false,
          data: formData,
          dataType: 'JSON',
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
            document.getElementById(nizBlokova[0]).style.display = "none";
            document.getElementById(nizBlokova[5]).style.display = "none";
            if ('success' in data) {
              document.getElementById(nizBlokova[5]).style.display = "block";
              document.getElementById(nizBlokova[5]).innerHTML = data['message'].trim();
            } else {
              document.getElementById(nizBlokova[0]).style.display = "block";
              document.getElementById(nizBlokova[0]).innerHTML = data['message'];
            }
          },
          error: function (e) {
            alert("greška prilikom dodavanja novog parfema:" + e);
            debugger;
          }
        });
        break;

      default:
        console.log("default");
    }
  } catch (err) {
    console.log(err);
    document.getElementById(nizBlokova[0]).innerHTML = err;
    document.getElementById(nizBlokova[0]).style.display = "block";
  }
}
function fillPerfumeGet(arrPerfume) {
  console.log("GET");
  document.getElementById("perfume-get").innerHTML = "";
  var i=1;
  arrPerfume.forEach(el => {
    var div_col = document.createElement('div');
    div_col.classList.add('col-sm-4');
    div_col.innerHTML = `
        <div class="card"  id="product${i}">
          <img src="data:image/png;base64,${el["image"]}" class="img-responsive" alt="${el["image_name"]}">
          <h1><small>${el["brand_name"]}</small></h1>
          <h3><i>${el["name"]}</i></h3>
          <p class="price"><b>${parseFloat(el["price"]).toFixed(2)}  &#8364</b></p>
          <form action="" method="post">
          <input type="hidden" name="id" value=${el["id"]}>
          <input type="submit" name="submit" value="Dodaj u korpu"></input>
          </form>
        </div>
        `;
    document.getElementById("perfume-get").appendChild(div_col);
    i++;
  });
}
function fillPerfumePut(arrPerfume) {  
  document.getElementById("perfume-put").innerHTML = "";
  arrPerfume.forEach(el => {
    var div_col = document.createElement('div');
    div_col.classList.add('col-sm-4');
    div_col.innerHTML = `
        <div class="card">
          <img src="data:image/png;base64,${el["image"]}" class="img-responsive" alt="${el["image_name"]}">
          <h1><small>${el["brand_name"]}</small></h1>
          <h3><i>${el["name"]}</i></h3>
          <p class="price"><b>${parseFloat(el["price"]).toFixed(2)}  &#8364</b></p>
          <p><button id="changeProduct">Izmeni Proizvod</button></p>
        </div>
        `;
    document.getElementById("perfume-put").appendChild(div_col);
  });
}
function fillPerfumeDelete(arrPerfume) {
  document.getElementById("perfume-delete").innerHTML = "";
  arrPerfume.forEach(el => {
    var div_col = document.createElement('div');
    div_col.classList.add('col-sm-4');
    div_col.innerHTML = `
        <div class="card">
          <img src="data:image/png;base64,${el["image"]}" class="img-responsive" alt="${el["image_name"]}">
          <h1><small>${el["brand_name"]}</small></h1>
          <h3><i>${el["name"]}</i></h3>
          <p class="price"><b>${parseFloat(el["price"]).toFixed(2)}  &#8364</b></p>
          <p><button id="deleteProduct">Obriši Proizvod</button></p>
        </div>
        `;
    document.getElementById("perfume-delete").appendChild(div_col);
  });
}
function scrollProductIntoView(){
  var hash = window.location.hash;
  if(hash!='')
  $(hash)[0].scrollIntoView({ block: 'start',  behavior: 'smooth' });
}
//////////<POZIVI_FUNKCIJA>///////////////////
postaviAktivniNavbar();
posaljiZahtev("get");
prikaziBlok();


//////////</POZIVI_FUNKCIJA>///////////////////
