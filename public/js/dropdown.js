$(document).ready(function(){
  $(document).on('change','#specialty',function(){
    var especialidad_id=$(this).val();
    var div=$(this).parent();
    var op=" ";

    console.log(especialidad_id);
    $.ajax({
      type:'get',
      url: '{!!URL::to('ficha/getMedicos')!!}',
      data:{'id':especialidad_id},
      dataType: 'json',
      success:function(data){
        console.log('success');
        console.log(data);

        console.log(data.length);
        $('#medicos').empty();
        op+='<option value="0" selected disabled>Seleccione un Médico</option>';
        for(var i=0;i<data.length;i++){
          op+='<option value="'+data[i].id+'">'+data[i].nombres+'</option>';
        }
        $("#medicos").append(op);

      },
      error:function(){
      }
    });
  });
});
