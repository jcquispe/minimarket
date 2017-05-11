$(document).ready(function(){
   $(window).load(function() { 
        var pathname = window.location.pathname;
        //pathname = pathname.replace('#', '');
        pathname = pathname.split('/').join('');
        if(pathname==='inventario')
            pathname = 'inventariox';
        //alert(pathname);
        $("#"+pathname).addClass('active');
        $("#"+pathname).parents('li').addClass('active');     
        $("#container-main").show();
   $("#loadingdiv").hide();
  }); 

  if($("#nueva").val() == $("#validar").val()){
      $("#cambiar").removeAttr('disabled');
  }    


    $('#emailLink').click(function (event) {
        event.preventDefault();
        alert("Huh");
        var email = 'jcquispe006@gmail.com';
        var subject = 'Circle Around';
        var emailBody = 'Some blah';
        window.location = 'mailto:' + email + '?subject=' + subject + '&body=' +   emailBody;
   });


$("#proveedor").change(function(){
   $.ajax({
        url: '/proveedor/show',
        data: {id: $("#proveedor").val()},
        type: 'GET',
        dataType: 'json',
        success:function(data){
                $("#razon").val(data.nombre);
        }
    });
   
});

$("#categoria").change(function(){
    $(".partida").html('<option value="">-Seleccione-</option>');
    //$("#partida").html('<option value="">-Seleccione-</option>');
    $.ajax({
        url: '/partida/show',
        data: {id: $("#categoria").val()},
        type: 'GET',
        dataType: 'json',
        success:function(data){
            for(var i = 0;i < data.length;i++){
                $(".partida").append("<option value="+data[i].id+">"+data[i].codigo+" - "+data[i].descripcion+"</option>");
                //$("#partida").append("<option value="+data[i].id+">"+data[i].codigo+" "+data[i].descripcion+"</option>");
            }
        }
    });
});

$(".partida").change(function(){
    var indice = this.id;
    $("#producto"+indice).html('<option value="">-Seleccione-</option>');
    $.ajax({
        url: '/insumo/show',
        data: {id: $("#"+indice).val()},
        type: 'GET',
        dataType: 'json',
        success:function(data){
            for(var i = 0;i < data.length;i++){
                $("#producto"+indice).append("<option value="+data[i].id+">"+data[i].codigo+"</option>");
            }
        }
    });
});

$("#partida").change(function(){
    var str = $("#partida option:selected").html();
    var res = str.split(" - ");
    $("#descrip").val(res[1]);
});






$(".codigo").change(function(){
    var ide = this.id;
    var indice = $("#"+ide).val();
    $.ajax({
        url: '/producto/show',
        data: {id: indice},
        type: 'GET',
        dataType: 'json',
        success:function(data){
            $("#producto"+ide).val(data.descripcion);
            $("#unidad"+ide).val(data.unidad);
        }
    });
});

$(".codigov").change(function(){
    var ide = this.id;
    var indice = $("#"+ide).val();
    $.ajax({
        url: '/producto/show',
        data: {id: indice},
        type: 'GET',
        dataType: 'json',
        success:function(data){
            $("#producto"+ide).val(data.descripcion);
            $("#unidad"+ide).val(data.unidad);
            $("#costou"+ide).val(data.venta);
            $("#costov"+ide).val(data.venta);
            $("#cantidad"+ide).focus().select();
        }
    });
});

$("#pagado").keyup(function() {
    $("#cambio").val($("#pagado").val()-$("#total").val());
})

/*$("#cinit").blur(function(){
   var doc = $("#cinit").val();
   $.ajax({
       url: '/soluser/show',
       data: {id: doc},
       type: 'GET',
       dataType: 'json',
       success:function(data){
           $("#nombre").val(data.nombre);
       }
   })
});*/

$("#verifica").click(function(){
   var doc = $("#cinit").val();
   $.ajax({
       url: '/soluser/show',
       data: {id: doc},
       type: 'GET',
       dataType: 'json',
       success:function(data){
            if(data.nombre != null)
                $("#nombre").val(data.nombre);
            else
                $("#verificadiv").addClass('has-error');
       }
   })
});




$(".productox").change(function(){
    var ide = this.id;
    var indice = ide.substr(-1);
    //$("#disponible"+indice).removeAttr('readOnly');
    //$("#producto"+indice).html('<option value="">-Seleccione-</option>');
    $.ajax({
        url: '/producto/show',
        data: {id: $("#"+ide).val()},
        type: 'GET',
        dataType: 'json',
        success:function(data){
            $("#unidad"+indice).val(data.medida);
            $("#disponible"+indice).val(data.disponible);
            //$("#disponible"+indice).attr("readOnly", "readOnly");
        }
      
    });
});

$("#guardaPro").click(function(){
   alert('guardar?'); 
});

$("#registro").click(function(){
   var token = $("#token").val();
   
   $.ajax({
      url: '/proveedor',
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data: {nom: $("#razon_social").val(),
             nit: $("#nit").val(),
             tel: $("#telefono").val(),
             cor: $("#correo").val()},
      success:function(){
          location.reload();
      }
   });
}); 

$(".costo").blur(function(){
    var cos = this.id;   
    var indice = cos.substr(-1);
    var total = ($("#costou"+indice).val()*$("#cantidad"+indice).val()).toFixed(2);
    $("#costot"+indice).val(total);
    if($("#costot"+indice).val()!==0)
        totalIngreso(indice);
    //$("#total").val(parseFloat($("#total").val())+parseFloat($("#costot"+indice).val())).toFixed(2);
});
$(".cantidad").blur(function(){
    var cos = this.id;   
    var indice = cos.substr(-1);
    var total = ($("#costou"+indice).val()*$("#cantidad"+indice).val()).toFixed(2);
    $("#costot"+indice).val(total);
    if($("#costot"+indice).val()!==0)
        totalIngreso(indice);
    //$("#total").val(parseFloat($("#total").val())+parseFloat($("#costot"+indice).val())).toFixed(2);
});

function totalIngreso(indice){
    var acumulado = 0;
    //$("#total").val(acumulado);
    for(var i=0;i<=indice;i++){
        acumulado = parseFloat(acumulado)+parseFloat($("#costot"+i).val());
    }
    $("#total").val(acumulado);
};

$(".solicitado").blur(function(){
    //alert('blur');
    var sol = this.id;
    var indice = sol.substr(-1);
    alert('res: '+$("#"+sol).val()+'>'+$("#disponible"+indice).val());
    if(parseInt($("#"+sol).val(),10)>parseInt($("#disponible"+indice).val(),10)){
        alert('No puede solicitar mas de lo disponible');
        $("#"+sol).val('0');
    }
});
$("#fecha").datepicker({
    format: "dd/mm/yyyy",
    startDate: '-300d',
    endDate:'+0d',
    maxViewMode: 0,
    todayBtn: "linked"
});
var num=1;
/*$("#add").click(function() {
    //alert('click');
    var fila='<tr>'+
                '<td ><select class="codigo" name="codigo'+num+'" id="'+num+'"><option value="">--Código--</option></select></td>'+
    			'<td ><input type="text" name="producto'+num+'" id="producto'+num+'" disabled></td>'+
				'<td ><input type="text" name="unidad'+num+'" id="unidad'+num+'" disabled></td>'+
				'<td ><input type="text" name="cantidad'+num+'" id="cantidad'+num+'" value="0" class="cantidad"></td>'+
				'<td ><input type="text" name="costou'+num+'" id="costou'+num+'" value="0" class="costo"></td>'+
				'<td ><input type="text" name="costot'+num+'" id="costot'+num+'" class="total" disabled></td>'+
			'</tr>';
    $("#tcuerpo").append(fila);
    $("#indice").val(num);
    $.ajax({
        url: '/insumo/show',
        type: 'GET',
        dataType: 'json',
        success:function(data){
            foreach(data as dat){
                $("#unidad"+indice).val(data.medida);
                $("#disponible"+indice).val(data.disponible);
            }
        }
      
    });
    num++;
    $(".producto").select2();
});*/

$("#campass").click(function(){
  $("#formcampass").removeAttr('hidden');
  $("#botcampass").attr('hidden', 'hidden');
});

$("#cancelacampass").click(function(){
  $("#formcampass").attr('hidden', 'hidden');
  $("#botcampass").removeAttr('hidden');
});

$("#validarp").keyup(function(){
   if($("#validarp").val() != $("#nuevap").val()){
       $("#msgcodep").removeAttr('hidden');
   }
   else{
       $("#msgcodep").attr('hidden','hidden');
   }
});

$(".despachado").keyup(function(){
   var des = this.id;
   var indice = des.substr(-1);
    if($("#"+des).val()>$("#solicitado"+indice).val()){
        alert('No puede despachar mas de lo solicitado');
        $("#"+des).val('0');
    } 
});


$(".table").DataTable( {
        "bFilter" : true, 
        "order": [[ 0, "desc" ]],
            "sPaginationType" : "full_numbers", 
            "aoColumnDefs" : [{"bVisible" : true, "aTargets" : [0]}], 
            "aLengthMenu" : [[10, 25, 50,  - 1], [10, 25, 50, "Todos"]], 
            "oLanguage" : {
                "sSearch" : "Buscar",
                "sLengthMenu" : "Registros _MENU_", 
                "sZeroRecords" : "No existe registros.", 
                "sInfo" : "Mostrando _START_ al _END_ de _TOTAL_ registros", 
                "sInfgetoEmpty" : "Mostrando 0 al 0 de 0 registros", 
                "sProcessing" : "Cargando registros",
                "sEmptyTable" : "No existe registros para mostrar",
                "sInfoEmpty": "",
                "sInfoFiltered": "",
                "oPaginate" : {
                    "sNext" : "&raquo;", "sPrevious" : "&laquo;", "sFirst" : "Primero", "sLast" : "Último"
                }
            },
        dom: '<"top"f>Blrt<"bottom"ip><"clear">',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Excel',
                title: 'Sistema SWAN'
            }
            /*{
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                titleAttr: 'PDF',
                columns: [0,1],
                title: 'Sistema de Administración de Almacenes'
            },
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copiar'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Imprimir'
            }*/
        ]
    } );

    var oTable = $("#ingresostable").dataTable();
    var selectedValue = $("#vigente").val();
    oTable.fnFilter("^"+selectedValue+"$", 7, true);
    
    $("#inventario").val(selectedValue);

  $("#inventario").change(function(){
      var oTable = $("#ingresostable").dataTable();
      var selectedValue = $(this).val();
      oTable.fnFilter("^"+selectedValue+"$", 7, true);
  });
  
    $("#ir").click(function(){
        var oTable = $("#ingresostable").dataTable();
        var fecha = $("#fecha").val();
        oTable.fnFilter(fecha,1);
    });

    //$("#form_venta").submit(function(ev){
    $("input,select").keypress(function(e){
        if(e.which == 13) {
            if($("#pagado").val()==0)
                $("#pagado").focus().select();
        }
    });
    
    $("#pagado").keypress(function(e){
       if(e.which == 13){
           $("#guardaVenta").click();
       } 
    });
    
    $("#guardaVenta").click(function(){
        //ev.preventDefault(); // to stop the form from submitting
        /* Validations go here */
        if($("#total").val() == 0){
            swal({
              title: "ATENCIÓN",
              text: "Esta transacción requiere autorización",
              type: "input",
              inputType: "password",
              showCancelButton: true,
              cancelButtonText: "Cancelar",
              closeOnConfirm: false,
              animation: "slide-from-top",
              inputPlaceholder: "Código de autorización"
            },
            function(inputValue){
              if (inputValue === false) return false;
              
              if (inputValue === "") {
                swal.showInputError("Se requiere un código para validar");
                return false
              }
              else{
                    $.ajax({
                        url: '/usuario/show',
                        data: {id: inputValue},
                        type: 'GET',
                        dataType: 'json',
                        success:function(data){
                            if(data.res == "OK"){
                                swal("OK!", "Código validado", "success");
                                $("#form_venta").submit();
                            }
                            else{
                                swal("ERROR!", "Lo siento, el código no es valido", "warning");
                                return false;
                            }
                        }
                      
                    });
              }
              
              
            });    
        }
        else{
            $("#form_venta").submit();
        }
    });
    
    $("#codigor").change(function(){
        var indice = $("#codigor").val();
        $.ajax({
            url: '/producto/show',
            data: {id: indice},
            type: 'GET',
            dataType: 'json',
            success:function(data){
                $("#descripcionr").val(data.descripcion);
                $("#cantidad").focus().select();
            }
        }); 
       
    });

});