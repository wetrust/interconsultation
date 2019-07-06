<div class="container">
    <h1>Administración de plataforma</h1>
    <?php $this->renderFeedbackMessages(); ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-instituciones-tab" data-toggle="tab" href="#nav-instituciones" role="tab" aria-controls="nav-instituciones" aria-selected="true">Instituciones</a>
            <a class="nav-item nav-link" id="nav-usuarios-tab" data-toggle="tab" href="#nav-usuarios" role="tab" aria-controls="nav-usuarios" aria-selected="false">Usuarios</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-instituciones" role="tabpanel" aria-labelledby="nav-instituciones-tab">
            <div class="d-flex justify-content-between mt-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= Config::get('URL') . 'admin/instituciones/new' ?>">Nueva Institucion</a>
                    </li>
                </ul>
                <div class="form-inline">
                    <label class="mr-1"><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input class="form-control" id="busqueda" type="text" placeholder="Buscar..">
                </div>
            </div>
        <?php if ($this->instituciones) { ?>
            <table class="table table-bordered mt-2">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre institucion</th>
                        <th>Jefe</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody id="tableInstituciones">
                    <?php foreach($this->instituciones as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->institucion_text); ?></td>
                        <td><?= htmlentities($value->user_name); ?></td>
                        <td><a href="<?= Config::get('URL') . 'admin/instituciones/view/' . $value->institucion_id; ?>">Ver</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info mt-2" role="alert">No tiene instituciones. ¡Crea una!</div>
        <?php } ?>
        </div>
        <div class="tab-pane fade" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab">
            <div class="d-flex justify-content-between mt-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Nuevo Usuario</a>
                    </li>
                </ul>
                <div class="form-inline">
                    <label class="mr-1"><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input class="form-control" id="busquedaUsuarios" type="text" placeholder="Buscar..">
                </div>
            </div>
        <?php if ($this->usuarios) { ?>
            <table class="table table-bordered mt-2">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody id="tableUsuarios">
                    <?php foreach($this->usuarios as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->user_name); ?></td>
                        <td><?= htmlentities($value->user_email); ?></td>
                        <td><?= htmlentities($value->rol_name); ?></td>
                        <td><button class="btn btn-danger descartar" data-user="<?= htmlentities($value->user_id); ?>">Eliminar Usuario</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info mt-2" role="alert">No tiene instituciones. ¡Crea una!</div>
        <?php } ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#busqueda").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableInstituciones tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  $("#busquedaUsuarios").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableUsuarios tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $(".descartar").on("click", function() {
    $.get("/admin/usuarios/delete/" + $(this).data("user")).done(function(){
        location.reload();
    });
  });
});
</script>