$(function () {

    var token = $('meta[name="csrf-token"]').attr('content');
    $("#data_nascimento").mask("00/00/0000");    
    $("#cpf").mask("000.000.000-90");

    $(".date").each(function(){
        var data = $(this).html();
        data = data.split("-").reverse().join("/");
        
        $(this).html(data);        
    });    

    $("#btnCreate").on("click", function(){
        
        var form = new Object();
        
        $("#form_create .form-control").each(function(){
            if($(this).val() == ""){
                if($(this).attr('id') != 'id'){
                    alert("Favor preencher o campo: "+$(this).attr('name'));
                    return false;
                }    
            }
            form[$(this).attr('id')] = $(this).val();
        });

        if(form['senha'] != form['senha_aux']){
            alert("As senhas nao batem");
            return false;
        }        
        
        if(form['id'] == '') url = 'create';
        else url = 'update';

        delete form.senha_aux;        

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url: url,
            data:form,
            method:'POST',
            dataType:'json'
          }).done(function(ret){              
              alert("Usuario cadastrado com sucesso");
              if(ret.id && $("#file").val() != ""){                  
                  upload(ret.id);
              }
              //window.location.reload();
          }).error(function(ret){              
            if(ret.responseJSON.errors){
                $.each(ret.responseJSON.errors, function(i, item){
                    alert(i + " ja cadastrado");
                });
                return false;
              }  
          });
        
        
        return false;
    });

    $(".btnView").on("click", function(){
        var id = $(this).attr('id');

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'get/'+id,            
            method:'GET',
            dataType:'json'
        }).done(function(ret){  
              if(ret.user){
                $.each(ret.user, function(i, item){
                    $("#"+i).val(item);
                    $("#"+i).attr("readonly",true);                    
                });
                $("#divImg").html("<img src='http://localhost:8080/public/api/storage/"+id+".jpg");                                
                $("#senha_aux").parent().hide();
                $("#btnCreate").hide(); 
                $("#create-modal").modal();
              }
        });
        return false;
    });

    $(".btnEdit").on("click", function(){
        var id = $(this).attr('id');

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'get/'+id,            
            method:'GET',
            dataType:'json'
        }).done(function(ret){  
              if(ret.user){
                $.each(ret.user, function(i, item){
                    $("#"+i).val(item);
                    $("#"+i).attr("readonly",false);
                });

                $("#divImg").html("<img src='http://localhost:8080/public/api/storage/"+id+".jpg");                                
                $("#btnCreate").show();
                $("#senha_aux").parent().show();
                $("#senha_aux").val($("#senha").val());
                $("#create-modal").modal();
              }
        });
        return false;
    });

    $("#btnNew").on("click", function(){
        $('#form_create .form-control').each(function(){
            $(this).val('');
        });
    });

});

function upload(id){
    var data = new FormData();
    $.each($('#file')[0].files, function(i, file) {
        data.append('img', file);
    });
    data.append('id', id);
    console.log(data);

    $.ajax({
        url: 'http://localhost:8080/public/api/upload',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',            
        success: function(data){           
            $("#divImg").html("<img src='"+data+"' />");
        }
    });
}