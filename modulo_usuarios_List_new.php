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
                        <h1 class="h2">Usuarios - Nuevo</h1>
                        <a href="modulo_usuarios_List.php" class="btn btn-primary">Volver</a>
                    </div>

                    <div class="col-4">
                        <form action="#" method="post" enctype="multipart/form-data" id="form1">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <span id="usuario_error" class="text-danger"></span>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <span id="password_error" class="text-danger"></span>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña">
                            </div>


                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <span id="email_error" class="text-danger"></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                            </div>

                            <div class="mb-3">
                                <label for="id_roles" class="form-label">Role</label>
                                <span id="id_roles_error" class="text-danger"></span>
                                <select class="form-control" id="id_roles" name="id_roles">
                                    <option></option>
                                    <?php echo SelectOptions("roles", "id", "role"); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="button" class="form-control" value="Aceptar" id="btnform1">
                            </div>

                        </form>
                    </div>

                </div>

                <?php include("footer.php"); ?>
            </div>
        </div>

        <?php include("scripts.php"); ?>
        <script>
            $(document).ready(function() {

                $("#btnform1").click(function() {
                    // Swal.fire("SweetAlert2 is working!");
                    let id_roles = $("#id_roles").val();
                    let usuario = $("#usuario").val();
                    let password = $("#password").val();
                    let email = $("#email").val();
                    let error = 0;


                    if (id_roles == "") {

                        error = 1;
                        $("#id_roles_error").html("Debe introducir un role");
                        $("#id_roles").addClass("borderError");
                    }

                    if (usuario == "") {

                        error = 1;
                        $("#usuario_error").html("Debe introducir un nombre de usuario");
                        $("#usuario").addClass("borderError");
                    }

                    if (password == "") {

                        error = 1;
                        $("#password_error").html("Debe introducir una contraseña");
                        $("#password").addClass("borderError");
                    }

                    if (email == "") {

                        error = 1;
                        $("#email_error").html("Debe introducir un E-mail correcto");
                        $("#email").addClass("borderError");
                    }
                    if (error == 0) {
                        $.ajax({
                            data: $("#form1").serialize(),
                            method: "POST",
                            url: "modulos_usuarios_insert.php",
                            success: function(result) {

                                if (result > 1) {
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

                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            location.href = "modulo_usuarios_List.php";
                                        }
                                    });
                                } else {
                                    Swal.fire("No Insertado correctamente!");

                                }
                            }
                        });
                    }

                });

            });
        </script>
</body>

</html>