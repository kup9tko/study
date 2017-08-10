<?php
echo 'I\'m "banan".';
echo '<br/>';
$str = 'wefgwkej4hr23ok4j,02j34geывапАУВЫВfw-fio-2joo,pwnv03i v!!pdvj# ##*(&(*&(&%*&';
echo strlen($str);
echo '<br/>';
echo substr($str, 7, 15);
echo '<br/>';
echo preg_replace ("/[aeiouAEIOUаеёиоуыэюяАЕЁИОУЫЭЮЯ]/u", "$", $str);
echo '<br/>';
echo strtoupper($str);
echo '<br/>';
$rast = 'каждая слово в этой строке начинается с заглавной буквы';
$expr = '/(^|\pP|\pZ)(\pL){10,15}/mue';
echo preg_replace($expr, '"$1" . mb_strtoupper("$2", "UTF-8")', $rast);
//echo ucwords($rast);
echo '<br/>';
$s = $str.$expr;
echo $s;
echo '<br/>';
if(preg_match('/[A-zА-я]/u',$str)){
    echo 'буквы есть';
} else{
    echo $str;
}
echo '<br/>';
$russtr = 'Это стр#ока напис#ана на транслите';
$converter = array(
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

    'А' => 'A',   'Б' => 'B',   'В' => 'V',
    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
    'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
    'Л' => 'L',   'М' => 'M',   'Н' => 'N',
    'О' => 'O',   'П' => 'P',   'Р' => 'R',
    'С' => 'S',   'Т' => 'T',   'У' => 'U',
    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
    'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
    'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
    'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    ' ' => '_',
);
$newStr = strtr($russtr, $converter);
$newStr = preg_replace("/[^a-zA-ZА-Яа-я0-9_\s]/u","",$newStr);
echo $newStr;
?>
