<?php
header('Content-Type: application/json; charset=utf-8');
require '../config/env.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../database/connection.php';

$nome     = htmlspecialchars(ucwords(strtolower(trim($_POST['nome'] ?? ''))), ENT_QUOTES, 'UTF-8');
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$assunto  = htmlspecialchars(trim($_POST['assunto'] ?? ''), ENT_QUOTES, 'UTF-8');
$mensagem = htmlspecialchars(trim($_POST['mensagem'] ?? ''), ENT_QUOTES, 'UTF-8');

if (empty($nome)) {
    echo json_encode(['success' => false, 'message' => 'Informe seu nome.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Informe um e-mail válido.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($assunto)) {
    echo json_encode(['success' => false, 'message' => 'Informe o assunto.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($mensagem)) {
    echo json_encode(['success' => false, 'message' => 'Informe sua mensagem.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Salvar no banco
try {
    $data_atual = date('Y-m-d H:i:s');
    $sql = "INSERT INTO contatos (nome, email, assunto, mensagem, data_envio) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $assunto, $mensagem, $data_atual);
    $stmt->execute();
} catch (Exception $e) {
    // Continua mesmo se falhar o banco
}

// Função para criar instância do PHPMailer
function criarMail() {
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host       = getenv('MAIL_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('MAIL_USERNAME');
    $mail->Password   = getenv('MAIL_PASSWORD');
    
    $encryption = strtolower(trim(getenv('MAIL_ENCRYPTION')));
    if ($encryption === 'tls') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    } elseif ($encryption === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } else {
        $mail->SMTPSecure = $encryption;
    }
    
    $mail->Port = (int) getenv('MAIL_PORT');
    return $mail;
}

try {
    // ===== E-MAIL 1: Para o ADMIN (você) =====
    $mailAdmin = criarMail();
    $mailAdmin->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
    $mailAdmin->addAddress(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
    $mailAdmin->addReplyTo($email, $nome);

    $mailAdmin->isHTML(true);
    $mailAdmin->Subject = "🎮 NOVO CONTATO: $assunto";
    $mailAdmin->Body = "
        <div style='font-family: Arial; background: #1C1C1E; color: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: 0 auto;'>
            <h2 style='color: #FF003C; border-bottom: 2px solid #FF003C; padding-bottom: 10px;'>Nova Mensagem de Contato</h2>
            <table style='width: 100%; margin: 20px 0;'>
                <tr><td style='color: #FF003C; font-weight: bold; padding: 5px;'>Nome:</td><td style='padding: 5px;'>$nome</td></tr>
                <tr><td style='color: #FF003C; font-weight: bold; padding: 5px;'>E-mail:</td><td style='padding: 5px;'><a href='mailto:$email' style='color: #fff;'>$email</a></td></tr>
                <tr><td style='color: #FF003C; font-weight: bold; padding: 5px;'>Assunto:</td><td style='padding: 5px;'>$assunto</td></tr>
            </table>
            <div style='background: #000; padding: 15px; border-left: 4px solid #FF003C; margin: 20px 0; border-radius: 5px;'>
                <p style='margin: 0; line-height: 1.6;'>$mensagem</p>
            </div>
            <p style='color: #666; font-size: 12px; text-align: center;'>Recebido em " . date('d/m/Y H:i') . " via Gamer Rave</p>
        </div>
    ";
    $mailAdmin->AltBody = "Nome: $nome\nE-mail: $email\nAssunto: $assunto\n\nMensagem:\n$mensagem";
    $mailAdmin->send();

    // ===== E-MAIL 2: Para o REMETENTE (confirmação) =====
    $mailCliente = criarMail();
    $mailCliente->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
    $mailCliente->addAddress($email, $nome);

    // Carrega template de confirmação
    $templatePath = '../template/confirmacao_contato.html';
    if (file_exists($templatePath)) {
        $template = file_get_contents($templatePath);
        $template = str_replace('{{nome}}', $nome, $template);
        $template = str_replace('{{email}}', $email, $template);
        $template = str_replace('{{assunto}}', $assunto, $template);
        $template = str_replace('{{mensagem}}', nl2br($mensagem), $template);
        $template = str_replace('{{data}}', date('d/m/Y H:i'), $template);
        $template = str_replace('{{ano}}', date('Y'), $template);
        $template = str_replace('{{url_site}}', getenv('URL_SITE'), $template);
    } else {
        // Template fallback caso o arquivo não exista
        $template = "
            <div style='font-family: Arial; background: #1C1C1E; color: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #FF003C;'>Olá $nome!</h2>
                <p>Sua mensagem foi recebida com sucesso. Retornaremos em breve.</p>
            </div>
        ";
    }

    $mailCliente->isHTML(true);
    $mailCliente->Subject = "✅ Mensagem Recebida - Gamer Rave";
    $mailCliente->Body    = $template;
    $mailCliente->AltBody = "Olá $nome, sua mensagem sobre '$assunto' foi recebida com sucesso! Retornaremos em breve. Equipe Gamer Rave.";
    $mailCliente->send();

    echo json_encode([
        'success' => true,
        'message' => 'Mensagem enviada com sucesso! Verifique seu e-mail.'
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao enviar o e-mail. Tente novamente mais tarde.'
    ], JSON_UNESCAPED_UNICODE);
}
?>