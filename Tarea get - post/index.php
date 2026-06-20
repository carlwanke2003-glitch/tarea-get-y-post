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
    <style>
        :root {
            --bg: #f4f7fb;
            --surface: #ffffff;
            --surface-alt: #eef4ff;
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --accent: #0ea5e9;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dbe3f0;
            --success: #10b981;
            --error: #ef4444;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fbff 0%, var(--bg) 100%);
            color: var(--text);
            line-height: 1.6;
        }

        header {
            background: linear-gradient(120deg, var(--primary) 0%, var(--accent) 100%);
            color: #fff;
            padding: 3rem 1.25rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);
        }

        header h1 {
            margin: 0 0 0.5rem;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
        }

        header p {
            margin: 0;
            font-size: 1rem;
            opacity: 0.92;
        }

        main {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem 2.5rem;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.1rem;
            border-radius: 999px;
            background: var(--surface);
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            border: 1px solid rgba(79, 70, 229, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.2);
        }

        .section-message,
        .result,
        form {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: var(--shadow);
        }

        .section-message {
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.06), rgba(14, 165, 233, 0.06));
        }

        .section-message h2,
        .result h2,
        section h2 {
            margin-top: 0;
        }

        section {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        .error-message {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: -0.8rem;
            margin-bottom: 1rem;
        }

        .result {
            margin-top: 1.5rem;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.06), rgba(79, 70, 229, 0.06));
            border: 1px solid rgba(16, 185, 129, 0.2);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .result.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--muted);
            font-size: 0.875rem;
        }

        @media (max-width: 600px) {
            header {
                padding: 2rem 1rem;
            }

            .nav-links {
                gap: 0.5rem;
            }

            .nav-links a {
                padding: 0.7rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const nameError = document.getElementById('name-error');
            const emailError = document.getElementById('email-error');
            const resultBox = document.querySelector('.result');
            const navLinks = document.querySelectorAll('.nav-links a');

            const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            const updateActiveLink = () => {
                const params = new URLSearchParams(window.location.search);
                const section = params.get('section');

                navLinks.forEach((link) => {
                    const linkSection = link.getAttribute('href').split('section=')[1];
                    link.classList.toggle('active', section === linkSection);
                });
            };

            if (form) {
                form.addEventListener('submit', function (event) {
                    let isValid = true;

                    nameError.textContent = '';
                    emailError.textContent = '';

                    if (!nameInput.value.trim()) {
                        nameError.textContent = 'El nombre es obligatorio.';
                        isValid = false;
                    }

                    if (!emailInput.value.trim()) {
                        emailError.textContent = 'El correo es obligatorio.';
                        isValid = false;
                    } else if (!isValidEmail(emailInput.value.trim())) {
                        emailError.textContent = 'Ingresa un correo válido.';
                        isValid = false;
                    }

                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }

            if (resultBox) {
                resultBox.classList.add('is-visible');
            }

            updateActiveLink();
        });
    </script>
</body>
</html>
