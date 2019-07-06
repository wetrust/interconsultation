<div class="container">
    <div class="d-flex p-2 justify-content-center">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Crear una nueva cuenta</h5>
                <?php $this->renderFeedbackMessages(); ?>
                <form action="<?php echo Config::get('URL'); ?>admin/usuarios/create" method="post">
                    <div class="row">
                        <div class="form-group col">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required />
                        </div>
                        <div class="form-group col">
                            <label>Rol</label>
                            <select class="form-control" name="user_rol">
                            <?php foreach($this->roles as $key => $value) { ?>
                                <option value="<?php echo $value->rol_id; ?>"><?php echo $value->rol_name;?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col">
                        <label>eMail</label>
                        <input class="form-control" type="text" name="user_email" required />
                    </div>
                    <div class="form-group col">
                        <label>Repetir eMail</label>
                        <input class="form-control" type="text" name="user_email_repeat" required />
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col">
                        <label>Contraseña (6+ carácteres)</label>
                        <input class="form-control" type="password" name="user_password_new" pattern=".{6,}" required />
                    </div>
                    <div class="form-group col">
                        <label>Repetir contraseña</label>
                        <input class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required />
                    </div>
                    </div>
                    <input type="submit" class="btn btn-primary my-2" value="Registrar"/>
                </form>
            </div>
        </div>
    </div>
</div>
