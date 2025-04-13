<div class="table-responsive mx-auto">
    <table class="table" id="table-index">
        <thead class="table-dark">
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($users) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr class="text-center">
                        <td><?= $user['User_id']; ?></td>
                        <td><?= $user['User_user']; ?></td>
                        <td><?= $user['Roles_fk']; ?></td>
                        <td><?= $user['User_status_fk']; ?></td>
                        <td><?= $user['created_at']; ?></td>
                        <td><?= $user['updated_at']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" onclick="show(<?= $user['User_id']; ?>)"
                                        class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                                <button type="button" onclick="editUser(<?= $user['User_id']; ?>)"
                                        class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                                <button type="button" onclick="deleteUser(<?= $user['User_id']; ?>)"
                                        class="btn btn-danger" style="font-size: 0.5em;">DELETE</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>    
        <tfoot class="table-dark">
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Rol</th>
                <th scope="col">Estado</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
                <th scope="col">Acciones</th>
            </tr>
        </tfoot>
    </table>
</div>
