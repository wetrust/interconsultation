<div class="container">
    <h1>Nueva institucion</h1>
    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <form method="post" action="<?php echo Config::get('URL');?>admin/instituciones/create">
        <div class="form-group">
            <label>Nombre de la institucion:</label>
            <input type="text" class="form-control" name="institucion_text" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Jefe de institucion:</label>
            <select class="form-control" name="user_id">
            <?php foreach($this->usuarios as $key => $value) { ?>
                <option value="<?php echo $value->user_id; ?>"><?php echo $value->user_name;?></option>
            <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear esta institucion</button>
    </form>
</div>
