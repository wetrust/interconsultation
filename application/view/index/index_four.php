<div class="container">
    <h1 class="my-2">Bienvenido: Jefe de Institución</h1>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <?php if ($this->institucion) { ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col">
                    <label>Nombre de la institucion:</label>
                    <input disabled type="text" class="form-control" value="<?php echo htmlentities($this->institucion->institucion_text); ?>">
                </div>
                <div class="form-group col">
                    <label>Jefe:</label>
                    <input disabled type="text" class="form-control" value="<?php echo htmlentities($this->institucion->user_name); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="<?= Config::get('URL') . 'index/usuarios' ?>">Añadir usuario a institucion</a>
            </li>
        </ul>
        <div class="form-inline">
            <label class="mr-1"><i class="fa fa-search" aria-hidden="true"></i></label>
            <input class="form-control" id="busqueda" type="text" placeholder="Buscar..">
        </div>
    </div>
        <?php if ($this->usuarios_institucionales) { ?>
            <table class="table table-bordered mt-2">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="tableUsuarios">
                    <?php foreach($this->usuarios_institucionales as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->user_name); ?></td>
                        <td><?= htmlentities($value->user_email); ?></td>
                        <td><?= htmlentities($value->rol_name); ?></td>
                        <td><button class="btn btn-danger descartar" data-user="<?= htmlentities($value->user_id); ?>">Desvincular</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info mt-2" role="alert">No tiene usuarios institucionales.</div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-info mt-2" role="alert">Usted no tiene departamentos a su cargo, informe al administrador.</div>
    <?php } ?>
</div>
<?php if ($this->institucion) { ?>
<script>
$(document).ready(function(){
  $("#busqueda").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableUsuarios tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $(".descartar").on("click", function() {
    var value = {
        institucion_id: <?php echo htmlentities($this->institucion->institucion_id); ?>,
        user_id: $(this).data("user")
    };

    $.post("/index/usuarios_remove", value).done(function(){
        location.reload();
    });
  });
});
</script>
<?php } ?>
