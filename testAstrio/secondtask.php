<?php

require_once "connectToDB.php";

echo "Задание № 2. SQL запрос" . "<br/>";

echo <<< 'EOD'
<style>
p { text-indent: 25px; }
</style>
SELECT<br/> 
    <p>first_name, last_name, child.name as name_child, model as car_model<br/></p>
FROM<br/>
    <p>worker<br/></p>
LEFT JOIN<br/> 
    <p>child<br/></p>
ON<br/> 
    <p>child.worker_id = worker.id<br/> </p>
LEFT JOIN<br/> 
    <p>car<br/></p>
ON<br/> 
    <p>car.worker_id = worker.id<br/></p> 
WHERE<br/> 
    <p>car.model IS NOT NULL;<br/></p>
EOD;

echo "<hr>";

echo "Вывод запроса из базы данных" . "<br/>";

$pdo = connectToDataBase();

$selectQuery = "SELECT 
	first_name, last_name, child.name as name_child, model as car_model 
FROM 
	worker
LEFT JOIN 
	child 
ON 
	child.worker_id = worker.id 
LEFT JOIN 
	car
ON 
	car.worker_id = worker.id 
WHERE 
	car.model IS NOT NULL";
$printSelect = $pdo->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);

echo "<br>";

foreach ($printSelect as $item) {
    if ($item['car_model'] === "null") {
        $item['car_model'] = "машина продана";
        echo "Сотрудник: " . $item['first_name'] . " " . $item['last_name'] . ", сын: " . $item['name_child'] . ", автомобиль: " . $item['car_model'] . "<br/>";
    } else {
        echo "Сотрудник: " . $item['first_name'] . " " . $item['last_name'] . ", сын: " . $item['name_child'] . ", автомобиль: " . $item['car_model'] . "<br/>";
    }
}