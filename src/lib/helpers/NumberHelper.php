<?php
namespace lib\helpers;

class NumberHelper
{
    /** @var array */
    public static $numToWords = [
        900 => 'девятьсот',
        800 => 'восемьсот',
        700 => 'семьсот',
        600 => 'шестьсот',
        500 => 'пятьсот',
        400 => 'четыреста',
        300 => 'триста',
        200 => 'двести',
        100 => 'сто',
        90 => 'девяносто',
        80 => 'восемьдесят',
        70 => 'семьдесят',
        60 => 'шестьдесят',
        50 => 'пятьдесят',
        40 => 'сорок',
        30 => 'тридцать',
        20 => 'двадцать',
        19 => 'девятнадцать',
        18 => 'восемнадцать',
        17 => 'семнадцать',
        16 => 'шестнадцать',
        15 => 'пятнадцать',
        14 => 'четырнадцать',
        13 => 'тринадцать',
        12 => 'двенадцать',
        11 => 'одиннадцать',
        10 => 'десять',
        9 => 'девять',
        8 => 'восемь',
        7 => 'семь',
        6 => 'шесть',
        5 => 'пять',
        4 => 'четыре',
        3 => 'три',
        2 => 'два',
        1 => 'один',
    ];

    /** @var array */
    public static $levels = [
        4 => ['миллиард', 'миллиарда', 'миллиардов'],
        3 => ['миллион', 'миллиона', 'миллионов'],
        2 => ['тысяча', 'тысячи', 'тысяч'],
    ];

    /**
     * @param int $number
     * @return string
     */
    public static function sumToWords($number)
    {
        $parts = explode(',', number_format($number));

        for ($resultString = '', $level = count($parts), $i = 0; $i < count($parts); $i++, $level--) {
            if (intval($num = $parts[$i])) {
                foreach (self::$numToWords as $key => $value) {
                    if ($num >= $key) {
                        // Fix для одной тысячи
                        if ($level == 2 && $key == 1) {
                            $value = 'одна';
                        }
                        // Fix для двух тысяч
                        if ($level == 2 && $key == 2) {
                            $value = 'две';
                        }
                        $resultString .= ($resultString != '' ? ' ' : '') . $value;
                        $num -= $key;
                    }
                }
                if (isset(self::$levels[$level])) {
                    $resultString .= ' ' . self::getLevelWord($parts[$i], self::$levels[$level]);
                }
            }
        }

        return mb_strtoupper(mb_substr($resultString, 0, 1, 'utf-8'), 'utf-8') .
            mb_substr($resultString, 1, mb_strlen($resultString, 'utf-8'), 'utf-8');
    }

    /**
     * @param int $num
     * @param array $words
     * @return mixed
     */
    public static function getLevelWord($num, $words)
    {
        return $words[
            ($num = ($num = $num % 100) > 19 ? ($num % 10) : $num) == 1 ? 0 : (($num > 1 && $num <= 4) ? 1 : 2)
        ];
    }
}
