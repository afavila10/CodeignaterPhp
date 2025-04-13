<form id="my-form">
    <input type="hidden" class="form-control" id="Profile_id" name="Profile_id" value=null>
    <input type="hidden" class="form-control" id="create_at" name="create_at" value=null>
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="Profile_email" name="Profile_email" placeholder="Email">
        <label for="Profile_email">Email</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="Profile_name" name="Profile_name" placeholder="Name">
        <label for="Profile_name">Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="Profile_photo" name="Profile_photo" placeholder="Photo URL">
        <label for="Profile_photo">Photo URL</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="User_id_fk" name="User_id_fk" placeholder="User ID">
        <label for="User_id_fk">User ID</label>
    </div>
</form>
