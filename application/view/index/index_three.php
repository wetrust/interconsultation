<div class="container">
    <h1>Bienvenido Profesional Ecografista</h1>
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
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Interconsultas en espera</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Interconsultas resueltas</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Ciudad</th>
                                <th>Motivo de exámen</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="tableEsperas">
                        <?php if ($this->interconsultas) { ?>
                        <?php foreach($this->interconsultas as $key => $value) { ?>
                            <tr>
                                <td><?= htmlentities($value->solicitud_nombre); ?></td>
                                <td><?= htmlentities($value->solicitud_telefono); ?></td>
                                <td><?= htmlentities($value->solicitud_ciudad); ?></td>
                                <td><?= htmlentities($value->solicitud_diagnostico); ?></td>
                                <td><button class="btn btn-primary examen" data-user="<?= htmlentities($value->user_id); ?>" data-examen="<?= htmlentities($value->solicitud_id); ?>">Ir a exámen</a></td>
                            </tr>
                        <?php }} else { ?>
                            <div class="alert alert-info mt-2" role="alert">No tiene usuarios institucionales.</div>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table class="table table-bordered mt-2">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Lugar de control</th>
                                <th>Tipo de exámen</th>
                                <th>Realizado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
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
<script>
$(document).ready(function(){
    $("button.examen").on("click", function(){
        var user = $(this).data("user");
        var examen = $(this).data("examen");
        createCarcasaExamen();
        cargarExamenEcografico(examen, user);
    });

});

function createCarcasaExamen(){
    var footerModal = '</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div></div></div></div>';
    $('body').append('<div class="modal" tabindex="-1" role="dialog" id="mensaje.dialogo"> <div class="modal-dialog modal-lg" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title">Exámen</h5></div><div class="modal-body"><div class="row" id="contenedorInterconsulta"><div class="progress col-12 my-4"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><strong>CARGANDO</strong></div></div></div>'+ footerModal);
    $('#mensaje\\.dialogo').modal("show").on('hidden.bs.modal', function (e) {
        $('#mensaje\\.dialogo').remove();
    });
}

function cargarExamenEcografico(examen, user){
    $.get("<?php echo Config::get('URL'); ?>index/interconsulta/" + examen).done(function(data){
        $('#contenedorInterconsulta')empty().append('<div class="card-header g-verde" id="headingOne"> <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Datos de la interconsulta</button></div><div id="collapseOne" class="collapse border " aria-labelledby="headingOne" data-parent="#ver\\.interconsulta\\.contenedor"> <div class="card-body"><input type="hidden" id="a"><div class="col-4"> <label><small>Nombre del paciente:</small></label> <p id="b"></p></div><div class="col-4"> <label><small>RUT del paciente:</small></label> <p id="c"></p></div><div class="col-4"> <label><small>Teléfono:</small></label> <p id="d"></p></div><div class="col-4"> <label><small>Fecha de solicitud:</small></label> <p id="e"></p></div><div class="col-4"> <label><small>FUM operacional</small></label> <p id="f"></p></div><div class="col-4"> <label><small>Edad Gestacional</small></label> <p id="g"></p></div><div class="col-4 form-group"> <label><small>Ege conocida precozmente</small></label> <p id="h"></p></div><div class="col-4 form-group"> <label><small>Ecografía previa de crecimiento</small></label> <p id="i"></p></div><div class="col-4 form-group"> <label><small>Diagnóstico de referencia</small></label> <p id="j"></p></div><div class="col-4 form-group"> <label><small>Ciudad procedencia de la paciente</small></label> <p id="k"></p></div><div class="col-4 form-group"> <label><small>Lugar de control prenatal</small></label> <p id="l"></p></div><div class="col-4 form-group"> <label><small>Nombre del profesional referente:</small></label> <p id="ll"></p></div><div class="col-4 form-group"> <label><small>Email (de trabajo):</small></label> <p id="m"></p></div><div class="col-8 form-group"> <label><small>Estado de interconsulta:</small></label> <p id="n"></p></div></div></div></div>');
        $("#contenedorInterconsulta").append('<h5 class="my-3 text-primary text-center">Contrarreferencia inicial desde unidad de ultrasonografía gineco-obstétrica</h5><div class="row g-verde mb-0"> <div class="col form-group"> <label class="text-white"><strong>Seleccione tipo exámen</strong></label> <select class="form-control" name="solicitud_crecimiento" id="interconsulta.respuesta.crecimiento"> <option value="1">1.- Ecografía precoz de urgencia</option> <option value="4">2.- Ecografía 11/14 semanas</option> <option value="2">3.- Ecografía 2° / 3° trimestre</option> <option value="0" selected>4.- Doppler + Eco. crecimiento</option> <option value="3">5.- Ecografía Ginecológica</option> </select> </div><div class="col form-group mb-2"> <label for="interconsulta.respuesta.fecha"><strong class="text-white">Señalar fecha de examen</strong></label> <input type="date" class="form-control" id="interconsulta.respuesta.fecha"> </div><div class="col form-group" id="interconsulta.respuesta.edadgestacional"> <label for="interconsulta.respuesta.eg" class="text-white">Edad gestacional actual</label> <input type="hidden" class="form-control" id="interconsulta.fum.copia" value="solicitud_fum"> <input type="text" class="form-control" id="interconsulta.respuesta.eg" disabled=""> <input type="hidden" class="form-control" name="respuesta_eg"> </div></div>');
        $("#contenedorInterconsulta").append('<div id="contenedor.examenes"><div id="multiproposito"> <div class="row"> <div class="col form-group"> <label>Feto en presentación</label> <select class="form-control" name="respuesta_presentacion"> <option value="cefálica">Cefálica</option> <option value="podálica">Podálica</option> <option value="transversa">Transversa</option> <option value="indiferente">Indiferente</option> </select> </div><div class="col form-group"> <label>Dorso fetal</label> <select class="form-control" name="respuesta_dorso"> <option value="anterior">Anterior</option> <option value="lat. izquierdo">Lateralizado izquierdo</option> <option value="posterior">Posterior</option> <option value="lat. derecho">Lateralizado derecho</option> </select> </div><div class="col-4 form-group"> <label>Sexo fetal</label> <select class="form-control" name="respuesta_sexo_fetal"> <option value="femenino" selected>femenino</option> <option value="masculino">masculino</option> <option value="aún no identificado">aún no identificado</option> </select> </div></div><div class="row"> <div class="col-4 form-group"> <label for="interconsulta.respuesta.ecografista">Placenta ubicación</label> <select class="form-control" name="respuesta_placenta"> <option value="normal" selected>normal</option> <option value="prev. lateral">prev. lateral</option> <option value="prev. marginal">prev. marginal</option> <option value="prev. parcial">prev. parcial</option> <option value="prev. total">prev. total</option> </select> </div><div class="col-4 form-group"> <label for="interconsulta.respuesta.ecografista">Placenta inserción</label> <select class="form-control" name="respuesta_placenta_insercion"> <option value="anterior" selected>anterior</option> <option value="posterior">posterior</option> <option value="fúndica">fúndica</option> <option value="lat. derecha">lat. derecha</option> <option value="lat. izquierda">lat. izquierda </option> <option value="segmentaria">segmentaria</option> </select> </div><div class="col form-group"> <label for="interconsulta.respuesta.liquido">Líquido amniótico</label> <select class="form-control" name="respuesta_liquido"> <option value="Normal">Normal</option> <option value="Pha leve">PHA leve</option> <option value="Pha severo">PHA severo</option> <option value="Oha leve">OHA leve</option> <option value="Oha severo">OHA severo</option> </select> </div></div><div class="row"> <div class="col-4 form-group"> <label>BVM (mm)</label> <input type="text" class="form-control" name="respuesta_bvm"> </div><div class="col-4 form-group"> <label> <br>Evaluación de anatomía fetal</label> </div><div class="col-4 form-group"> <label>&nbsp;</label> <select class="form-control" name="respuesta_anatomia"> <option value="de aspecto general normal">de aspecto general normal</option> <option value="hallazgos ecográficos compatibles con:">hallazgos ecográficos compatibles con:</option> </select> </div><div class="col-12 form-group d-none" id="interconsulta.respuesta.anatomia"> <input type="text" class="form-control" name="respuesta_anatomia_extra"> </div></div><div class="row"> <div class="col-12 form-group"> <label><strong>A.- Biometría ecográfica:</strong></label> </div></div><div class="row"> <div class="col form-group"> <label>DBP (mm)</label> <input type="text" class="form-control" name="respuesta_dbp"> </div><div class="col form-group"> <label>CC (mm)</label> <input type="text" class="form-control" name="respuesta_cc"> </div><div class="col form-group"> <label>CA (mm)</label> <input type="text" class="form-control" name="respuesta_ca"> </div><div class="col form-group"> <label>LF (mm)</label> <input type="text" class="form-control" name="respuesta_lf"> </div></div><div class="row"> <div class="col form-group"> <label>Peso fetal estimado</label> <input type="number" class="form-control" name="respuesta_pfe"> </div><div class="col form-group"> <label>&nbsp;</label> <div class="input-group mb-2"> <div class="input-group-prepend"> <div class="input-group-text">Pct</div></div><input type="text" class="form-control bg-secondary text-white" name="respuesta_pfe_pct" disabled> </div></div><div class="col form-group"> <label>Índice Cc/Ca</label> <input type="text" class="form-control" name="respuesta_ccca" disabled> </div><div class="col form-group"> <label>&nbsp;</label> <div class="input-group mb-2"> <div class="input-group-prepend"> <div class="input-group-text">Pct</div></div><input type="text" class="form-control" name="respuesta_ccca_pct" disabled> </div></div></div><div class="row"> <div class="col-6"> <div class="row"> <div class="col-12"><strong>B.- Flujometría Doppler</strong></div><div class="col-12 form-group"> <label>IP. Uterina derecha</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_uterina_derecha"> <div class="input-group-prepend"> <div class="input-group-text" id="respuesta_uterina_derecha_percentil"></div></div></div></div><div class="col-12 form-group"> <label>IP. Uterinas izquierda</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_uterina_izquierda"> <div class="input-group-prepend"> <div class="input-group-text" id="respuesta_uterina_izquierda_percentil"></div></div></div></div><div class="col-12 form-group"> <label>IP. Promedio uterinas</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_uterinas" disabled> <div class="input-group-prepend"> <div class="input-group-text bg-secondary text-white" id="respuesta_uterinas_percentil"></div></div></div></div></div></div><div class="col-6"> <div class="row"> <div class="col-12"><strong>&nbsp;</strong></div><div class="col-12 form-group"> <label>IP. Arteria umbilical</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_umbilical"> <div class="input-group-prepend"> <div class="input-group-text" id="respuesta_umbilical_percentil"></div></div></div></div><div class="col-12 form-group"> <label>IP. Cerebral media</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_cm"> <div class="input-group-prepend"> <div class="input-group-text" id="respuesta_cm_percentil"> </div></div></div></div><div class="col-12 form-group"> <label>Índice CM / AU</label> <div class="input-group mb-2"> <input type="text" class="form-control" name="respuesta_cmau" disabled> <div class="input-group-prepend"> <div class="input-group-text bg-secondary text-white" id="respuesta_cmau_percentil"> </div></div></div></div></div></div></div><div class="row"> <div class="col-12"> <p><strong>C.- Hipótesis diagnóstica</strong></p></div><div class="col-4 form-group"> <label><strong>Crecimiento fetal</strong></label> <select class="form-control" name="respuesta_hipotesis"> <option value="Disminuido < p3">Disminuido < p3</option> <option value="Disminuido < p10">Disminuido < p10</option> <option value="Normal p10 - p 25">Normal p10 - p 25</option> <option value="Normal p26 - p 75" selected>Normal p26 - p 75</option> <option value="Normal p76 - p90">Normal p76 - p90</option> <option value="Grande >p90">Grande >p90</option> <option value="Grande >p97">Grande >p97</option> </select> </div><div class="col form-group"> <label><strong>Doppler materno</strong></label> <select class="form-control" name="respuesta_doppler_materno"> <option value="no evaluado">No evaluado</option> <option value="Normal (< p95)" selected>Normal (&lt; p95)</option> <option value="Alterado (> p95)">Alterado (&gt; p95)</option> </select> </div><div class="col-5 form-group"> <label><strong>Doppler fetal</strong></label> <select class="form-control" name="respuesta_doppler_fetal" style="font-size: 0.75rem !important;"> <option value="Normal (UMB, ACM, ICP)">Normal (UMB, ACM e ICP)</option> <option value="Alterado, ICP < pct 5">Alterado, ICP &lt; pct 5</option> <option value="Alterado ICP < pct 5 y UMB > pct 95">Alterado ICP &lt; pct 5 y UMB &gt; pct 95</option> <option value="Alterado ccp < pct 5 acm < pct 5">Alterado ICP &lt; pct 5 ACM &lt; pct 5</option> <option value="Alt. ICP < pct 5 y ACM < pct 5 + UMB > p95">Alt. ICP &lt; pct 5 y ACM &lt; pct 5 + UMB &gt; p95</option> </select> </div></div></div></div>');
        $("#contenedorInterconsulta").append('<div id="final"><div class="row"> <div class="col form-group"> <label for="interconsulta.respuesta.comentariosexamen"><strong>D.- Comentarios y observaciones</strong></label> <textarea type="text" rows="2" class="form-control" name="respuesta_comentariosexamen" id="editable"></textarea> </div></div><div class="row"> <div class="col-6 form-group"> <label for="interconsulta.respuesta.ecografista">Ecografista</label> <input type="text" class="form-control" name="respuesta_ecografista"> </div></div></div>');

        $("#a").val(data.solicitud_id).data("estado", data.solicitud_estado);
        $("#b").html('<strong class="text-primary">'+data.solicitud_nombre+'</strong>');
        $("#c").html('<strong>'+data.solicitud_rut+'</strong>');
        $("#d").html('<strong class="text-primary">'+data.solicitud_telefono+'</strong>');
        $("#e").html('<strong class="text-primary">'+data.solicitud_fecha+'</strong>');
        $("#f").html('<strong class="text-primary">'+data.solicitud_fum+'</strong>');
        $("#g").html('<strong class="text-primary">'+data.solicitud_egestacional+'</strong>');
        data.solicitud_eg_conocida = (data.solicitud_eg_conocida == 1) ? "Si" : "No";
        data.solicitud_eco_previa = (data.solicitud_eco_previa == 1) ? "Si" : "No";
        $("#h").html('<strong>'+data.solicitud_eg_conocida+'</strong>');
        $("#i").html('<strong>'+data.solicitud_eco_previa+'</strong>');
        $("#j").html('<strong>'+data.solicitud_diagnostico+'</strong>');
        $("#k").html('<strong>'+data.solicitud_ciudad+'</strong>');
        $("#l").html('<strong>'+data.solicitud_lugar+'</strong>');
        $("#ll").html('<strong>'+data.user_name+'</strong>');
        $("#m").html('<strong>'+data.user_email+'</strong>');
        data.solicitud_estado = (data.solicitud_estado == 1) ? "Agendada, en espera de ser confirmada" : (data.solicitud_estado == 2) ? "Confirmada, en espera de ecografía" : "En espera, necesita ser agendada";
        $("#n").html('<strong class="text-primary">'+data.solicitud_estado+'</strong>');
    });
}
</script>
