<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Heliotrope Perfumes>Korpa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-control" content="public">

    <link rel="stylesheet" href="bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <style>
        div.container.korpa>table.table.table-striped.table-responsive>tbody>tr>td.totalSinglePrice,
        div.container.korpa>table.table.table-striped.table-responsive>tbody>tr>td.singlePrice {
            text-align: center;
            vertical-align: middle;
            padding: unset;
        }

        td.quantity select {
            background-color: unset;
            width: 100%;
            text-align: center;
            border: unset;
            font: 2vh;
            font-size: 1.8vh;
            padding-top: 5px;
            vertical-align: middle;

        }

        div.container.korpa {
            min-height: 77.6vh;
        }

        table {
            border-collapse: collapse;
        }

        td:not(tfoot td) {
            border: 1px solid black;
        }

        table.table.table-striped.table-responsive tfoot tr td {
            vertical-align: middle;
        }

        table.table.table-striped.table-responsive tr td {
            width: 1%;
            white-space: nowrap;
        }

        button.btn.btn-izbaci {
            background-color: #dda9bd;
            width: 100%;
        }

        button.btn.btn-secondary {
            width: 100%;
        }

        a.btn.btn-success {
            font-size: 1.35vw;
            max-width: 25vw;
        }

        a#zavrsi-kupovinu.btn.btn-success {
            width: 100%;
        }

        div.col-sm-2.social {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        @media only screen and (max-width: 510px) {

            div.col-sm-2#social {
                display: none;
            }
        }
    </style>

</head>
<?php

if (!isset($_SESSION)) {
    session_start();
}
// unset($_SESSION['cart']);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();

}
// include 'obrada.php';
?>

<body onload="">

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
    <div class="container korpa" style="width: 90vw">
        <h4>Korpa sadrži:<span>
                <?php countKorpa(); ?>
            </span> proizvoda
        </h4>
        <div class="korpa-div">
        </div>

        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Pojedinačna cena</th>
                    <th>Količina</th>
                    <th>Ukupno</th>
                </tr>
            </thead>
            <tfoot>
                <form action="?" method="post">

                    <tr>
                        <td colspan="2">
                        </td>
                        <td style="text-align: end"> Ukupno:</td>
                        <td id="totalPrice" style="text-align: center"> 0.00 Euro</td>
                        <td><button type="button" class="btn btn-secondary"><input type="submit" name="submit"
                                    value="Isprazni Korpu" style="border: none; padding: unset;"></button></td>

                    </tr>
                    <tr>
                        <td><a href="store.php" class="btn btn-success"><span
                                    class="glyphicon glyphicon-arrow-left"></span> Nastavi sa Kupovinom</a></td>
                        <td colspan="3">
                        </td>
                        <td><a type="button" href="?" id="zavrsi-kupovinu" class="btn btn-success">Završi Kupovinu <span
                                    class="glyphicon glyphicon-arrow-right"></span></a></td>
                    </tr>
                </form>



            </tfoot>
            <tbody>
                <?php
                $L = count($_SESSION['cart']);
                for ($i = 0; $i < $L; $i++): ?>
                    <tr id="row_<?php echo $_SESSION['cart'][$i]->id ?>">
                        <td class="name">
                            <?php echo $_SESSION['cart'][$i]->name ?>
                        </td>
                        <td class="singlePrice">
                            <?php echo number_format($_SESSION['cart'][$i]->price, 2, '.', ' ') ?>
                        </td>
                        <td class="quantity">
                            <select id="sel_<?php echo $_SESSION['cart'][$i]->id ?>" name="quantity_odabir"
                                onchange="updateQuantity(this); window.location.reload();">
                                <?php
                                $quantities = range(1, 20);
                                foreach ($quantities as $q): ?>
                                    <option value="<?php echo $q ?>" <?php if ($q == $_SESSION['cart'][$i]->quantity): ?> selected
                                        <?php endif; ?>><?php echo $q ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="totalSinglePrice">
                            <?php echo number_format($_SESSION['cart'][$i]->quantity * $_SESSION['cart'][$i]->price, 2, '.', '') ?>
                        </td>
                        <form action="?" method="post">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['cart'][$i]->id ?>">
                            <td><button type="submit" name="submit" class="btn btn-izbaci" value="Izbaci">Izbaci</button>
                            </td>
                        </form>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>


    <footer class="container-fluid text-center">
        <p>@2023 Heliotrope, Sva prava zadržana</p>
        <form class="form-inline">Prijava za newsletter:
            <input type="email" class="form-control" size="50" placeholder="Email Adresa">
            <button type="button" class="btn btn-danger">Prijavi se</button>
        </form>
    </footer>
</body>

</html>
<script>

    function calculateTotal() {
        let sum = 0;
        for (let index = 0; index < $(".totalSinglePrice").length; index++) {
            sum += parseFloat($(".totalSinglePrice").eq(index).html());
        }
        document.getElementById('totalPrice').innerText = `${sum.toFixed(2)} Euro`;
    }
    function updateQuantity(selector) {
        let p_id = selector.id.split('_');
        p_id = p_id[1];
        let p_quantity = selector.value;
        let data = { "id": p_id, "quantity": p_quantity };
        $.ajax({
            contentType: 'application/json',
            url: 'http://localhost:8080/iteh/domaci/ITEH_Domaci1-PHP-MySQL-AJAX/api/parfemi/update-korpa-quantity',
            type: 'PUT',
            async: false,
            data: JSON.stringify(data),
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                debugger;
                console.log(data['message']);
            },
            error: function (e) {
                alert("greška prilikom azuriranja broja proizvoda u korpi:" + e);

            }
        });
    }
    calculateTotal();
</script>