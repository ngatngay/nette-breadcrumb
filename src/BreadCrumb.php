<?php

    namespace NgatNgay\NetteBreadCrumb;


    /**
     * Class BreadCrumbControl
     *
     * Breadcrumb Component
     * @author David Zadražil <me@davidzadrazil.cz> edit by Leonardo Allende <alnux@ya.ru>
     *
     */

    use Exception;
    use Nette\Application\UI\Control;
    use Nette\Application\UI\Link;

    class BreadCrumb extends Control
    {

        /** @var array links */
        public array $links = [];

        /**
         * @var Null if it is not declared or string
         */
        private $templateFile = null;

        public function customTemplate($template)
        {
            $this->templateFile = $template ? $template : __DIR__ . '/BreadCrumb.latte';
        }

        /**
         * Render function
         */
        public function render()
        {
            $this->customTemplate($this->templateFile);

            $this->template->setFile($this->templateFile);

            $this->template->links = $this->links;
            $this->template->render();
        }

        /**
         * Add link
         *
         * @param $title
         * @param Link|null $link
         * @param null $icon
         */
        public function addLink($title, Link $link = null, $icon = null)
        {
            $this->links[md5($title)] = ['title' => $title, 'link' => $link, 'icon' => $icon];
        }

        /**
         * Remove link
         *
         * @param $key
         *
         * @throws Exception
         */
        public function removeLink($key)
        {
            $key = md5($key);
            if (array_key_exists($key, $this->links)) {
                unset($this->links[$key]);
            } else {
                throw new Exception("Key does not exist.");
            }
        }

        /**
         * Edit link
         * @param $title
         * @param Link|null $link
         * @param null $icon
         * @author Leonardo Allende <alnux@ya.ru>
         */
        public function editLink($title, Link $link = null, $icon = null)
        {
            if (array_key_exists(md5($title), $this->links)) {
                $this->addLink($title, $link, $icon);
            }
        }
    }