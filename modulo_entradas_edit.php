<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<head>
  <meta charset="utf-8" />
  <title>Dashboard | Scoxe - Responsive Bootstrap 5 Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Myra Studio" name="author" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <link href="assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
  <script src="assets/js/config.js"></script>
</head>

<body>
  <?php include("head.php"); ?>
  <div class="layout-wrapper">
    <?php include("sliderbar.php"); ?>
    <div class="page-content">
      <?php include("topbar.php"); ?>
      <div class="px-3">
        <div class="container-fluid">
          <?php include("breadcrumb.php"); ?>

          <div class="px-3">

            <!-- Start Content-->
            <div class="container-fluid">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Entradas - Editar</h1>
                <a href="modulo_entradas_list.php" class="btn btn-primary">Volver</a>
              </div>

              <?php
              $ent = getById("entradas", $_GET["id"]);
              ?>

              <div class="col-4">
                <form action="#" method="post" enctype="multipart/form-data" id="form1">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $ent["id"]; ?>">


                  <div class="mb-3">
                    <label for="entrada" class="form-label">Entrada</label>
                    <span id="entrada_error" class="text-danger"></span>
                    <input type="text" class="form-control" id="entrada" name="entrada" placeholder="Entrada" value="<?php echo $ent["entrada"]; ?>">
                  </div>

                  <div class="mb-3">
                    <label for="id_eventos" class="form-label">Evento</label>
                    <span id="id_eventos_error" class="text-danger"></span>
                    <select class="form-control" id="id_eventos" name="id_eventos">
                      <option></option>
                      <?php echo SelectOptionsIdSel("eventos", "evento", $ent["id_eventos"]); ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <span id="precio_error" class="text-danger"></span>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min=0 value="<?php echo $ent["precio"]; ?>">
                  </div>

                  <div class="mb-3">
                    <input type="button" class="form-control" value="Aceptar" id="btnform1">
                  </div>

                </form>
              </div>


            </div> <!-- container -->

          </div> <!-- content -->


          <?php include("footer.php"); ?>


        </div>
      </div>

      <?php include("scripts.php"); ?>

      <script>
        $(document).ready(function() {

          $("#btnform1").click(function() {

            let entrada = $("#entrada").val();
            let id_eventos = $("#id_eventos").val();
            let precio = $("#precio").val();

            let error = 0;

            if (entrada == "") {
              error = 1;
              $("#entrada_error").html("Debe introducir un nombre de entrada");
              $("#entrada").addClass("borderError");
            }

            if (id_eventos == "") {
              error = 1;
              $("#id_eventos_error").html("Debe seleccionar un evento");
              $("#id_eventos").addClass("borderError");
            }

            if (precio == "") {
              error = 1;
              $("#precio_error").html("Debe introducir un precio");
              $("#precio").addClass("borderError");
            }

            if (error == 0) {
              $.ajax({
                data: $("#form1").serialize(),
                method: "POST",
                url: "modulo_entradas_update.php",
                success: function(result) {

                  if (result == 1) {
                    let timerInterval;
                    Swal.fire({
                      title: "Datos actualizados correctamente!",
                      html: "",
                      timer: 2000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                          timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                      },
                      willClose: () => {
                        clearInterval(timerInterval);
                      }
                    }).then((result) => {
                      if (result.dismiss === Swal.DismissReason.timer) {
                        location.href = "modulo_entradas_list.php";
                      }
                    });
                  } else {
                    Swal.fire("No actualizados correctamente!");

                  }
                }
              });
            }
          });
        });
      </script>
</body>

</html>