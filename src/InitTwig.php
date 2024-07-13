<?php

namespace GenClass;

use GenClass\TwigWrap;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class InitTwig
{
    protected TwigWrap $obj;

    function __construct()
    {
        $this->obj = new TwigWrap(
            new FilesystemLoader(ROOT_DIR . '/views'),
            [
                'cache'            => ROOT_DIR . '/cache/view',
                'debug'            => true,
                'auto_reload'      => true, // Если true, при каждом рендеринге шаблона Symfony сначала проверяет, изменился ли его исходный код с момента его компиляции. Если он изменился, шаблон автоматически компилируется заново.
                'strict_variables' => true, // Если установлено значение false, Twig будет молча игнорировать недопустимые переменные (переменные и/или атрибуты/методы, которые не существуют) и заменять их нулевым значением. Если установлено значение true, Twig вместо этого генерирует исключение (по умолчанию — false).
            ]
        );

        $this->addFunctions();
    }

    function get(): TwigWrap
    {
        return $this->obj;
    }

    protected function addFunctions(): void
    {
        // $this->obj->addFunction(
        //     new TwigFunction('getCurrentFlow', \getCurFlow(...))
        // );
    }
}
