<?php
echo "Задание №3. Теги" . "<br/>";

$tagsOne = [
  "<html>",
  "<a>",
  "<div>",
  "</div>",
  "</a>",
  "<span>",
  "</span>",
  "</html>",
];

$tagsTwo = [
  "<a>",
  "</div>",
  "</body>",
];


function checkTags($arrayWithTags)
{

    $openTags = [
      "<a>",
      "<div>",
      "<html>",
      "<head>",
      "<body>",
      "<span>",
      "<ul>",
      "<li>",
      "<tr>",
      "<td>",
      "<table>",
    ];

    $closeTags = [
      "</a>",
      "</div>",
      "</html>",
      "</head>",
      "</body>",
      "</span>",
      "</ul>",
      "</li>",
      "</tr>",
      "</td>",
      "</table>",
    ];

    $stackOpenTags = [];
    $stackCloseTags = [];

    foreach ($arrayWithTags as $key => $value) {
        foreach ($openTags as $keyOpen => $valueOpen) {
            if ($value === $valueOpen) {
                array_push($stackOpenTags, htmlspecialchars($value));
            }
        }
    }

    foreach ($arrayWithTags as $key => $value) {
        foreach ($closeTags as $keyOpen => $valueOpen) {
            if ($value === $valueOpen) {
                array_push($stackCloseTags, htmlspecialchars($value));
            }
        }
    }

    echo "<br/>";

    if (count($stackOpenTags) === count($stackCloseTags)) {
        echo "Переданная последовательность тегов корректна" . "<br/>";
    } else {
        echo "Переданная последовательность тегов не корректна" . "<br/>";
    }
}

checkTags($tagsOne);
echo "<br/>";
checkTags($tagsTwo);