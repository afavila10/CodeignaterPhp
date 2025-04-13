<form id="my-form">
    <input type="hidden" class="form-control" id="User_id" name="User_id" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    <input type="hidden" class="form-control" id="create_at" name="create_at" value=$today>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="User_user" name="User_user" placeholder="User Name">
        <label for="User_user">Usuario</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="User_password" name="User_password" placeholder="Password">
        <label for="User_password">Contraseña</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="Roles_fk" name="Roles_fk" placeholder="Role Id">
        <label for="Roles_fk">Role Id</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="User_status_fk" name="User_status_fk" placeholder="Status Id">
        <label for="User_status_fk">Status Id</label>
    </div>
</form>
