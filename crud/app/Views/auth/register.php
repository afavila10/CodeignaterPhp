<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-3">Register</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/register/store" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">User name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="Role_fk" class="form-label">Rol</label>
                <input type="number" class="form-control" id="Role_fk" name="Role_fk" required>
            </div>

            <div class="mb-3">
                <label for="User_Status_fk" class="form-label">User status</label>
                <input type="number" class="form-control" id="User_Status_fk" name="User_status_fk" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades como modales) -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
