<?php

namespace lib\captcha;

/**
 * Класс для генерации капчи
 */
class Captcha
{
    /** @var string Символы, которые будут использоваться в капче */
    const DEFAULT_CHARSET = 'abcdefghijkxyz123456789';
    /** @var int */
    const DEFAULT_COOKIE_LIFETIME = 120;

    /** @var string */
    public $filesDir;
    /** @var string */
    public $charSet;
    /** @var array */
    public $imageList;
    /** @var array */
    public $fontList;

    /**
     * Captcha constructor.
     * @param string $filesDir
     * @param string $charSet
     * @param array $imageList
     * @param array $fontList в формате [['name' => 'font_name.ttf', 'size' => 20]]
     */
    public function __construct($filesDir = null, $charSet = null, $imageList = [], $fontList = null)
    {
        $this->filesDir = $filesDir ?: $this->defaultFilesDir();
        $this->charSet = $charSet ?: self::DEFAULT_CHARSET;
        $this->imageList = $imageList ?: $this->getDefaultImageList();
        $fonts = $fontList ?: $this->getDefaultFont();
        $this->fontList = $this->prepareFontList($fonts);
    }

    /**
     * Создаёт изображение капчи
     * @param int $code
     */
    public function create($code)
    {
        $this->sendHeaders();

        $lineCount = rand(3, 7);
        $randomFont = rand(0, count($this->fontList) - 1);

        $image = imagecreatefrompng($this->defaultFilesDir() . $this->imageList[rand(0, count($this->imageList) - 1)]);

        $this->drawLines($image, $lineCount);

        $fontColor = imagecolorallocate($image, rand(0, 200), 0, rand(0, 200));

        // Накладываем текст капчи
        $x = 0;
        foreach (str_split($code) as $letter) {
            $x += 25;
            imagettftext(
                $image,
                $this->fontList[$randomFont]["size"],
                rand(2, 4),
                $x,
                rand(45, 60),
                $fontColor,
                $this->getFontPath($randomFont),
                $letter
            );
        }

        $this->drawLines($image, $lineCount);

        ImagePNG($image);
        ImageDestroy($image);
    }

    /**
     * @return string
     */
    public function generateRandomCode()
    {
        $captchaLength = rand(4, 6);
        $charsCount = strlen($this->charSet);

        $str = '';
        for ($i = 0; $i < $captchaLength; $i++) {
            $str .= substr($this->charSet, rand(1, $charsCount) - 1, 1);
        }

        $splittedChars = str_split($str);
        shuffle($splittedChars);

        return implode('', $splittedChars);
    }

    /**
     * @param int $code
     */
    public function setCookie($code)
    {
        $cookie = md5($code);
        $cookieLifeTime = time() + self::DEFAULT_COOKIE_LIFETIME;
        setcookie("captcha", $cookie, $cookieLifeTime);
    }

    /**
     * Отправить заголовки
     */
    public function sendHeaders()
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    /**
     * @return string
     */
    public function defaultFilesDir()
    {
        return __DIR__ . DIRECTORY_SEPARATOR;
    }

    /**
     * @return array
     */
    private function getDefaultImageList()
    {
        return [
            'captcha.png',
        ];
    }

    /**
     * @return array
     */
    private function getDefaultFont()
    {
        return [
            'stocky.ttf',
        ];
    }

    /**
     * @param array $fonts
     * @return array
     */
    private function prepareFontList(array $fonts)
    {
        $fontList = [];
        foreach ($fonts as $key => $fontName) {
            $fontList[$key]['name'] = $fontName;
            $fontList[$key]['size'] = rand(30, 35);
        }

        return $fontList;
    }

    /**
     * @param int|string $index
     * @return string
     */
    private function getFontPath($index)
    {
        return $this->defaultFilesDir() . $this->fontList[$index]['name'];
    }

    /**
     * @param resource $image
     * @param int $lineCount
     */
    private function drawLines($image, $lineCount)
    {
        for ($i = 0; $i < $lineCount; $i++) {
            $color = imagecolorallocate($image, rand(0, 150), rand(0, 100), rand(0, 150));
            imageline($image, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }
    }
}
