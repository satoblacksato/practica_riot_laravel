$(document).on('click','.pagination a',function(e){
	e.preventDefault();
	$.ajax({
		url:"/users",
		data:{page: $(this).attr('href').split('page=')[1],scope:$("#scope").val()},
		type:'GET',
		dataType:'json',
		success:function(result){
			$("#divTable").html(result);
		},
		error:function(result){
			alert(result.status+': '+result.statusText);
		}
	});
});


$(document).on('click','#btnBuscar',function(e){
	$.ajax({
		url:"/users",
		data:{scope: $("#scope").val()},
		type:'GET',
		dataType:'json',
		success:function(result){
			$("#divTable").html(result);
		},
		error:function(result){
			alert(result.status+': '+result.statusText);
		}
	});
});


$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
});


 function createOrUpdate(_id){
         riot.mount('user-form', {id:_id,action:'guardar'}); 
 }

$(document).on('click','.table td>button',function(e){
	  riot.mount('user-form', {id:$(this).data('id'),action:$(this).data('action')}); 
});
