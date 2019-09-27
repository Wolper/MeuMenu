<?php
// Importa classes do PHPMailer para o namespace global 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carregar o carregador automático do Composer 
require 'vendor/autoload.php';

// A instanciação e a passagem `true` habilitam exceções
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Ativar a saída de depuração detalhada
    $mail->isSMTP();                                            // Definir mailer para usar SMTP
    $mail->Host       = 'ns472.hostgator.com.br';  // Especifique os servidores SMTP principais e de backup
    $mail->SMTPAuth   = true;                                   // Ativar autenticação SMTP
    $mail->Username   = 'diksondelgado@jacresci.com';                     // Nome do usuário SMTP
    $mail->Password   = 'mirela3055';                               // Senha SMTP
    $mail->SMTPSecure = 'tls';                                  // Ativar a criptografia TLS, o `ssl` também é aceita
    $mail->Port       = 465;                                    // Porta TCP para conectar-se

    // Destinatários
    $mail->setFrom('diksondelgado@jacresci.com', 'Mailer');
    $mail->addAddress('diksondelgado@jacresci.com', 'Joe User');     // Adiciona um destinatário
//    $mail->addAddress('dikson@example.com');               // Nome é opcional
    $mail->addReplyTo('dikson.delgado@gmail.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Anexos
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Adiciona anexos
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Nome opcional

    // Conteúdo
    $mail->isHTML(true);                                  // Definir o formato de email para HTML
    $mail->Subject = 'Assunto é aqui';
    $mail->Body    = 'Este é o corpo da mensagem em HTML <b> em negrito!</b>';
    $mail->AltBody = 'Este é o corpo em texto sem formatação para clientes de e-mail não HTML';

    $mail->send();
    echo 'Message enviada!';
} catch (Exception $e) {
    echo "A mensagem não pode ser enviada! Mailer Error: {$mail->ErrorInfo}";
}