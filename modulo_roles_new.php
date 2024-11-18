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

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Roles - Nuevo</h1>
            <a href="modulo_roles_list.php" class="btn btn-primary">Volver</a>
          </div>

          <div class="col-4">
            <form action="#" method="post" enctype="multipart/form-data" id="form1">
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <span id="role_error" class="text-danger"></span>
                <input type="text" class="form-control" id="role" name="role" placeholder="Role">
              </div>

              <div class="mb-3">
                <input type="button" class="form-control" value="Aceptar" id="btnform1">
              </div>

            </form>
          </div>
        </div>

      </div> <!-- content -->


      <?php include("footer.php"); ?>


    </div>
  </div>

  <?php include("scripts.php"); ?>


  <script>
    $(document).ready(function() {

      $("#btnform1").click(function() {
        let role = $("#role").val();
        let tabla = "roles";
        let campo = "role";
        let error = 0;

        if (role == "") {
          error = 1;
          $("#role_error").html("Debe introduccir un role");
          $("#role").addClass("borderError");
        }


        if (error == 0) {

          $.ajax({
            data: {
              valor: role,
              tabla: tabla,
              campo: campo
            },
            method: "POST",
            url: "verificarUnico.php",
            success: function(result) {
              if (result == 0) {
                $("#role_error").html("role existe");
                $("#role").val('');
                $("#role").addClass("borderError");
              } else {
                $("#role").removeClass("borderError");
                $("#role_error").html("");

                $.ajax({
                  data: $("#form1").serialize(),
                  method: "POST",
                  url: "modulo_roles_insert.php",
                  success: function(result) {

                    if (result > 1) {
                      //alert("Datos insertados correctamente!");
                      let timerInterval;
                      Swal.fire({
                        title: "Datos insertados correctamente!",
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
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                          location.href = "modulo_roles_list.php";
                        }
                      });
                      //location.href="clientes.php";
                    } else {
                      Swal.fire("No Insertado correctamente!");

                    }
                  }
                });
              }
            }
          });
        }
      });
    });
  </script>
</body>

</html>