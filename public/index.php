<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google reCAPTCHA v3</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcEXJQUAAAAAKS79EnNd9AS68RjptageqkqSFwU"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LcEXJQUAAAAAKS79EnNd9AS68RjptageqkqSFwU', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
</head>

<body>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half">

                    <?php // Check if form was submitted:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

                        // Build POST request:
                        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
                        $recaptcha_secret = '6LcEXJQUAAAAAFiAdVMtnM7AbPigLOO-PsYYXECx';
                        $recaptcha_response = $_POST['recaptcha_response'];

                        // Make and decode POST request:
                        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
                        $recaptcha = json_decode($recaptcha);

                        // Take action based on the score returned:
                        if ($recaptcha->score >= 0.5) {
                            // Verified - send email
                        } else {
                            // Not verified - show form error
                        }
                    } ?>

                    <form method="POST">

                        <h1 class="title">
                            reCAPTCHA v3 Ejemplo
                        </h1>

                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input type="text" name="name" class="input" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input type="email" name="email" class="input" placeholder="Email Address" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Mensaje</label>
                            <div class="control">
                                <textarea name="message" class="textarea" placeholder="Message" required></textarea>
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-link">Enviar Mensaje</button>
                            </div>
                        </div>

                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                    </form>

                </div>
            </div>
        </div>
    </section>

</body>

</html>