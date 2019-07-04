<div class="container">
    <h1>Ver institucion</h1>
    <?php $this->renderFeedbackMessages(); ?>
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
                <a class="nav-link active" href="<?= Config::get('URL') . 'admin/instituciones/add/' . htmlentities($this->institucion->institucion_id); ?>">Añadir usuario a institucion</a>
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
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody id="tableInstituciones">
                    <?php foreach($this->usuarios_institucionales as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->user_name); ?></td>
                        <td><?= htmlentities($value->user_email); ?></td>
                        <td><a href="#">Ver</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info mt-2" role="alert">No tiene usuarios institucionales.</div>
        <?php } ?>
</div>