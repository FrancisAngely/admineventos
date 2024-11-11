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
        <h1 class="h2">Participantes - Nuevo</h1>
           <a href="modulo_participantes_list.php" class="btn btn-primary">Volver</a>
      </div>

    <div class="col-12">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
        <div class="row border border-primary rounded p-3 m-5">
            <div class="col-md-6 mb-3">
            <label for="id_eventos" class="form-label">Evento</label>
            <span id="id_eventos_error" class="text-danger"></span>
            <select class="form-control" id="id_eventos" name="id_eventos">
                <option></option>
                <?php //echo SelectOptionsId("roles","role");?>
                <?php echo SelectOptions("eventos","id","evento");?>
            </select>
            </div>

            <div class="col-md-6 mb-3">
            <label for="id_entradas" class="form-label">Entrada</label>
            <span id="id_entradas_error" class="text-danger"></span>
            <select class="form-control" id="id_entradas" name="id_entradas">
                <option></option>
                <?php //echo SelectOptionsId("roles","role");?>
                <?php //echo SelectOptions("entradas","id","entrada");?>
            </select>
            </div>
        </div>
        
        
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <span id="nombre_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>

        <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <span id="apellidos_error" class="text-danger"></span>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="apellidos">
        </div>
        
        <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <span id="email_error" class="text-danger"></span>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
        </div>
        
        <div class="mb-3">
        <label for="nif_nie" class="form-label">nif_nie</label>
        <span id="nif_nie_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nif_nie" name="nif_nie" placeholder="nif_nie">
        </div>
        
    
        <div class="mb-3">
        <label for="telefono" class="form-label">telefono</label>
        <span id="telefono_error" class="text-danger"></span>
        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="telefono">
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
        
        
        
           
            let id_eventos=$("#id_eventos").val();
            let id_entradas=$("#id_entradas").val();  
            let nombre=$("#nombre").val();
            let apellidos=$("#apellidos").val();
            let email=$("#email").val();
            let nif_nie=$("#nif_nie").val();
            let telefono=$("#telefono").val();
            let error=0;
          
           
           if(id_eventos==""){ 
               error=1;
               $("#id_eventos_error").html("Debe seleccionar un evento");
               $("#id_eventos").addClass("borderError");
           }
        if(id_entradas==""){    
               error=1;
               $("#id_entradas_error").html("Debe seleccionar una  entrada");
                $("#id_entradas").addClass("borderError");
           }
        
        if(nombre==""){ 
               error=1;
               $("#nombre_error").html("Debe introducir un nombre");
               $("#nombre").addClass("borderError");
           }
        
        
        
         if(apellidos==""){ 
               error=1;
               $("#apellidos_error").html("Debe introducir sus apellidos");
               $("#apellidos").addClass("borderError");
           }
        
         if(email==""){ 
               error=1;
               $("#email_error").html("Debe introducir un email");
               $("#email").addClass("borderError");
           }
         if(nif_nie==""){ 
               error=1;
               $("#nif_nie_error").html("Debe introducir un nif o nie");
               $("#nif_nie").addClass("borderError");
           }
        
         
        
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:$("#form1").serialize(),
                 method:"POST",
                 url: "modulo_participantes_insert.php", 
                 success: function(result){
                    
                     if(result>=1){
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
                                location.href="modulo_participantes_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No Insertado correctamente!");
                        
                     }
                }
             });
        }
         
    });
    
   $("#id_eventos").change(function(){
           let id_eventos= $("#id_eventos").val();
            $.ajax({
                 data:{id_eventos:id_eventos},
                 method:"POST",
                 url: "getEntradasEvento.php", 
                 success: function(result){
                    $("#id_entradas").html(result);
                     
                }
             });
       });
    
    
});      
      
</script>      
</body>
</html>