<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $linkedin = $_POST['linkedin'] ?? '';
    $site = $_POST['site'] ?? '';
    $escolaridade = $_POST['escolaridade'];
    $curso = $_POST['curso'];
    $ocupacao = $_POST['ocupacao'];
    $empresa = $_POST['empresa'] ?? '';
    $habilidades = $_POST['habilidades'];
    $resumo = $_POST['resumo'];

    // Para lidar com o upload de arquivo de foto
    $foto_perfil = $_FILES['foto_perfil']['tmp_name'];
    $foto_nome = $_FILES['foto_perfil']['name'];

    // Inicia o PHPMailer
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
        $mail->setFrom('filipe@yailup.com', 'Yailup Website');
        $mail->addReplyTo($email, $nome);

        // Destinatário
        $mail->addAddress('filoliveira.me@gmail.com');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Novo cadastro recebido!';
        $mail->Body = "
        <strong>Nome:</strong> $nome<br>
        <strong>Data de Nascimento:</strong> $data_nascimento<br>
        <strong>CPF:</strong> $cpf<br>
        <strong>RG:</strong> $rg<br>
        <strong>Sexo:</strong> $sexo<br>
        <strong>E-mail:</strong> $email<br>
        <strong>WhatsApp:</strong> $whatsapp<br>
        <strong>LinkedIn:</strong> $linkedin<br>
        <strong>Site/Portfólio:</strong> $site<br>
        <strong>Escolaridade:</strong> $escolaridade<br>
        <strong>Curso:</strong> $curso<br>
        <strong>Ocupação Atual:</strong> $ocupacao<br>
        <strong>Empresa:</strong> $empresa<br>
        <strong>Principais Habilidades:</strong> $habilidades<br>
        <strong>Breve Resumo:</strong> $resumo<br>
        ";

        // Anexar a foto de perfil, se fornecida
        if (!empty($foto_perfil)) {
            $mail->addAttachment($foto_perfil, $foto_nome);
        }

        // Enviar e-mail
        $mail->send();
        // Não imprimir nada aqui para evitar problemas no AJAX
    } catch (Exception $e) {
        // Captura erros silenciosamente
    }
}
?>