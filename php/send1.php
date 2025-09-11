<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $business_name = $_POST['business_name'];
    $cnpj = $_POST['cnpj'];
    $help = $_POST['help'];
    $source = $_POST['source'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'filipe@yailup.com'; // Seu e-mail
        $mail->Password = 'Uu1234567@!'; // Sua senha
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Definir remetente
        $mail->setFrom('filipe@yailup.com', 'Yailup Website'); // Remetente precisa ser o e-mail autenticado
        $mail->addReplyTo($email, $nome); // Responder ao e-mail fornecido pelo usuário

        // Destinatário
        $mail->addAddress('filoliveira.me@gmail.com'); // E-mail para receber o formulário

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Novo lead!';
        $mail->Body = "
        <strong>Nome:</strong> $nome<br>
        <strong>E-mail:</strong> $email<br>
        <strong>Telefone:</strong> $phone<br>
        <strong>Gênero:</strong> $gender<br>
        <strong>Nome do negócio:</strong> $business_name<br>
        <strong>CNPJ:</strong> $cnpj<br>
        <strong>Como podemos ajudar:</strong> $help<br>
        <strong>Como nos conheceu:</strong> $source<br>
        ";

       //Enviar e-mail
        $mail->send();
        // Não imprimir nada aqui
    } catch (Exception $e) {
        // Não imprimir nada aqui também, o erro será capturado no AJAX
    }
}
?>