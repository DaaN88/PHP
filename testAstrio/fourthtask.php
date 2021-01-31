<?php
echo "Задание №4. Класс-оболочка хранилища \"Box\"" . "<br/>";

spl_autoload_register(function ($name_essence) {
    $paths = ["classes/$name_essence.php", "Interfaces/$name_essence.php"];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

$box = Box::getInstance();
$saveInFile = new FileBox();
$saveInDB = new DbBox();

$box->setData($saveInFile,123, "value = " . 321);
$box->setData($saveInDB,50, "value = " . 868);

echo "<b>Загрузка\Выгрузка в файл: </b>" . "<br/>";
$box->save($saveInFile);
echo "<br/>";
$box->load($saveInFile);

echo "<hr>";

echo "<b>Загрузка\Выгрузка в БД: </b>" . "<br/>";
$box->save($saveInDB);
echo "<br/>";
$box->load($saveInDB);