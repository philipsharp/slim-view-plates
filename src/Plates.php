<?php

namespace philipsharp\Slim\View;

class Plates extends \Slim\View
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
     * Get a Plates engine
     *
     * @return \League\Plates\Engine
     */
    public function getInstance()
    {
        if (!$this->engineInstance){
            // Create new Plates engine
            $this->engineInstance = new \League\Plates\Engine($this->templatesPath ?: $this->getTemplatesDirectory());

            if ($this->fileExtension){
                $this->engineInstance->setFileExtension($this->fileExtension);
            }

            if (count($this->templatesFolders)){
                foreach($this->templatesFolders as $name => $path){
                    $this->engineInstance->addFolder($name, $path);
                }
            }
        }

        return $this->engineInstance;
    }

    /**
     * Render a template file
     *
     * @param string $template  The template pathname, relative to the template base directory
     * @param array  $data      Any additonal data to be passed to the template.
     * @return string               The rendered template
     */
    protected function render($template, $data = null){
        $platesTemplate = new \League\Plates\Template($this->getInstance());
        $platesTemplate->data($this->all());
        return $platesTemplate->render($template, $data);
    }
}
