<?php

namespace GenClass;

use Twig\Environment;

class TwigWrap extends Environment
{
    /**
     * Renders a template.
     *
     * @param string|TemplateWrapper $name The template name
     *
     * @throws LoaderError  When the template cannot be found
     * @throws SyntaxError  When an error occurred during compilation
     * @throws RuntimeError When an error occurred during rendering
     */
    public function render($name, array $context = []): string
    {
        if (\is_string($name)) $name = $this->prepareNameTpl($name);
        return parent::render($name, $context);
    }

    /**
     * show a template.
     *
     * @param string|TemplateWrapper $name The template name
     *
     * @throws LoaderError  When the template cannot be found
     * @throws SyntaxError  When an error occurred during compilation
     * @throws RuntimeError When an error occurred during rendering
     */
    public function show($name, array $context = []): void
    {
        echo $this->render($name, $context);
    }

    /**
     * show a template. after exit();
     *
     * @param string|TemplateWrapper $name The template name (dot notations)
     *
     * @throws LoaderError  When the template cannot be found
     * @throws SyntaxError  When an error occurred during compilation
     * @throws RuntimeError When an error occurred during rendering
     */
    public function showAndExit($name, array $context = []): void
    {
        echo $this->render($name, $context);
        exit();
    }

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    protected function prepareNameTpl(string $name): string
    {
        $name = \str_replace('.', '/', $name);
        if (!\str_ends_with(\_str()->lower($name), '.twig')) $name .= '.twig';
        return $name;
    }
}
