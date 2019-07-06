<div class="container">
    <h1>Añadir usuario a su institucion</h1>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <form method="post" action="<?php echo Config::get('URL');?>index/usuarios_add">
        <input type="hidden" class="form-control" name="institucion_id" value="<?php echo htmlentities($this->institucion->institucion_id); ?>">
        <div class="form-group">
            <label>Nombre de la institucion:</label>
            <input disabled type="text" class="form-control" autocomplete="off" value="<?php echo htmlentities($this->institucion->institucion_text); ?>">
        </div>
        <div class="form-group">
            <label>Usuario:</label>
            <select class="form-control" name="user_id">
            <?php foreach($this->usuarios as $key => $value) { ?>
                <option value="<?php echo $value->user_id; ?>"><?php echo $value->user_name;?></option>
            <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Añadir este usuario</button>
    </form>
</div>
