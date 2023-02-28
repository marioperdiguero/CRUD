<?php
include_once 'components/header.php';

$code_error = isset($code) ? $code : "";
$msg_error = isset($error_message) ? $error_message : "";
$msg_client_error = isset($error_client_message) ? $error_client_message : "Lo sentimos, no se ha proporcionado más información acerca del error";
?>

<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">Error <?= $code_error ?></h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4"><?= $msg_client_error ?></p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="/crud/index.php" type="button" class="btn btn-primary btn-lg px-4 gap-3">Volver a la página de Inicio</a>
        </div>
    </div>
</div>

<?php include_once 'components/footer.php'; ?>