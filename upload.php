<?php
declare(strict_types = 1);


$redirectMessage = '';

if ( isset($_POST['file_name']) ) {
    $fileName = $_POST['file_name'];
}



if ( isset($_FILES['content']) ) {
    $file = $_FILES['content'];
}

if ( $fileName === '') {
    $redirectMessage = $redirectMessage . 'Вы не ввели название файла\n';
}

if ( $file['size'] === 0 ) {
    $redirectMessage = $redirectMessage . 'Вы не выбрали файл\n';
}



if ( $fileName !== '' && $file['size'] > 0 ) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/upload';

    if ( !file_exists($upload_dir) ) {
        mkdir($upload_dir, 0777, true);
    }

    if ( $file['error'] === 0 ) {
        move_uploaded_file( $file['tmp_name'], $upload_dir . '/' . $fileName);
    }

    echo '<p>Вы успешно загрузили файл в ' . $upload_dir . '/' . $fileName . '</p>';
    echo '<p>Размер файла: ' . $file['size'] . ' байт</p>';
} else {
    header('Location:' . '/index.php'. '?message=' . urlencode($redirectMessage) . '&file_name = ' . ( isset($fileName) ? $fileName : '' ) . '&file=' . ( isset($file) ? $file : '' ));   
}



