<?php
declare(strict_types = 1);

$message = ( isset($_GET['message']) ? '<p>' . str_replace('\n', '<br>', $_GET['message']) . '</p>' : '' );
$fileName = ( isset($_GET['file_name']) ? $_GET['file_name'] : '' );


echo 
<<<END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
</head>
<body>
    {$message}
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="file_name">С каким именем сохранить файл на сервере</label><br>
        <input type="text" name="file_name" id="" value="{$fileName}"><br>
        <input type="file" name="content" id=""><br>
        <input type="submit" value="ОТправить">
    </form>
</body>
</html>
END;