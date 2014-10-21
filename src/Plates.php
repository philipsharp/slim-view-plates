<?php
namespace philipsharp\Slim\View;

use Slim\View;
use League\Plates\Engine;
use League\Plates\Template;

class Plates extends View
{
    /**
     * Instance of a Plates engine
     *
     * @var \League\Plates\Engine
     */
    protected $engineInstance;

    /**
     * Override for the default file extension
     *
     * @var string
     */
    public $fileExtension;

    /**
     * Templates path (override of Slim templates.path)
     *
     * @var mixed string or null
     */
    public $templatesPath;

    /**
     * Template folders
     *
     * @var array
     */
    public $templatesFolders = array();

    /**
     * Parser extensions
     *
     * @var array
     */
    public $parserExtensions = array();

    /**
     * Get an instance of the Plates Engine
     *
     * @return \League\Plates\Engine
     */
    public function getInstance()
    {
        if (! $this->engineInstance) {
            $this->engineInstance = new Engine($this->templatesPath ?: $this->getTemplatesDirectory());

            if ($this->fileExtension) {
                $this->engineInstance->setFileExtension($this->fileExtension); 
            }

            if (count($this->templatesFolders) > 0) {
                foreach ($this->templatesFolders as $name => $path) {
                    $this->engineInstance->addFolder($name, $path);
                }
            }

            if (count($this->parserExtensions) > 0) {
                foreach ($this->parserExtensions as $extension) {
                    $this->engineInstance->loadExtension($extension);
                }
            }
        }

        return $this->engineInstance;
    }

    /**
     * Render a template file
     *
     * @param  string $template  The template pathname, relative to the template base directory.
     * @param  array  $data      Any additonal data to be passed to the template.
     * @return string            The rendered template.
     */
    public function render($template, $data = null)
    {
        $plates = new Template($this->getInstance());
        $plates->data($this->all());
        return $plates->render($template, $data);
    }
}