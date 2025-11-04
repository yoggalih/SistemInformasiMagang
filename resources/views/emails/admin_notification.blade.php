<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lamaran Magang Baru</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #1a202c;">🔔 Lamaran Magang Baru Masuk!</h2>

        <p>Yth. Administrator,</p>

        <p>Sebuah lamaran magang baru telah berhasil didaftarkan ke sistem.</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 30%;">Nama Pelamar:</td>
                <td style="padding: 8px 0;">{{ $name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Institusi Asal:</td>
                <td style="padding: 8px 0;">{{ $institusi }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Email Pelamar:</td>
                <td style="padding: 8px 0;">{{ $email }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Mohon segera login ke Dashboard Admin untuk meninjau detail lamaran dan memproses keputusan.
        </p>

        <p style="text-align: center; margin-top: 30px;">
            <a href="{{ route('admin.dashboard') }}"
                style="background-color: #920000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Buka Dashboard Admin
            </a>
        </p>

        <p style="margin-top: 20px; font-size: 0.8em; color: #777;">
            Email ini dikirim otomatis oleh Sistem Informasi Magang PN Klaten.
        </p>
    </div>

</body>

</html>
