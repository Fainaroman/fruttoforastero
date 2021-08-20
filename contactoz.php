<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];
$form        = $_POST['source'];


// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "vps-1518160-x.dattaweb.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@fruttoforastero.com";  // Mi cuenta de correo
$smtpClave = "c6X*hs@8nL";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "info@fruttoforastero.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "CONSULTA SITIO WEB - {$email}"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "<b>Nombre y Apellido:</b> {$nombre}<br /><b>Telefono:</b> {$telefono}<br /><b>Email:</b> {$email}<br /><b>Mensaje:</b> {$mensaje}<br /><br /> <br /> Fin del formulario. By Avalon3<br />"; // Texto del email en formato HTML

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){ header('Location: gracias.html');
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrió un error inesperado.";
}
