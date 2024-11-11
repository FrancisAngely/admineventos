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

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?>   
      
      
<script>
$( document ).ready(function() {
   
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
        
        //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `roles` WHERE 1
        
            let role=$("#role").val();  
            let tabla="roles";  
            let campo="role";
            let error=0;
          
           if(role==""){    
               error=1;
               $("#role_error").html("Debe introduccir un role");
                $("#role").addClass("borderError");
           }
        
        
        if(error==0){
            
            $.ajax({
                 data:{valor:role,tabla:tabla,campo:campo},
                 method:"POST",
                 url: "verificarUnico.php", 
                 success: function(result){
                     if(result==0){
                        $("#role_error").html("role existe");
                        $("#role").val(''); 
                         $("#role").addClass("borderError");
                     }else{
                         $("#role").removeClass("borderError"); 
                         $("#role_error").html("");
                        
                          $.ajax({
                         data:$("#form1").serialize(),
                         method:"POST",
                         url: "modulo_roles_insert.php", 
                         success: function(result){
                    
                     if(result>1){
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
                                location.href="modulo_roles_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
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