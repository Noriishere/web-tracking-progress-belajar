<?php
namespace FpSmt3\WebTracker\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function sendVerification($to, $username, $link)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP config
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'emailkamu@gmail.com'; // Ganti!
            $mail->Password   = 'password_app_email_kamu'; // Ganti pakai App Password!
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Pengirim & penerima
            $mail->setFrom('emailkamu@gmail.com', 'Web Tracker');
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
}
