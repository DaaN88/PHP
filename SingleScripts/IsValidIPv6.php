<?php

/*
 * Реализуйте функцию-предикат isValidIPv6, которая проверяет IPv6-адреса
 * (адреса шестой версии интернет протокола) на корректность. Функция принимает
 * на вход строку с адресом IPv6 и возвращает true, если адрес корректный,
 * а в противном случае false.
 * Дополнительные условия:
 * Работа функции не зависит от регистра символов.
 * Ведущие нули в группах цифр необязательны.
 * Самая длинная последовательность групп нулей, например, :0:0:0: может быть
 * заменена на два двоеточия ::. Такую замену можно произвести только один раз.
 * Одна группа нулей :0: не может быть заменена на ::.
*/

function isValidIPv6($ipv6Address)
{
    if ($ipv6Address === '') {
        return null;
    }

    if (
        !getInitialVerification($ipv6Address)
        ||
        !getAdditionalVerificationBasedOnColon($ipv6Address)
    ) {
        return false;
    }

    return true;
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

function getInitialVerification($ipv6Address)
{
    $invalidQuantityOfDoubleColon = 2;

    if (isMatchWithBorderConditions($ipv6Address)) {
        return true;
    }

    if (getQuantityDoubleColon($ipv6Address) >= $invalidQuantityOfDoubleColon) {
        return false;
    }

    if (
        (
          (
              !isNotMoreTwoColonsOneByOne($ipv6Address) // by default return true
              ===
              isSingleColonAtFirst($ipv6Address) // by default return true
          ) // as a result -> false (false not equal true)
          ===
          (
              isSingleColonAtTheEnd($ipv6Address) // by default return true
              ===
              !isValidLengthHextet($ipv6Address) // by default return true
          ) // as a result -> false (true not equal false)
        ) === !isValueOfValidHex($ipv6Address) // by default return true
    ) {
        return false; // in 'if' will be as a result - true and return false
    }

    return true;
}

//------------------------------------------------------------------------------

function getAdditionalVerificationBasedOnColon($ipv6Address)
{
    $diapasonOfHextetWithDoubleColon = [0,1,2,3,4,5,6];
    $diapasonOfHextetWithoutDoubleColon = [2,3,4,5,6,7,8];
    $isEmpty = 0;

    if (getQuantityDoubleColon($ipv6Address) === 1) {
        if (
            !in_array(
                getQuantityOfHextets($ipv6Address),
                $diapasonOfHextetWithDoubleColon,
                true
            )
        ) {
            return false;
        }

        if (!isValueOfValidHex($ipv6Address)) {
            return false;
        }
    }

    if (getQuantityDoubleColon($ipv6Address) === $isEmpty) {
        if (
            isTheQuantityRight($ipv6Address)
            &&
            in_array(
                getQuantityOfHextets($ipv6Address),
                $diapasonOfHextetWithoutDoubleColon,
                true
            )
        ) {
            return true;
        }

        return false;
    }

    return true;
}

//------------------------------------------------------------------------------

function isMatchWithBorderConditions($ipv6Address)
{
    $conditions = ['::1', '::'];

    return in_array($ipv6Address, $conditions, true);
}

//------------------------------------------------------------------------------

function isValidLengthHextet($ipv6Address)
{
    $hextets = getHextets($ipv6Address);

    foreach ($hextets as $hextet) {
        if (strlen($hextet) >= 5) {
            return false;
        }
    }

    return true;
}

//------------------------------------------------------------------------------

function getQuantityDoubleColon($ipv6Address)
{
    return substr_count($ipv6Address, '::');
}

//------------------------------------------------------------------------------

function isTheQuantityRight($ipv6Address)
{
    $expectedQuantityHextet = [0, 1, 2, 3, 4, 5, 6, 7, 8];
    $currentQuantity = getQuantityOfHextets($ipv6Address);

    return in_array($currentQuantity, $expectedQuantityHextet, true);
}

//------------------------------------------------------------------------------

function getQuantityOfHextets($ipv6Address)
{
    $hextets = getHextets($ipv6Address);

    return count($hextets);
}

//------------------------------------------------------------------------------

function isValueOfValidHex($ipv6Address)
{
    $hextets = getHextets($ipv6Address);

    $possibleOptionsAddress =
        'aaaabbbbccccddddeeeeffff0000111122223333444455556666777788889999';

    foreach ($hextets as $hextet) {
        if (!scrabble($possibleOptionsAddress, $hextet)) {
            return false;
        }
    }

    return true;
}

//------------------------------------------------------------------------------

function scrabble($setOfLetters, $expectedSet)
{
    $lengthOfSet = strlen($setOfLetters);
    $lengthWord = strlen($expectedSet);

    if ($lengthOfSet < $lengthWord) {
        return false;
    }

    $setToArray = str_split(strtolower($setOfLetters));
    $wordToArray = str_split(strtolower($expectedSet));

    foreach ($wordToArray as $key => $letter) {
        $index = array_search($letter, $setToArray, true);

        if ($index !== false) {
            unset($setToArray[$index]);
        } else {
            return false;
        }
    }

    return true;
}

//------------------------------------------------------------------------------

function isSingleColonAtFirst($ipv6Address)
{
    $firstHextet = $ipv6Address[0];
    $secondHextet = $ipv6Address[1];

    return ($firstHextet === ':' &&  $secondHextet !== ':');
}

//------------------------------------------------------------------------------

function isSingleColonAtTheEnd($ipv6Address)
{
    $allLengthOfAddress = strlen($ipv6Address);

    $penultimateHextet = $ipv6Address[$allLengthOfAddress - 2];
    $lastHextet = $ipv6Address[$allLengthOfAddress - 1];

    return ($lastHextet === ':' && $penultimateHextet !== ':');
}

//------------------------------------------------------------------------------

function isNotMoreTwoColonsOneByOne($ipv6Address)
{
    $colons = [];

    $addressSymbolBySymbol = str_split($ipv6Address, 1);

    foreach ($addressSymbolBySymbol as $symbol) {
        if ($symbol === ':') {
            $colons[] = $symbol;
        }

        if ($symbol !== ':') {
            array_pop($colons);
        }

        if (count($colons) >= 3) {
            return false;
        }
    }

    return true;
}

//------------------------------------------------------------------------------

function getHextets($ipv6Address)
{
    $hextets = explode(':', strtolower($ipv6Address));

    return array_values(array_diff($hextets, ['']));
}

// phpcs:disable

//print_r(isValidIPv6('10:d3:2d06:24:400c:5ee0:be:3d')); // true
//print_r(isValidIPv6('0B0:0F09:7f05:e2F3:0D:0:e0:7000')); // true
//print_r(isValidIPv6('000::B36:3C:00F0:7:937')); // true
//print_r(isValidIPv6('2a03:2880:2130:cf05:face:b00c:0:1')); // true
//print_r(isValidIPv6('::1')); // true
//print_r(isValidIPv6('::')); // true
//print_r(isValidIPv6('2001::')); // true
print_r(isValidIPv6('::b36:3c:f0:7:937')); //true
//print_r(isValidIPv6('1::1'));

//print_r(isValidIPv6('2607:G8B0:4010:801::1004')); // false
//print_r(isValidIPv6('1001:208:67:4f00:e3::2c6:0')); // false
//print_r(isValidIPv6('2.001::')); // false
//print_r(isValidIPv6('9f8:0:69S0:9:9:d9a:672:f90d')); // false
//print_r(isValidIPv6('2001::0:64::2')); // false
//print_r(isValidIPv6('2001')); // false
//print_r(isValidIPv6('2001:::')); // false
//print_r(isValidIPv6('2001')); // false
//print_r(isValidIPv6('2001::0:64::2')); // false
//print_r(isValidIPv6('1001:208:67:4f00:e3::2c6:0')); //false
//print_r(isValidIPv6('e1b6:1daf9:6:0:c50:8c4:90e:e'));
//print_r(isValidIPv6('C00D::a2195:2EA9:096')); //false
//print_r(isValidIPv6('d:0:4:a004:3b96:10b0:10:800:15')); //false
//print_r(isValidIPv6('5c03:0:a::b825:d690:4ce0:2831:acf0')); //false
//print_r(isValidIPv6(':1::1')); //false
//print_r(isValidIPv6('1::1:')); //false
//print_r(isValidIPv6('2a02:0cb41:0:0:0:0:0:7')); //false

// phpcs:enable
