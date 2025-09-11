<?php
// Começo da captura de saída para evitar lixo na resposta
ob_start();
header('Content-Type: application/json');

// Use PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Caminho correto para os arquivos PHPMailer
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// Inicialize o array de resposta padrão
$response = ['status' => 'error', 'message' => 'Erro desconhecido.'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $business_name = $_POST['business_name'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Configurações SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'filipe@yailup.com';
        $mail->Password = 'NewContr@senh@123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('filipe@yailup.com', 'Yailup Website');
        $mail->addReplyTo($email, $nome);
        $mail->addAddress('filoliveira.me@gmail.com');

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Novo lead!';
        $mail->Body = "
            <strong>Nome:</strong> $nome<br>
            <strong>E-mail:</strong> $email<br>
            <strong>Telefone:</strong> $phone<br>
            <strong>Nome da empresa:</strong> $business_name<br>
        ";

        $mail->send();
        $response = ['status' => 'success', 'message' => 'Formulário enviado com sucesso!'];
    } catch (Exception $e) {
        $response = ['status' => 'error', 'message' => 'Erro ao enviar: ' . $mail->ErrorInfo];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Método inválido.'];
}

// Elimina qualquer saída extra antes do JSON
ob_end_clean();

// Sempre retorna um JSON limpo
echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;