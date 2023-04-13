// kreiramo niz blokova, odnosno niz svih id vrednosti div sekcija
const nizBlokova = ["error", "perfume-get", "perfume-post", "perfume-put", "perfume-delete", "success"];
//get DOM Elements
const modalPut = document.querySelector('#modal-put');
// const closePut = document.querySelector('#modal-put .close');
const closePut = document.getElementsByClassName('close')[0];
const formDelete = document.getElementById('perfume-delete_form');
///////////////////////////<EventHandlers>////////////////////////////////////////////
document.getElementById("zahtev_header").addEventListener("click", function (e) {
  if (e.target && e.target.matches("li>a")) {
    prikaziBlok();
  }
});
document.getElementById("search-submit").addEventListener("click", function (e) {
  posaljiZahtev("get");
});
$("input[name=upload-image]").change(function () {
  imagePreview(this);
});
document.querySelector('#perfume-post_form input[type="submit"]').addEventListener("click", function (e) {
  debugger;
  e.preventDefault();
  posaljiZahtev("post");
  return false;
});
document.querySelector('#perfume-put_form input[type="submit"]').addEventListener("click", function (e) {
  e.preventDefault();
  posaljiZahtev("put");
  return false;
});
closePut.addEventListener('click', function () {
  modalPut.style.display = 'none';
});
closePut.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);
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
    let previewId = "#";
    let alt = fileInput.files[0].name;
    switch (fileInput.id) {
      case 'upload-image-post':
        previewId += 'preview-post';
        break;
      case 'upload-image-put':
        previewId += 'preview-put';
        break;
      default:
        console.log('Nepostojeci case:' + fileInput.id);
    }
    fileReader.onload = function (event) {
      $(previewId).html(`<img src="${event.target.result}" width="300 height="auto"" alt='${alt}'/>`);
    };

    fileReader.readAsDataURL(fileInput.files[0]);
  }
}

function validateForm(form) {
  var errMessage = '';
  if ($(form+" input[name^=perfume-name]").val() == '') {
    errMessage += "Ime parfema ne sme biti prazno\n"
  }
  if ($(form+" input[name^=gender]:checked").length == 0) {
    errMessage += "Pol mora biti čekiran\n";
  }
  if ($(form+" input[name^=tester]:checked").length == 0) {
    errMessage += "Tester mora biti čekiran\n";
  }
  if (!/^((0|[1-9][0-9]*)\.[0-9]*|(0|[1-9][0-9]*))$/.test($(form+" input[name^=perfume-price]").val())) {
    errMessage += "Cena mora biti broj\n";
  }
  if (form=="perfume-post-form" && $(form+" input[name^=upload-image]").val() == '') {
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
  let form;
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
                // console.log(data['query']); 
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
        form = "#perfume-post_form";//id
        validateForm(form);
        var formData = new FormData();
        formData.append('name', $( form+" input[name^=perfume-name]").val());
        formData.append('gender', $(form+" input[name^=gender]:checked")[0].value);
        formData.append('brand_id',$(form+" select[name^=brend_odabir]")[0].options.selectedIndex);
        formData.append('tester', $(form+" input[name^=tester]:checked")[0].value);
        formData.append('price', parseFloat($(form+" input[name^=perfume-price]").val()));
        formData.append('image', $(form+" input[name^=upload-image]").prop('files')[0]);
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

      case 'put':
        form = "#modal-put";//id
        validateForm(form);
        var formData = new FormData();
        let st = $(form+" img").attr("src");
        let image = st.substring(st.indexOf(',')+1);
        data={
          "name" : $( form+" input[name^=perfume-name]").val(),
          "gender": $(form+" input[name^=gender]:checked")[0].value,
          "brand_id": $(form+" select[name^=brend_odabir]")[0].options.selectedIndex,
          "tester": $(form+" input[name^=tester]:checked")[0].value,
          "price": parseFloat($(form+" input[name^=perfume-price]").val()),
          "image":  image,
          "image_name": $("#modal-put img").attr("alt")//proveriti sta vraca kada se uploaduje novi fajl
        }
        // formData.append('name', $( form+" input[name^=perfume-name]").val()); 
        // formData.append('brand_id',$(form+" select[name^=brend_odabir]")[0].options.selectedIndex);
        // formData.append('tester', $(form+" input[name^=tester]:checked")[0].value);
        // formData.append('price', parseFloat($(form+" input[name^=perfume-price]").val()));
        // formData.append('image', dataURLtoFile($("#modal-put img").attr("src"),$("#modal-put img").attr("name")));
        
        let id = $( form+" input[name^=id]").val();
        let json_data=JSON.stringify(data);
        $.ajax({
          // contentType: 'application/json', ovo je pogresno zato sto ne saljem json u ovom slucaju
          //vec zelim da posaljem multi-part data koji cu uzeti kasnije iz $_POST varijable, u suprotnom $_POST
          // je prazna i moram da koristim php://input' da bih izvukao input ,
          url: `http://localhost:8080/iteh/domaci/ITEH_Domaci1-PHP-MySQL-AJAX/api/parfemi/${id}`,
          method: 'PUT',
          async: false,
          data: json_data,
          dataType: 'JSON',
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
            document.getElementById(nizBlokova[0]).style.display = "none";
            document.getElementById(nizBlokova[5]).style.display = "none";
            if ('success' in data) {
              alert("Success!")
              console.log(data['query']);
              document.getElementById(nizBlokova[5]).style.display = "block";
              document.getElementById(nizBlokova[5]).innerHTML = data['message'].trim();
              modalPut.querySelector('')
            } else {
              document.getElementById(nizBlokova[0]).style.display = "block";
              document.getElementById(nizBlokova[0]).innerHTML = data['message'];
            }
          },
          error: function (e) {
            alert("greška prilikom izmene parfema:" + e);
            // debugger;
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
  var i = 1;
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
  document.getElementById("perfume-put-content").innerHTML = "";
  var i = 1;
  arrPerfume.forEach(el => {
    var div_col = document.createElement('div');
    div_col.classList.add('col-sm-4');
    div_col.innerHTML = `
        <div class="card">
        <form id="perfume-put_form" action="" method="post" onsubmit="return openModal(event,modalPut);">
          <img name="image" src="data:image/png;base64,${el["image"]}" class="img-responsive" alt="${el["image_name"]}">
          <h1 name="brand"><small>${el["brand_name"]}</small></h1>
          <h3 name="name"><i>${el["name"]}</i></h3>
          <p class="price" name="price"><b>${parseFloat(el["price"]).toFixed(2)}  &#8364</b></p>
          <input type="hidden" name="id" value=${el["id"]}>
          <input type="hidden" name="brand_id" value=${el["brand_id"]}>
          <input type="hidden" name="gender" value=${el["gender"]}>
          <input type="hidden" name="tester" value=${el["tester"]}>
          <input type="submit" name="submit" value="Izmeni Proizvod"></input>
        </form>
        </div>
        `;
    document.getElementById("perfume-put-content").appendChild(div_col);
    i++
  });
}
function fillPerfumeDelete(arrPerfume) {
  document.getElementById("perfume-delete-content").innerHTML = "";
  var i = 1;
  arrPerfume.forEach(el => {
    var div_col = document.createElement('div');
    div_col.classList.add('col-sm-4');
    div_col.innerHTML = `
        <div class="card">
          <img src="data:image/png;base64,${el["image"]}" class="img-responsive" alt="${el["image_name"]}">
          <h1><small>${el["brand_name"]}</small></h1>
          <h3><i>${el["name"]}</i></h3>
          <p class="price"><b>${parseFloat(el["price"]).toFixed(2)}  &#8364</b></p>
          <form action="" method="post">
          <input type="hidden" name="id" value=${el["id"]}>
          <input type="submit" name="submit" value="Obriši Proizvod"></input>
          </form>
        </div>
        `;
    document.getElementById("perfume-delete-content").appendChild(div_col);
  });
}
function scrollProductIntoView() {
  var hash = window.location.hash;
  if (hash != '')
    $(hash)[0].scrollIntoView({ block: 'start', behavior: 'smooth' });
}
function openModal(e, modal) {
  e.preventDefault();
  switch (modal.id) {
    case 'modal-put':
      setupPutModal(e.target);
      modal.style.display = 'block';
      break;
    default:
      console.log("openModal->nepostojeci modal->" + modal.id);
  }
  return false;
}
function closeModal() {
  modalPut.style.display = 'none';
}
// Close Modal If Outside Clicked
function outsideClick(e) {
  if (e.target == modalPut) {
    modalPut.style.display = 'none';
  }
  // if (e.target == modalDelete) {
  //   modalDelete.style.display = 'none';
  // }
}
function setupPutModal(form) {


  $.each(form.children, function (index, element) {
    switch (element.getAttribute("name")) {
      case 'image':
        modalPut.querySelector('#preview-put').innerHTML = "";
        modalPut.querySelector('#preview-put').appendChild(element.cloneNode(true));
        break;
      case 'name':
        modalPut.querySelector('#perfume-name-put').value = element.innerText;
        break;
      case 'gender':
        modalPut.querySelectorAll("input[name='gender3']")[element.value == 'M' ? 0 : 1].checked = true;
        break;
      case 'brand_id':
        modalPut.querySelector('select[name = brend_odabir]').options.selectedIndex = element.value;
        break;
      case 'tester':
        modalPut.querySelectorAll("input[name='tester3']")[element.value == 'yes' ? 0 : 1].checked = true;
        break;
      case 'price':
        modalPut.querySelector('#perfume-price-put').value = element.innerText.split(' ')[0];
        break;
      case 'id':
        modalPut.querySelector('input[name=id]').value = element.value;
    }

  });

};
function dataURLtoFile(dataurl, filename) {
  var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
      bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
      while(n--){
          u8arr[n] = bstr.charCodeAt(n);
      }
      return new File([u8arr], filename, {type:mime});
  }

//////////<POZIVI_FUNKCIJA>///////////////////
postaviAktivniNavbar();
posaljiZahtev("get");
prikaziBlok();


//////////</POZIVI_FUNKCIJA>///////////////////
