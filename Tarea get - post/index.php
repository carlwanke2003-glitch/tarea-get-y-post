<?php
function safeText($text) {
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

$selectedSection = '';
$contactResult = '';

if (isset($_GET['section'])) {
    $selectedSection = safeText($_GET['section']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? safeText($_POST['name']) : '';
    $email = isset($_POST['email']) ? safeText($_POST['email']) : '';

    if ($name !== '' || $email !== '') {
        $contactResult = "<div class=\"result\">\n        <h2>Datos recibidos por POST</h2>\n        <p><strong>Nombre:</strong> {$name}</p>\n        <p><strong>Correo electrónico:</strong> {$email}</p>\n    </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad GET y POST</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Actividad PHP: GET y POST</h1>
        <p>Proyecto básico de navegación y formulario con PHP</p>
    </header>

    <main>
        <nav class="nav-links" aria-label="Navegación principal">
            <a href="?section=Inicio">Inicio</a>
            <a href="?section=Unidades">Unidades</a>
            <a href="?section=Contacto">Contacto</a>
        </nav>

        <?php if ($selectedSection !== ''): ?>
            <div class="section-message">
                <h2>Sección seleccionada</h2>
                <p>Has seleccionado la sección: <strong><?php echo $selectedSection; ?></strong></p>
            </div>
        <?php endif; ?>

        <section>
            <h2>Formulario de contacto</h2>
            <form method="post" action="" novalidate>
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Escribe tu nombre">
                <div class="error-message" id="name-error" aria-live="polite"></div>

                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com">
                <div class="error-message" id="email-error" aria-live="polite"></div>

                <button type="submit">Enviar</button>
            </form>
        </section>

        <?php if ($contactResult !== ''): ?>
            <?php echo $contactResult; ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>Ejercicio de métodos GET y POST con PHP</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
