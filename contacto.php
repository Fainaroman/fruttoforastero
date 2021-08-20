<?php


require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["telefono"])  || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}


$nombre = $_POST["nombre"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

$destinatario = "hello@fruttoforastero.com"; // Correo al que llegará la consulta //

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "vps-1518160-x.dattaweb.com";  // Dominio alternativo brindado en el email de alta
$smtpUsuario = "hello@fruttoforastero.com";  // Mi cuenta de correo
$smtpClave = "P5@7Vqt6oS";  // Mi contraseña

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465;
$mail->IsHTML(true);
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost;
$mail->Username = $smtpUsuario;
$mail->Password = $smtpClave;


$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Sitio web - Consulta de {$email}"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html>

<body>

<p><b>Informacion enviada por usuario desde el sitio web:</b></p>

<p><b>Nombre y Apellido:</b> {$nombre}</p>

<p><b>Email:</b> {$email}</p>

<p><b>Teléfono:</b> {$telefono}</p>

<p><b>Mensaje:</b> {$mensaje}</p>

</body>

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send();
if($estadoEnvio){
	header('Location: gracias.html');
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}

?>