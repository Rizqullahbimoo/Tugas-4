<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $message = $_POST['message'];

    // Validasi input
    if (strlen($name) < 3) {
        die("Nama minimal 3 karakter.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid.");
    }
    if (!is_numeric($age) || $age <= 0) {
        die("Umur harus berupa angka positif.");
    }

    // Validasi file
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        if ($fileSize > 1024 * 1024) {
            die("Ukuran file terlalu besar (maksimal 1MB).");
        }
        if ($fileType !== 'txt') {
            die("File harus berupa teks (.txt).");
        }

        // Baca isi file
        $fileContent = file_get_contents($fileTmp);
        $fileLines = explode("\n", $fileContent);

        // Simpan data ke sesi untuk ditampilkan di result.php
        session_start();
        $_SESSION['data'] = [
            'name' => $name,
            'email' => $email,
            'age' => $age,
            'message' => $message,
            'fileContent' => $fileLines,
            'browser' => $_SERVER['HTTP_USER_AGENT']
        ];
        header("Location: result.php");
        exit();
    } else {
        die("Terjadi kesalahan saat mengunggah file.");
    }
}
?>
