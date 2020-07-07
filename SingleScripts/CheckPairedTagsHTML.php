<?php

// phpcs:disable

$stringForExmpl = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <title>Пример веб-страницы</title>
</head>
<body>
<h1>Заголовок</h1>
<!-- Комментарий -->
<a href=\"URL\"><p>Первый абзац.</p></a>
<p>Второй абзац.</p>
</body>
</html>";

// phpcs:disable

function checkRightSequencesTags($transmittedStringWithTags)
{
    if ($transmittedStringWithTags === "") {
        return [];
    }

    $arrSampleOpeningTags = [
        'html',
        'head',
        'body',
        'title',
        'p',
        'h1',
        'h2',
        'h3',
        'a'
    ];
    $arrSampleClosedTags = [
        '/html',
        '/head',
        '/body',
        '/title',
        '/p',
        '/h1',
        '/h2',
        '/h3',
        '/a'
    ];
    $arrSamplePairedTags = [
        'html/html',
        'head/head',
        'body/body',
        'title/title',
        'p/p',
        'h1/h1',
        'h2/h2',
        'h3/h3',
        'a/a'
    ];

    //шаблон поиска тегов в строке; возвращает только текст (название) тега,
    //без угловых скобок
    $patternForSearch = '/[<(\\.\\*\\?\\r\\n\\s)>]/';
    $bufferArray = [];

    $arrayWordsFromString = preg_split(
        $patternForSearch,
        $transmittedStringWithTags,
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    //перебираем массив слов на соответсвие открывающим тегам
    foreach ($arrayWordsFromString as $word) {
        if (in_array($word, $arrSampleOpeningTags, true)) {
            $bufferArray[] = $word;
            //если встречаем закрывающий тег
        } elseif (in_array($word, $arrSampleClosedTags, true)) {
            if (empty($bufferArray)) {
                return false;
            }

            //достаем (и тут же удаляем) последний открывающий тег из
            //временного массива
            $prev = array_pop($bufferArray);
            //если пара закрывающий тег и открывающий тег не соответствует
            //массиву-образцу пар тегов, то последовательность тегов не верна.
            if (!in_array($prev . $word, $arrSamplePairedTags, true)) {
                return false;
            }
        }
    }

    return count($bufferArray) === 0;
}

// phpcs:disable

//print_r(checkRightSequencesTags([]));
print_r(checkRightSequencesTags($stringForExmpl));

// phpcs:enable
