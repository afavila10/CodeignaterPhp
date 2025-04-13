<div class="table-responsive mx-auto">
    <table class="table" id="table-index">
        <thead class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Email</th>
                <th>Name</th>
                <th>Photo</th>
                <th>User ID</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($profiles) : ?>
                <?php foreach ($profiles as $profile) : ?>
                    <tr class="text-center">
                    <td><?= $profile['Profile_id']; ?></td>
                        <td><?= $profile['Profile_email']; ?></td>
                        <td><?= $profile['Profile_name']; ?></td>
                        <td><img src="<?= base_url('assets/img/img.png') ?>" alt="Foto"></td>
                        <td><?= $profile['User_id_fk']; ?></td>
                        <td><?= $profile['create_at']; ?></td>
                        <td><?= $profile['update_at']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button onclick="show(<?= $profile['Profile_id']; ?>)" class="btn btn-success btn-sm">SHOW</button>
                                <button onclick="editProfile(<?= $profile['Profile_id']; ?>)" class="btn btn-warning btn-sm">EDIT</button>
                                <button onclick="deleteProfile(<?= $profile['Profile_id']; ?>)" class="btn btn-danger btn-sm">DELETE</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Email</th>
                <th>Name</th>
                <th>Photo</th>
                <th>User ID</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
