<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;
use Nette\Localization\ITranslator;
use Nette\Application\UI\Control;


/**
 * Class BreadCrumb
 *
 * @author geniv
 */
class BreadCrumb extends Control implements ITemplatePath
{
    /** @var array */
    private $links = [];
    /** @var string */
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
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
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
     * Add internal link.
     *
     * @internal
     * @param string $key
     * @param string $title
     * @param array  $link
     * @param string $icon
     * @return BreadCrumb
     */
    private function addInternalLink(string $key, string $title, array $link, string $icon): self
    {
        $this->links[md5($key)] = [
            'title'    => $title,
            'link'     => (is_array($link) ? $link[0] : $link),   // moznost ukladani linky s parametry
            'linkArgv' => (is_array($link) ? array_slice($link, 1) : []),   // rozsirujici parametry odkazu
            'icon'     => $icon,
        ];
        return $this;
    }


    /**
     * Add link.
     *
     * @param string $title
     * @param array  $link
     * @param string $icon
     * @return BreadCrumb
     */
    public function addLink(string $title, array $link = [], string $icon = ''): self
    {
        return $this->addInternalLink($title, $title, $link, $icon);
    }


    /**
     * Edit link.
     *
     * @param string $title
     * @param array  $link
     * @param string $icon
     * @return BreadCrumb
     */
    public function editLink(string $title, array $link = [], string $icon = ''): self
    {
        if (array_key_exists(md5($title), $this->links)) {
            $this->addInternalLink($title, $title, $link, $icon);
        }
        return $this;
    }


    /**
     * Add translate link.
     *
     * @param string $title
     * @param array  $link
     * @param string $icon
     * @return BreadCrumb
     */
    public function addTranslateLink(string $title, array $link = [], string $icon = ''): self
    {
        return $this->addInternalLink($title, $this->translator->translate($title), $link, $icon);
    }


    /**
     * Edit translate link.
     *
     * @param string $title
     * @param array  $link
     * @param string $icon
     * @return BreadCrumb
     */
    public function editTranslateLink(string $title, array $link = [], string $icon = ''): self
    {
        if (array_key_exists(md5($title), $this->links)) {
            $this->addInternalLink($title, $this->translator->translate($title), $link, $icon);
        }
        return $this;
    }


    /**
     * Remove link.
     *
     * @param string $title
     * @return BreadCrumb
     * @throws Exception
     */
    public function removeLink(string $title): self
    {
        $key = md5($title);
        if (array_key_exists($key, $this->links)) {
            unset($this->links[$key]);
        } else {
            throw new Exception('Title does not exist.');
        }
        return $this;
    }
}
