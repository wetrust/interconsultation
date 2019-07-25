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
                        <tbody>
                        <?php if ($this->interconsultas) { ?>
                        <?php foreach($this->interconsultas as $key => $value) { ?>
                            <tr>
                                <td><?= htmlentities($value->solicitud_nombre); ?></td>
                                <td><?= htmlentities($value->solicitud_telefono); ?></td>
                                <td><?= htmlentities($value->solicitud_ciudad); ?></td>
                                <td><?= htmlentities($value->solicitud_diagnostico); ?></td>
                                <td><button class="btn btn-primary descartar" data-user="<?= htmlentities($value->user_id); ?>">Ir a exámen</a></td>
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
});
</script>
