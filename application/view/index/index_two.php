<div class="container">
    <h1>Bienvenido Mesa central</h1>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <?php if ($this->instituciones) { ?>
    <div class="d-flex justify-content-between mt-3">
        <div class="form-inline">
            <label class="mr-1">Institución</label>
            <select class="form-control" name="institucion_id">
            <?php foreach($this->instituciones as $key => $value) { ?>
                <option value="<?php echo $value->institucion_id; ?>"><?php echo $value->institucion_text;?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-inline">
            <label class="mr-1"><i class="fa fa-search" aria-hidden="true"></i></label>
            <input class="form-control" id="busqueda" type="text" placeholder="Buscar..">
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Solicitar Interconsulta</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Interconsultas recibidas</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div id="formulario.solicitud"> <div class="row m-0"> <div class="col-12 bg-primary py-3"> <h4 class="text-white text-center">Formulario de referencia para evaluación ecográfica gineco - Obstétrica</h4></div><div class="col form-group"> <label>Nombre del paciente</label> <input type="text" class="form-control" id="interconsulta.nombre"> </div><div class="col form-group"> <label>RUT del paciente</label> <input type="text" class="form-control" id="interconsulta.rut"> </div><div class="col form-group"> <label>Teléfono</label> <input type="number" class="form-control" id="interconsulta.telefono" value="999999999"> </div></div><div class="row m-0"> <div class="col form-group"> <label>Fecha de solicitud del exámen</label> <input type="date" class="form-control" id="interconsulta.fecha"> </div><div class="col form-group"> <label class="d-block">Ege conocida precozmente</label> <div class="form-check form-check-inline"> <input type="radio" id="interconsulta.eg.si" value="1" name="interconsulta_eg" class="form-check-input"> <label class="form-check-label">Si</label> </div><div class="form-check form-check-inline"> <input type="radio" id="interconsulta.eg.no" value="0" name="interconsulta_eg" class="form-check-input" checked=""> <label class="form-check-label">No</label> </div></div><div class="col form-group"> <label class="d-block">Ecografía previa de crecimiento</label> <div class="form-check form-check-inline"> <input type="radio" id="interconsulta.eco.si" value="1" name="interconsulta_eco" class="form-check-input"> <label class="form-check-label">Si</label> </div><div class="form-check form-check-inline"> <input type="radio" id="interconsulta.eco.no" value="0" name="interconsulta_eco" class="form-check-input" checked=""> <label class="form-check-label">No</label> </div></div></div><div class="row m-0"> <div class="col form-group"> <label>FUM operacional</label> <input type="date" class="form-control" id="interconsulta.fum"> </div><div class="col-2 form-group"> <label>Edad Gestacional</label> <input type="text" class="form-control" id="interconsulta.egestacional" disabled=""> </div><div class="col form-group"> <label>Diagnóstico de referencia 1</label> <select class="form-control" id="interconsulta.diagnostico.select"> <option value="Referido por" selected>Referido por</option> <option value="Patología 1° trimestre">Patología 1° trimestre</option> <option value="Patología 2° trimestre">Patología 2° trimestre</option> <option value="Patología 3° trimestre">Patología 3° trimestre</option> <option value="No señalado">No señalado</option> </select> </div><div class="col form-group"> <label>Diagnóstico de referencia2</label> <input type="text" class="form-control" id="interconsulta.diagnostico"> </div></div><div class="row m-0"> <div class="col form-group"> <label>Ciudad procedencia de la paciente</label> <input type="text" class="form-control" id="interconsulta.ciudad"> </div><div class="col form-group"> <label>Lugar de control prenatal</label> <input type="text" class="form-control" id="interconsulta.lugar"> </div></div><h5>Datos profesional referente a exámen ecográfico</h5> <div class="row m-0"> <div class="col form-group"> <label>Nombre del profesional</label> <input type="text" class="form-control" name="interconsulta_de_nombre" value="<?php echo Session::get("user_name"); ?>" disabled> </div><div class="col form-group"> <label>Email (profesional referente)</label> <input type="email" class="form-control" name="interconsulta_de" value="<?php echo Session::get("user_email"); ?>" disabled> </div></div><div class="row m-0"> <div class="col form-group"> <label><strong>Seleccione institución</strong></label><select class="form-control" id="interconsulta.para"><?php foreach($this->solicitar_instituciones as $key => $value) { ?><option value="<?php echo $value->institucion_id; ?>"><?php echo $value->institucion_text;?></option><?php } ?></select></div></div><div class="row"> <div class="col"> <button class="btn btn-primary" id="interconsulta.enviar">Enviar solicitud de exámen ecográfico</button> </div></div></div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Lugar de control</th>
                                <th>Motivo</th>
                                <th>Solicitada</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($this->interconsultas) { ?>
                        <?php foreach($this->interconsultas as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->solicitud_nombre); ?></td>
                        <td><?= htmlentities($value->solicitud_ciudad); ?></td>
                        <td><?= htmlentities($value->solicitud_lugar); ?></td>
                        <td><?= htmlentities($value->solicitud_diagnostico); ?></td>
                        <td><?= htmlentities($value->solicitud_fecha); ?></td>
                        <td><button class="btn btn-primary">Ver</a></td>
                    </tr>
                    <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="alert alert-info mt-2" role="alert">Usted no pertenece a una institución, informe al jefe de su institución.</div>
    <?php } ?>
</div>
<script src="<?php echo Config::get('URL'); ?>/js/textos.js"></script>
<script src="<?php echo Config::get('URL'); ?>/js/jquery.rut.chileno.min.js"></script>
<script>
$(document).ready(function(){
$("#interconsulta\\.fum").on("change", function(){
		var FExamen, FUM, EdadGestacional;
		var undia = 1000 * 60 * 60 * 24;
		var unasemana = undia * 7;

		FUM = $("#interconsulta\\.fum").val();
		FExamen = $("#interconsulta\\.fecha").val();

		FUM = new Date (FUM);
		FExamen = new Date (FExamen);

		EdadGestacional = ((FExamen.getTime() - FUM.getTime()) / unasemana).toFixed(1);

		if (FExamen.getTime() < FUM.getTime()) {
			$('#interconsulta\\.egestacional').val("0 semanas");
		}
		else if (((FExamen.getTime() - FUM.getTime()) / unasemana) > 42) {
			$('#interconsulta\\.egestacional').val("42 semanas");
		}
		else {
			$('#interconsulta\\.egestacional').val(Math.floor(EdadGestacional) + "." + Math.round((EdadGestacional - Math.floor(EdadGestacional))*7) + " semanas");
		}

    });

    $('#interconsulta\\.rut').rut({
        fn_error : function(input){
            $(input).removeClass("is-valid").addClass("is-invalid");
            input.closest('.rut-container').find('span').remove();
            input.closest('.rut-container').append('<span class="invalid-feedback">Rut incorrecto</span>');
        },
        fn_validado : function(input){
            $(input).removeClass("is-invalid").addClass("is-valid");
            input.closest('.rut-container').find('span').remove();
            input.closest('.rut-container').append('<span class="valid-feedback">Rut correcto</span>');
        },
        placeholder: false
    });

    $("#interconsulta\\.enviar").on("click", function(){
		var listo = false;
		//revisar si el usuario lleno todas las cajas
		var nombre = String($("#interconsulta\\.nombre").val());
		var rut = String($("#interconsulta\\.rut").val());
		var fecha = String($("#interconsulta\\.fecha").val());
		var telefono = String($("#interconsulta\\.telefono").val());
		var eg = String($('input[name=interconsulta_eg]:checked').val());
		var eco = String($('input[name=interconsulta_eco]:checked').val());
		var fum = String($("#interconsulta\\.fum").val());
		var diagnostico = String($("#interconsulta\\.diagnostico\\.select").val());
		var lugar = String($("#interconsulta\\.lugar").val());
		var ciudad = String($("#interconsulta\\.ciudad").val());
		var egestacional = String($("#interconsulta\\.egestacional").val());
		var para = String($("#interconsulta\\.para").val());
        
        var baseModal = '<div class="modal" tabindex="-1" role="dialog" id="cautivo.dialogo"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header">';
        var footerModal = '</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div></div></div></div>';
        
        if (nombre.length < 3 || rut.length < 4 || telefono.length < 6 || fecha.length < 4 || eg == 'undefined' || eg.length < 1 || eco == 'undefined' || eco.length  < 0 || fum.length < 4 || diagnostico.length  < 3 || ciudad.length < 2 || lugar.length  < 3 || egestacional.length < 3){
            var mensaje = "";

            if (nombre.length < 3){
                mensaje = textos.paciente_name_error;
            }else if (rut.length < 4){
				mensaje = textos.paciente_rut_error;
			}else if (telefono.length < 6){
                mensaje = textos.telefono_error;
            }else if (fecha.length < 4){
                mensaje = textos.form_error;
            }else if (eg == 'undefined' || eg.length < 1){
                mensaje = textos.eg_error;
            }else if (eco == 'undefined' || eco.length  < 0){
                mensaje = textos.eco_previa_error;
            }else if (fum.length < 4){
                mensaje = textos.fur_error;
            }else if (diagnostico.length  < 3){
                mensaje = textos.diagnostico_referencia_error;
            }else if (ciudad.length < 2){
                mensaje = textos.procedencia_error;
            }else if (lugar.length  < 3){
                mensaje = textos.lugar_control_error;
            }else if (egestacional.length < 3){
                mensaje = textos.fechas_error;
            }

            $('body').append(baseModal + '<h5 class="modal-title">' + textos.form_error+'</h5></div><div class="modal-body"><p>'+ mensaje+'</p>'+ footerModal);
            $('#cautivo\\.dialogo').modal("show").on('hidden.bs.modal', function (e) { $(this).remove(); });
            return;
        } else{
            listo = true;
        }

		if (listo == true){
			$('#interconsulta\\.enviar').prop("disabled", true);
			var eLdiagnostico = $("#interconsulta\\.diagnostico\\.select").val() + ", "+ $("#interconsulta\\.diagnostico").val();

			var data = {
                a: $("#interconsulta\\.para").val(),
				b: $("#interconsulta\\.nombre").val(),
				c: $("#interconsulta\\.rut").val(),
				d: $("#interconsulta\\.telefono").val(),
				e: $("#interconsulta\\.fecha").val(),
				f: $('input[name=interconsulta_eg]:checked').val(),
				g: $('input[name=interconsulta_eco]:checked').val(),
                h: $("#interconsulta\\.fum").val(),
                i: $("#interconsulta\\.egestacional").val(),
                j: eLdiagnostico,
                k: $("#interconsulta\\.ciudad").val(),
				l: $("#interconsulta\\.lugar").val(),
			};
			$('body').append(baseModal + textos.form_send + '</h5></div><div class="modal-body"><p>Enviando solicitud de interconsulta, por favor espere</p><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div></div></div></div></div>');
			$('#cautivo\\.dialogo').modal("show");
		
			$.post("<?php echo Config::get('URL'); ?>index/solicitar_interconsulta", data).done(function(response){
				if (response.result == false){
					$('body').append('<div class="modal" tabindex="-1" role="dialog" id="mensaje.dialogo"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">ERROR</h5></div><div class="modal-body"><p>Usted NO puede solicitar interconsulta para este profesional</p>'+ footerModal);
				}
				else if (response.result == true){
					$('body').append('<div class="modal" tabindex="-1" role="dialog" id="mensaje.dialogo"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Información</h5></div><div class="modal-body"><p>Su Solicitud de interconsulta ha sido enviada correctamente</p>'+ footerModal);
					$("#interconsulta\\.nombre").val("");
					$("#interconsulta\\.rut").val("");
					$("#interconsulta\\.telefono").val("");
					var now = new Date();
					var day = ("0" + now.getDate()).slice(-2);
					var month = ("0" + (now.getMonth() + 1)).slice(-2);
					var today = now.getFullYear()+"-"+(month)+"-"+(day);
					$("#interconsulta\\.fecha").val(today);
					$("#interconsulta\\.eg\\.no").attr("checked", true);
					$("#interconsulta\\.eco\\.no").attr("checked", true);
					$("#interconsulta\\.fum").val(today).trigger("change");
					$("#interconsulta\\.diagnostico\\.select").val(0);
					$("#interconsulta\\.diagnostico").val("");
					$("#interconsulta\\.lugar").val("");
					$("#interconsulta\\.ciudad").val("");
				}
                $('#mensaje\\.dialogo').modal("show").on('hidden.bs.modal', function (e) {
                    $('#cautivo\\.dialogo').modal("hide").remove();
                    $(this).remove();
                    $('#interconsulta\\.enviar').prop("disabled", false);
                    location.reload();
                });
			});
		}
    });

    var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	$("#interconsulta\\.fecha").val(today);
});
</script>
