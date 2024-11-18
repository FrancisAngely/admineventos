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
        <h1 class="h2">Roles</h1>
           <a href="modulo_roles_new.php" class="btn btn-primary">Nuevo</a>
      </div>

      <table class="table">
    <tr>
        <th>Id</th> 
        <th>Role</th>
        <th>Acciones</th>
   </tr>
        <?php
        
          $roles=getAllV("roles");
        
         if(count($roles)>0){
             foreach($roles as $r){
                 ?>
                    <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["role"];?></td>  
                    <td><a href="modulo_roles_edit.php?id=<?php echo $r["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    &nbsp;&nbsp;
                     <a href="#" data-id="<?php echo $r["id"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>    
                    </td>
                    </tr>
                <?php
             }
         }
        ?>
          
    </table>
            </div>
        </div> <!-- content -->


        <?php include("footer.php"); ?>


      </div>
    </div>

    <?php include("scripts.php"); ?>
    <script>
      $(".borrar").click(function() {
        let id = $(this).attr('data-id');
        let padre = $(this).parent().parent();
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
          },
          buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
          title: "Desea eliminar el role?",
          text: "no hay vuelta atrás!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "No, mantener!",
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
              data: {
                id: id
              },
              method: "POST",
              url: "modulo_roles_delete.php",
              success: function(result) {
                if (result == 1) {
                  swalWithBootstrapButtons.fire({
                    title: "Eliminado!",
                    text: "Rol dado de baja",
                    icon: "success"
                  });
                  padre.hide();
                } else {
                  swalWithBootstrapButtons.fire({
                    title: "No Eliminado!",
                    text: "Rol NO dado de baja",
                    icon: "error"
                  });
                }
              }
            });





          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            /*   swalWithBootstrapButtons.fire({
                 title: "Cancelled",
                 text: "Your imaginary file is safe :)",
                 icon: "error"
               });*/
          }
        });
      });
    </script>

</body>

</html>