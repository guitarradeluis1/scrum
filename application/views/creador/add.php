<div id="body">
<?php echo anchor($controlador."/index", "Atras.", "class='btn btn-outline-danger'"); ?>
<?php echo form_open($controlador."/".$funcion, "id=formulario"); ?>
<div class="card">
	<div class="card-body">
		<table>
		<tr>
			<td>
				<p><b>Nombre : </b><br /> 
				<?php echo form_input(array("name" => "nombre", "id" => "nombre", "placeholder" => "nombre", "type" => "text", "class"=>"form-control form-control-sm", "value" => "")); ?>
				</p>
			</td>
		</tr>
		</table>
		<?php echo form_submit("post", "Enviar", "class='btn btn-success'"); ?>
		<?php echo form_close(); ?>
		<br />
	</div>
</div>
</div>
<?php #echo "<pre>"; print_r($credores); echo "</pre>"; ?>
<script>
jQuery(document).ready(function()
{
  	//.................................
    $("#formulario").validate({
        // Specify the validation rules
        rules: {
            nombre: "required"
        },
        
        // Specify the validation error messages
        messages: {
            
        },
        
        submitHandler: function(form){
            form.submit();
        }
    });
    //.................................
});
</script>