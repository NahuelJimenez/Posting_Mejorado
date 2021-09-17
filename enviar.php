<?php

$secret = "6LdZ-jMcAAAAAC7XFlkooTvSWSjuQdXi1T48T9Rf";

if (isset($_POST['g-recaptcha-response'])) {
$captcha = $_POST['g-recaptcha-response']; 
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
'secret' => $secret,
'response' => $captcha,
'remoteip' => $_SERVER['REMOTE_ADDR']
);

$curlConfig = array(
CURLOPT_URL => $url,
CURLOPT_POST => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $data
);

$ch = curl_init();
curl_setopt_array($ch, $curlConfig);
$response = curl_exec($ch);
curl_close($ch);
}

$jsonResponse = json_decode($response);

if ($jsonResponse->success === true) {

	// Si el código es correcto, seguimos procesando el formulario como siempre 
	// Si el código es correcto, seguimos procesando el formulario como siempre
	$name = $_POST['name'];
	$empresa = $_POST['empresa'];
	$cargo = $_POST['cargo'];
	$mail = $_POST['mail'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$asunto = $_POST['asunto'];
	$message = $_POST['message'];

	$mensajeCliente = 
					"<html>".
						"<head>
							<title>Cliente Posting</title>".
							"<style>
							* {
								margin: 0;
								padding: 0;
								box-sizing: border-box;
							}
							body {
								font-family: 'Roboto', sans-serif;
								font-size: 16px;
								font-weight: 300;
								color: #888;
								background-color:rgba(230, 225, 225, 0.5);
								line-height: 30px;
								text-align: center;
							}
							.contenedor{
								width: 80%;
								min-height:auto;
								text-align: center;
								margin: 0 auto;
								padding: 40px;
								background: #ececec;
								border-top: 3px solid #7F94E6;
							}
							.caja-texto{
								width: 80%;
								min-height:auto;
								text-align: left;
								margin: 0 auto;
								padding: 40px;
								background: #ececec;
								border-top: 3px solid #4A53E6;
							}
							.bold{
								color:#333;
								font-size:25px;
								font-weight:bold;
							}
							img{
								margin-left: auto;
								margin-right: auto;
								display: block;
								padding:0px 0px 20px 0px;
							}
							</style>
						</head>".
						"<body>" .
							"<div class='contenedor'>".
								"<p>&nbsp;</p>" .
								"<p>&nbsp;</p>" .
								"<p>".
									"<a title='WebDeveloper' href='https://posting.com.co'>". 
										"<img src='https://cdn.discordapp.com/attachments/862702171349581864/864525396938588160/Posting-logo.png' alt='Logo' width='100px'/>". 
									"</a>". 
								"</p>" .
								"<p>&nbsp;</p>" .
								"<h1 class='h1-tilo'>LEAD CONTACTO GENERAL</h1>" .
								"<p>&nbsp;</p>" .
								"<div class='caja-texto'>".		
									"<p><strong>Nombre: </strong> " . $name . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Empresa: </strong> " . $empresa . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Cargo: </strong> " . $cargo . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Correo: </strong> " . $mail . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Celular: </strong> " . $phone . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Pais: </strong> " . $country . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Ciudad: </strong> " . $city . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Asunto: </strong> " . $asunto . " </p>" .
									"<p>&nbsp;</p>" .
									"<p><strong>Mensaje: </strong> " . $message . " </p>" .
									"<p>&nbsp;</p>" .
									"<p>&nbsp;</p>" .
								"</div>" .                            
							"</div>" .
						"</body>" .
					"</html>";

	$cabecera = 'From: ' . $mail . " \r\n";
	$cabecera .= "X-Mailer: PHP/" . phpversion() . " \r\n";
	$cabecera .= "Mime-Version: 1.0 \r\n";
	$cabecera .= "Content-Type: text/html; charset=utf-8";

	
	$para = 'Comercial.Posting@ccgltda.com';
	$tituloCliente  = "Formulario de Contacto..";

	$resultado = mail($para, $tituloCliente, utf8_decode($mensajeCliente), $cabecera);
	
	if($resultado){
        echo '<script language="javascript">window.location="http://www.posting.com.co";alert("Mensaje Enviado!");</script>';
    }else{
        echo "Hubo un error enviando el mensaje";
    }
	
}



?>
