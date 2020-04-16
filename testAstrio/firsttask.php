<form name="mainForm" action="firsttask.php" method="POST">
    <b> Введите номер категории:</b><br/>
    <input type="text" name="id">
    <input type="submit" name="confirm" value="Найти">
    <a href="/">На главную</a>
</form>

<?php
echo "Задание № 1: Категории.";

$categories = [
  [
    "id" => 1,
    "title" => "Обувь",
    'children' => [
      [
        'id' => 2,
        'title' => 'Ботинки',
        'children' => [
          ['id' => 3, 'title' => 'Кожа'],
          ['id' => 4, 'title' => 'Текстиль'],
        ],
      ],
      ['id' => 5, 'title' => 'Кроссовки',],
    ],
  ],
  [
    "id" => 6,
    "title" => "Спорт",
    'children' => [
      [
        'id' => 7,
        'title' => 'Мячи',
        'childrens' => [
          [
            'id' => 8,
            'title' => 'Клюшки',
          ],
        ],
      ],
    ],
  ],
];

echo "<br/>";

function searchCategory($enteredArrayCat, $id)
{
    if (!is_array($enteredArrayCat)) {
        return $enteredArrayCat;
    } else {
        foreach ($enteredArrayCat as $key => $value) {
            if ($key === "id" && $value === $id) {
                echo "Категория: ", $enteredArrayCat["title"];
            }
            searchCategory($value, $id);
        }
    }
}

searchCategory($categories, intval($_POST['id']));