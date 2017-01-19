<?php

class correoData {

    public static function newCorreo() {
        date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
        $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
        $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
        $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "isakucorrales@gmail.com";
//Password to use for SMTP authentication
        $mail->Password = "casimiro";
//Set who the message is to be sent from
        $mail->setFrom('from@example.com', 'Sied');
//Set an alternative reply-to address
        $mail->addReplyTo('replyto@example.com', 'First Last');
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        return $mail;
    }

    public static function setContraseña($user, $token) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Cambio de contraseña';
        $mail->Body = "<h3>Sied: Cambio de Contraseña</h3> "
                . "<p> Hemos recibido una solicitud de cambio de contraseña para su cuenta."
                . "Si usted no lo ha solicitado sientase libre de ignorar este mensaje, de otra manera ingrese en el siguiente link:</p>"
                . "http://192.168.183.83/Sied/resetContrasena.php#/?token=$token";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFi($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Inicio de Periodo';
        $mail->Body = "<h3>Sied: Inicio de Periodo</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> El periodo General inicia el día: " . $periodo['fechainicio'] . "y concluye el día " . $periodo['fechafinal'] . " con dos subperiodos:</p>"
                . "<p><b>Rango del ingreso de metas:<b> " . $periodo['fiper1'] . " / " . $periodo['fiper2'] . "</p>"
                . "<p><b>Rango evaluación de metas y competencias: <b>" . $periodo['fiper2'] . " / " . $periodo['ffper2'] . "</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function Fi($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy Inicia el Periodo';
        $mail->Body = "<h3>Sied: Inicio de Periodo</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> El periodo General inicia el día: hoy y concluye el día " . $periodo['fechafinal'] . " con dos subperiodos:</p>"
                . "<p><b>Rango del ingreso de metas:<b> " . $periodo['fiper1'] . " / " . $periodo['fiper2'] . "</p>"
                . "<p><b>Rango evaluación de metas y competencias: <b>" . $periodo['fiper2'] . " / " . $periodo['ffper2'] . "</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFf($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Inicio de Periodo';
        $mail->Body = "<h3>Sied: Inicio de Periodo</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> El periodo General concluye el día " . $periodo['fechafinal'] . "</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function Ff($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy Termina el Periodo';
        $mail->Body = "<h3>Sied: Final de Periodo</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> El periodo General Finaliza el dia de hoy  " . $periodo['fechafinal'] . ".</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFiper1($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Inicio del Periodo de ingreso de metas';
        $mail->Body = "<h3>Sied: Inicio de Periodo de ingreso de metas</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que el periodo de ingreso de metas inicia el día <b>" . $periodo['fiper1'] . "</b></p>"
                . "http://192.168.183.83/Sied/#admin_metas";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function Fiper1($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy Inicia el Periodo de ingreso de metas';
        $mail->Body = "<h3>Sied: Inicio de Periodo de ingreso de metas</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que hoy inicia el periodo de ingreso de metas, puedes ir a la siguiente direccion para ingresarlas:</p>"
                . "http://192.168.183.83/Sied/#admin_metas";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFfper1($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Pronto finaliza el Periodo de ingreso de metas';
        $mail->Body = "<h3>Sied: Final del Periodo de ingreso de metas</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que el periodo de ingreso de metas finaliza el día <b>" . $periodo['ffper1'] . "</b></p>"
                . "http://192.168.183.83/Sied/#admin_metas";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function Ffper1($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy finaliza el Periodo de ingreso de metas';
        $mail->Body = "<h3>Sied: Final del Periodo de ingreso de metas</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que hoy termina el periodo de ingreso de metas,"
                . " puedes ir a la siguiente direccion para revisarlas y si no las has ingresado date prisa</p>"
                . "http://192.168.183.83/Sied/#admin_metas";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFiper2($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Inicio del periodo evaluación de metas y competencias';
        $mail->Body = "<h3>Sied: Inicio de periodo evaluación de metas y competencias</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que el periodo evaluación de metas y competencias inicia el día <b>" . $periodo['fiper2'] . "</b></p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function Fiper2($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy Inicia el Periodo evaluación de metas y competencias';
        $mail->Body = "<h3>Sied: Inicio de Periodo evaluación de metas y competencias</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que hoy inicia el periodo evaluación de metas y competencias,"
                . " puedes ir a la siguiente direccion para auto-evaluarte o en caso que seas un lider"
                . " de departamento calificar a tus colaboradores:</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

    public static function antesFfper2($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Pronto finaliza el periodo evaluación de metas y competencias';
        $mail->Body = "<h3>Sied: Final del periodo evaluación de metas y competencias</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que el periodo evaluación de metas y competencias finaliza el día <b>" . $periodo['ffper2'] . "</b></p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }
    
    public static function Ffper2($user, $periodo) {

        $mail = correoData::newCorreo();

//Set who the message is to be sent to
        $mail->addAddress($user['correo'], $user['nombre'], $user['apellido1']);

//Set the subject line
        $mail->Subject = 'Sied: Hoy finaliza el Periodo evaluación de metas y competencias';
        $mail->Body = "<h3>Sied: Final del Periodo evaluación de metas y competencias</h3> "
                . "<p>Hola " . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'] . "</p>"
                . "<p> Te queremos informar que hoy termina el Periodo evaluación de metas y competencias,"
                . " puedes ir a la siguiente direccion para revisar los reslutados finales</p>"
                . "http://192.168.183.83/Sied/";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message sent!";
        }
    }

}
