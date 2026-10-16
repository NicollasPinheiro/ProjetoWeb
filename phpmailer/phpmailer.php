<?php
header('Content-Type: application/json; charset=utf-8');
require '../config/env.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../database/connection.php';

$nome = htmlspecialchars(ucwords(strtolower($_POST['nome'] ?? '')), ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$mensagem = htmlspecialchars(ucwords($_POST['mensagem'] ?? ''), ENT_QUOTES, 'UTF-8');

if (empty($nome)) {
    echo json_encode(['status' => 'error', 'message' => 'Informe seu nome.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Informe um email válido.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($mensagem)) {
    echo json_encode(['status' => 'error', 'message' => 'Informe mensagem corretamente.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar se existe email cadastrado
$sqlCheck = "SELECT id FROM newsletter WHERE email = ? LIMIT 1";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();

if (!$stmtCheck->fetch()) {
    // Gravar no banco 
    $data_atual = date('Y-m-d H:i:s');
    $sql = "INSERT INTO newsletter (name, email, message, datecreate) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $mensagem, $data_atual);

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao enviar para o servidor.'], JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Este e-mail já está cadastrado.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet  = 'UTF-8';
$mail->Encoding = 'base64';

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = getenv('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('MAIL_USERNAME');
    $mail->Password   = getenv('MAIL_PASSWORD');
    
    // ✅ CORREÇÃO CRÍTICA: Converter 'tls' para constante
    $encryption = strtolower(trim(getenv('MAIL_ENCRYPTION')));
    if ($encryption === 'tls') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    } elseif ($encryption === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } else {
        $mail->SMTPSecure = $encryption;
    }
    
    $mail->Port       = (int) getenv('MAIL_PORT');

    // Recipients
    $mail->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
    $mail->addAddress($email, $nome);

    $template = file_get_contents('../template/newsletter_new.html');
    $template = str_replace('{{nome}}', $nome, $template);
    $template = str_replace('{{email}}', $email, $template);
    $template = str_replace('{{ano}}', date('Y'), $template);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'NEWSLETTER - CADASTRO REALIZADO COM SUCESSO';
    $mail->Body    = $template;
    $mail->AltBody = "Olá $nome, seu e-mail $email foi cadastrado com sucesso na newsletter Gamer Rave!";

    $mail->Priority = 1;
    $mail->addCustomHeader('X-MSMail-Priority', 'High');
    $mail->addCustomHeader('Importance', 'High');
    $mail->addCustomHeader('X-Priority', '1');

    if ($mail->send()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Cadastro realizado com sucesso!'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'E-mail não enviado: ' . $mail->ErrorInfo
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Mailer Error: ' . $mail->ErrorInfo
    ], JSON_UNESCAPED_UNICODE);
    exit;
}