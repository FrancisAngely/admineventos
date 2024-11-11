<!doctype html>
<html lang="en" data-bs-theme="auto">
  <?php include("head.php");?>
  <?php include("controller.php");?>
  <body>
    <?php include("iconos.php");?>

<?php include("header.php");?>

<div class="container-fluid">
  <div class="row">
    <?php include("menu.php");?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuarios - Editar</h1>
           <a href="modulo_usuarios_list.php" class="btn btn-primary">Volver</a>
      </div>

    <?php
        $user=getById("usuarios",$_GET["id"]);
    ?>
        
    <div class="col-4">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
           <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $user["id"];?>"  >
        
        <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <span id="usuario_error" class="text-danger"></span>
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $user["usuario"];?>"  >
        </div>


        <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <span id="password_error" class="text-danger"></span>
        <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña"  value="<?php echo $user["password"];?>">
        </div>
        
        
        <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <span id="email_error" class="text-danger"></span>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"  value="<?php echo $user["email"];?>" >
        </div>
        
        <div class="mb-3">
        <label for="id_roles" class="form-label">Role</label>
        <span id="id_roles_error" class="text-danger"></span>
        <select class="form-control" id="id_roles" name="id_roles">
            <option></option>
            <?php echo SelectOptionsIdSel("roles","role",$user["id_roles"]);?>
            <?php //echo SelectOptions("roles","id","role");?>
        </select>
        </div>


        <div class="mb-3"> 
        <input type="button" class="form-control" value="Aceptar" id="btnform1">
        </div>

    </form>
 </div>    

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?>   
      
      
<script>
$( document ).ready(function() {
   
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
        
        //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
        
            let id_roles=$("#id_roles").val();  
            let usuario=$("#usuario").val();
            let password=$("#password").val();
            let email=$("#email").val();
            let error=0;
          
           if(id_roles==""){    
               error=1;
               $("#id_roles_error").html("Debe seleccionar un role");
                $("#id_roles").addClass("borderError");
           }
        
           if(usuario==""){ 
               error=1;
               $("#usuario_error").html("Debe introducir un nombre de usuario");
               $("#usuario").addClass("borderError");
           }
        
        if(password==""){ 
               error=1;
               $("#password_error").html("Debe introducir una contraseña");
               $("#password").addClass("borderError");
           }
        
        if(email==""){ 
               error=1;
               $("#email_error").html("Debe introducir una dirección de correo");
               $("#email").addClass("borderError");
           }
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:$("#form1").serialize(),
                 method:"POST",
                 url: "modulo_usuarios_update.php", 
                 success: function(result){
                    
                     if(result==1){
                         //alert("Datos insertados correctamente!");
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
                              /* Read more about handling dismissals below */
                              if (result.dismiss === Swal.DismissReason.timer) {
                                location.href="modulo_usuarios_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
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