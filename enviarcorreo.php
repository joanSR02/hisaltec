<?php
    header('Content-Type: application/json');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
    $codigo = $_POST['codigo'];
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    try {
        //Server settings
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'mail.hisaltec.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'ventas@hisaltec.com';  // SMTP username
        $mail->Password = '5@}6l48;i1j@';  // SMTP password or Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;  // TCP port to connect to

        //Recipients
        $mail->setFrom('ventas@hisaltec.com', 'Joan');
        $mail->addAddress($correo, 'Joan2');  // Add a recipient

        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->CharSet = 'UTF-8';  // Asegúrate de que el conjunto de caracteres sea UTF-8
        $mail->Subject = 'Código de verificación';
        // Crear el diseño del correo con un botón
        $mail->Body = '
            <html>
            <body>
                <h1>Hola ' . htmlspecialchars($nombre) . '</h1>
                <p>El código de verificación es: ' . htmlspecialchars($codigo) . '.</p>
                <p style="text-align: center;">
                    <a href="http://localhost/hisaltec2/confirm_email.php?correo=' . urlencode($correo) . '&codigo=' . urlencode($codigo) . '"
                    style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #007BFF; text-decoration: none; border-radius: 5px;">
                    Validar cuenta
                    </a>
                </p>
                <p>Gracias por usar nuestro servicio :3.</p>
            </body>
            </html>';
            $mail->AltBody = 'El código de verificación es: ' . htmlspecialchars($codigo) . '. Gracias por usar nuestro servicio.';
        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Revisar el correo para autentificar su cuenta.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Hubo un error al intentar enviar el correo, intentelo nuevamente más tarde.']);
    }
?>