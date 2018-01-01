<?php

use Nette\Localization\ITranslator;
use Nette\Application\UI\Control;


/**
 * Class BreadCrumb
 *
 * @author geniv
 */
class BreadCrumb extends Control
{
    /** @var array links */
    private $links = [];
    /** @var string template path */
    private $templatePath;
    /** @var ITranslator|null */
    private $translator;


    /**
     * BreadCrumb constructor.
     *
     * @param ITranslator|null $translator
     */
    public function __construct(ITranslator $translator = null)
    {
        parent::__construct();

        $this->translator = $translator;

        $this->templatePath = __DIR__ . '/BreadCrumb.latte';    // implicit path
    }


    /**
     * Set template path.
     *
     * @param string $path
     * @return $this
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
        return $this;
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

        $template->links = $this->links;

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }


    /**
     * Add link.
     *
     * @param string $title
     * @param null   $link
     * @param null   $icon
     * @return $this
     */
    public function addLink(string $title, $link = null, $icon = null)
    {
        $this->links[md5($title)] = [
            'title'    => $title,
            'link'     => (is_array($link) ? $link[0] : $link),   // moznost ukladani linky s parametry
            'linkArgv' => (is_array($link) ? array_slice($link, 1) : []),   // rozsirujici parametry odkazu
            'icon'     => $icon,
        ];
        return $this;
    }


    /**
     * Edit link.
     *
     * @param string $title
     * @param null   $link
     * @param null   $icon
     * @return $this
     */
    public function editLink(string $title, $link = null, $icon = null)
    {
        if (array_key_exists(md5($title), $this->links)) {
            $this->addLink($title, $link, $icon);
        }
        return $this;
    }


    /**
     * Remove link.
     *
     * @param string $key
     * @return $this
     * @throws Exception
     */
    public function removeLink(string $key)
    {
        $key = md5($key);
        if (array_key_exists($key, $this->links)) {
            unset($this->links[$key]);
        } else {
            throw new Exception('Key does not exist.');
        }
        return $this;
    }
}
