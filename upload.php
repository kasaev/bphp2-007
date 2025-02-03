<?php
declare(strict_types = 1);

$errCount = 0;
$redirectMessage = '';

if ( isset($_POST['file_name']) && !empty($_POST['file_name'])) {
    $fileName = $_POST['file_name'];
} else {
    $errCount++;
    $redirectMessage = $redirectMessage . 'Вы не ввели название файла\n';
}

if ( isset($_FILES['content']) && is_uploaded_file($_FILES['content']['tmp_name']) ) {
    $file = $_FILES['content'];
} else {
    $errCount++;
    $redirectMessage = $redirectMessage . 'Вы не выбрали файл\n';
}

if ($errCount === 0) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/upload';

    if ( !file_exists($upload_dir) ) {
        mkdir($upload_dir, 0777, true);
    }

    if ( move_uploaded_file( $file['tmp_name'], $upload_dir . '/' . $fileName) ) {
        echo '<p>Вы успешно загрузили файл в ' . $upload_dir . '/' . $fileName . '</p>';
        echo '<p>Размер файла: ' . $file['size'] . ' байт</p>';
    } else {
        echo '<p>При загрузке файла что-то пошло не так.</p>';
    }
} else {
    header('Location:' . '/index.php'. '?message=' . urlencode($redirectMessage) . '&file_name=' . $fileName ); 
}



