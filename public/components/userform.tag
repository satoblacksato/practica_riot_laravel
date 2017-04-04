<user-form>
<div class="modal fade" tabindex="-1" role="dialog" id="userForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{title}</h4>
      </div>
     

      <div class="modal-body" >
       <div class="form-group">
        		<select id="users" class="form-control" onchange="{viewUser}" >
                    <option each={users} value="{id}">{name}</option>
                </select>
       </div>
       		<div if="{!load}">
       			cargando informacion
       		</div>
      		<div if="{load}">
	      		<input type="hidden" id="id" value="{id}"/>
	        	<div class="form-group">
	        		<input type="text" name="user" id="user" value="{model.name}" placeholder="usuario" class="form-control" />
	        	</div>
	        	<div class="form-group">
	        		<input type="text" name="email" id="email" value="{model.email}" placeholder="email" class="form-control" />
	        	</div>
	        	<div class="form-group">
	        		<input type="password" name="password" id="password" if="{action=='guardar'}" placeholder="password" class="form-control" />
	        	</div>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="{guardar}" if="{action=='guardar'}">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	var self=this;
	self.model=[];
	self.id=opts.id;
	self.action=opts.action;
	self.load=false;
	users();
	
	if(self.action=='guardar'){
		self.title="Actualizar/Crear Usuarios";
	}else{
		self.title="Ver Usuario";
	}


	if(self.id!='0'){
		getUser(self.id);
	}


	self.on('mount',function() {
		$("#userForm").modal();
	});


	function getUser(id){
		
			var _url="/users/"+id+"/edit";
			if(self.action!='guardar'){
				_url="/users/"+id;	
			}
		self.load=false;
		$.ajax({
			url:_url,
			type:'GET',
			dataType:'json',
			success: function(result){
				self.model=result;
				self.id=result.id;
				self.load=true;
				self.update();
				if(self.action=='view'){
				$('#user').attr('readonly', 'readonly');
				$('#email').attr('readonly', 'readonly');
			
			}

			},
			error:function(result){
				alert("Error de procesamiento "+result.status+ "\n"+result.statusText);
			}
		});
	}

	function users(){
		$.ajax({
			url:"/userselect",
			type:'GET',
			dataType:'json',
			success: function(result){
				self.users=result;
				self.update();
				$("#users").val(self.id);
			},
			error:function(result){
				alert("Error de procesamiento "+result.status+ "\n"+result.statusText);
			}
		});
	}


	viewUser(){
		getUser($("#users").val());

	}

	guardar(){
			var _url="/users";
			var method='POST';
			if(self.id!='0'){
				_url="/users/"+self.id;	
				method='PUT';
			}





			$.ajax({
					url:_url,
					data:{
						name:$("#user").val(),
						email:$("#email").val(),
						password:$("#password").val(),
						_method:method
					},
					type:'POST',
					dataType:'json',
					success:function(result){
						window.location.reload(true);
					},
					error:function(objectError){

						if( objectError.status == 422 ) {
								        errors = objectError.responseJSON;
								        var errores="";
								        $.each( errors, function( key, value ) {
								            errores += value[0]+"\n";
								        });

								        if(errores.trim()!=""){
								        		alert(errores);
								        }
						}else{
							alert("Error de procesamiento "+objectError.status+ "\n"+objectError.statusText);
						}
					}
				});
	}
</script>


</user-form>