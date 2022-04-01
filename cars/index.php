<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type = "text/javascript"  src = "jquery-3.2.1.js"></script>   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cars</title>
</head>
<body>
    <!-- naslov -->
    <nav>
        <div class="nav-wrapper blue" >
        <a class="brand-logo center">Cars</a>
        </div>
        
    </nav>
    <!-- dugme za otvaranje modala -->
    <div style="padding: 10px; float: right;">
    <button href="#dodaj" data-target="dodaj" class="btn modal-trigger orange" style="border-radius: 25px;"><i class="material-icons left">drive_eta</i>Dodaj auto</button>
    </div>

    <!-- modal -->
    <div  id="dodaj" class="modal">
        <div class="modal-content">
            <h4>Dodaj auto</h4>
        <div class="row">
        <form id ="addCar" method="POST" class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <input value="" placeholder="" id="naziv" type="text" class="validate" required="" aria-required="true">
                    <label for="naziv">Naziv</label>
                    <span class="helper-text" data-error="Unesite naziv"></span>
                </div>
                <div class="input-field col s12">
                    <input value="" id="marka" type="text" class="validate" required="" aria-required="true">
                    <label for="marka">Marka</label>
                    <span class="helper-text" data-error="Unesite marku"></span>
                </div>
                <div class="input-field col s12">
                    <select id="boja" required="" aria-required="true">
                        <option value="">Izaberi boju</option>
                        <option value="crvena">Crvena</option>
                        <option value="zelena">Zelena</option>
                        <option value="plava">Plava</option>
                    </select>
                    <label>Boja</label>
                </div>
            </div>
        </form>
        </div>
            <!-- dugme za potvrdu dodavanja -->
        </div>
        <div class="modal-footer">
        <a id="odustani" class="modal-close waves-effect waves-green btn-flat">Odustani</a>
        <a id="dodajAuto" type="submit" class="waves-effect waves-green btn-flat">Dodaj</a>
        </div>
    </div>


    <!-- dugmici za prikaz auta po boji -->
    <form action="" method="post">
        <div class="center" style="padding: 10px;">
        <a id="crvena" onclick="prikaziBoju('crvena')" class="waves-effect waves-light btn red " style=" border-radius: 25px;" >CRVENA</a>
        <a id="zelena" onclick="prikaziBoju('zelena')" class="waves-effect waves-light btn  green" style=" border-radius: 25px;" >ZELENA</a>
        <a id="plava" onclick="prikaziBoju('plava')" class="waves-effect waves-light btn  blue" style=" border-radius: 25px;" >PLAVA</a>
    </div>
    </form>

    
    <!-- tabela sa podacima -->
    <div>
    <table>
        <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Naziv</th>
              <th scope="col">Marka</th>
              <th scope="col">Boja</th>
              <th style="text-align: center;">Promeni boju</th>
              <th>Izbrisi auto</th>
          </tr>
        </thead>

        <tbody id="data">
            
            
        </tbody>
      </table>
    </div>

    <!-- footer -->
    <footer class="page-footer blue">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Cars details</h5>
              </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            </div>
          </div>
        </footer>


    <script>
        // funkcija za modal
        $(document).ready(function(){
            $('.modal').modal({
                onOpenEnd: function(modal, trigger){
                    console.log("Modal je otvoren")
                },
                onCloseEnd: function(){
                    console.log("Modal je zatvoren")
                    M.updateTextFields();
                    $('#naziv').val("");
                    $('#marka').val("");
                    //$('#boja').val("");
                    $('#boja').prop('selectedIndex', 0);
                    $("#boja").formSelect();
                }
            });
            $('select').formSelect();
        });
        
        // funkcija za prikaz automobila prema boji
        function prikaziBoju(colorId){
            $.ajax({
                type: "GET",
                url: 'display.php',//+ colorId,
                dataType: "html",
                data:{
                    colorId:colorId
                },
                success:function(response){
                    $("#data").html(response);

                }
            });
        }


        // funkcija za promenu boje automobila u bazi
        function promeniBoju(id, newColor){
            
        $.ajax({

            url: "update.php",
            type: 'POST',
            dataType: "html",
            data:{
                id:id,
                newColor:newColor
            },

            success:function(response){
                alert("Uspesno ste promenili boju automobila.");
                location.reload();
            }

        });

    };

    // funkcija za dodavanje auta u bazu
    $('#dodajAuto').on('click', function(){

        var naziv = $('#naziv').val();
        var marka = $('#marka').val();
        var boja = $('#boja').val();
       

        if($('#naziv').val() == "" && $('#marka').val() =="" && $('#boja').val() == ""){

            // alert('Niste uneli podatke!!!!!!!!');
            M.toast({html: 'Niste uneli podatke!!!'})

        }else if($('#naziv').val() == ""){
            // alert('Niste uneli naziv auta');
            M.toast({html: 'Unesite naziv auta!'})
        }else if($('#marka').val() == ""){
            // alert('Niste uneli marku auta');
            M.toast({html: 'Unesite marku auta!'})
        }else if($('#boja').val() == ""){
            //alert('Niste izabrali boju auta');
            M.toast({html: 'Niste izabrali boju auta!'})
        }else{
            $.ajax({

                url: "insert.php",
                type: 'POST',
                data:{
                    naziv:naziv,
                    marka:marka,
                    boja:boja
                }, 
                success:function(response){
                    alert("Uspesno ste uneli nov automobil");
                    $("form").trigger("reset");

                }

            });
        }

    });


    // funkcija za brisanja automobila iz baze
    function deleteCar(id){
        $.ajax({
            url: "delete.php",
            type: 'POST',
            data:{
                id:id
            },
            success:function(response){
                alert("Uspesno ste uklonili auto");
                location.reload();
            }

        });
    }


        
        

       

    </script>



    
    
    
</body>
</html>