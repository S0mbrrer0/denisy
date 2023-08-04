<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="">
    <input type="text" name="file_name" placeholder="Введите имя файла" />
    <textarea rows="10" cols="45" name="text" placeholder="Введите текст"></textarea>
    <input type="submit" name="create" value="Создать" />
    <input type="submit" name="delete" value="Удалить" />
</form>



<?php
        // скрывает ошибки
//error_reporting(0);

        // Выодим директорию проекта
$documentRoot = $_SERVER["DOCUMENT_ROOT"];
        // Задаем название папки
$dir =  'txt_file';

        // Красивый вывод var_dump
//function varDump($var) {
//    echo '<pre>';
//    var_dump($var);
//    echo '</pre>';
//}


        //Проверяем наличие папки, если ее нет, создаем
if (!is_dir($documentRoot.'/'.$dir)) {
    mkdir($dir);
}
        // Проверяем наличие папки
            // FILE_APPEND - добавляет текст в конец строки
            // file_put_contents - перезаписывает файл, если его нету, создает
            // unlink - удаляет файл

if (isset($_POST['file_name']) || isset($_POST['text']) || isset($_POST['create']) || isset($_POST['delete'])) {
    // Присваиваем переменную для названия файла из input
    $filename = $_POST['file_name'];
    // Присваиваем переменную написанного текста из textarea
    $text = $_POST['text'];
    // Кнопка создать
    $create = isset($_POST['create']);
    // Кнопка удалить
    $delete = isset($_POST['delete']);
    if (!file_exists($documentRoot . '/' . $dir . '/' . $filename) && $filename != '' && $create) {
        file_put_contents($documentRoot . '/' . $dir . '/' . $filename, $text, FILE_APPEND);
        echo 'Файл создан<br><br>';
    } elseif ($filename != '' && $delete == file_exists($documentRoot . '/' . $dir . '/' . $filename)) {
            unlink($documentRoot . '/' . $dir . '/' . $filename);
            echo 'Файл удален<br><br>';
    } elseif ($filename == file_exists($documentRoot . '/' . $dir . '/' . $filename)) {
        echo 'Файл перезаписан <br><br>';
    } elseif ($filename != file_exists($documentRoot . '/' . $dir . '/' . $filename) && $create) {
        echo 'Введите название файла, для создания <br><br>';
    }
    elseif ($filename != file_exists($documentRoot . '/' . $dir . '/' . $filename) && $delete) {
        echo 'Введите название файла, для удаления <br><br>';
    }
            // Проверяем список вложенных файлов в папку $dir - проходит циклом по массиву
                // array_diff убирает не желаемые папки, в моем случае .. и .
    echo 'Файлы в папке ' . $dir . '<br> <br>';
    $files = array_diff( scandir( $dir), array('..', '.'));
    foreach ($files as $file)
        echo "<input type=\"submit\" name=\"$file\" value=\"$file\" /> <br>";
}

        // убивает последующий код
die();
?>
</body>
</html>
