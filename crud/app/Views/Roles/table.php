<div class="table-responsive mx-auto">
    <table class="table" id="table-index">
        <thead class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($roles) : ?>
                <?php foreach ($roles as $obj) : ?>
                    <tr class="text-center">
                        <td><?= $obj['Roles_id']; ?></td>
                        <td><?= $obj['Roles_name']; ?></td>
                        <td><?= $obj['Roles_description']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button onclick="show(<?= $obj['Roles_id']; ?>)" class="btn btn-success btn-sm">SHOW</button>
                                <button onclick="editRole(<?= $obj['Roles_id']; ?>)" class="btn btn-warning btn-sm">EDIT</button>
                                <button onclick="deleteRole(<?= $obj['Roles_id']; ?>)" class="btn btn-danger btn-sm">DELETE</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>    
        <tfoot class="table-dark">
            <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
