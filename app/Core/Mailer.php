<?php

namespace FpSmt3\WebTracker\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function sendVerification($to, $username, $link)
    {
        $mail = new PHPMailer(true);
        error_log(strlen(SMTP_PASS));
        error_log("SMTP_USER=" . SMTP_USER);
        error_log("PASS_LEN=" . strlen(SMTP_PASS));
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function ($str, $level) {
            error_log("SMTP DEBUG: $str");
        };

        try {
            // SMTP config
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Pengirim & penerima
            $mail->setFrom(SMTP_USER, 'MINE');
            $mail->addAddress($to, $username);

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Verifikasi Akun Kamu';
            $mail->Body    = "
                <h2>Halo, {$username} 👋</h2>
                <p>Terima kasih sudah mendaftar di <b>Web Tracking Progress Belajar</b>.</p>
                <p>Klik link di bawah ini untuk verifikasi akun kamu:</p>
                <p><a href='{$link}' style='background-color:#5465ff;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Verifikasi Akun</a></p>
                <br>
                <small>Jika kamu tidak merasa membuat akun ini, abaikan saja email ini.</small>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }
    public static function sendResetPassword($email, $username, $link)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(SMTP_USER, 'MINE');
        $mail->addAddress($email, $username);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $mail->Body = "
        <h3>Halo $username</h3>
        <p>Klik link berikut untuk reset password (15 menit):</p>
        <a href='$link'>$link</a>
    ";

        return $mail->send();
    }
}
