<?php

    namespace NgatNgay\NetteBreadCrumb;

    /**
     * Class BreadCrumbControl
     *
     * Breadcrumb Component
     * @author David Zadražil <me@davidzadrazil.cz> edit by Leonardo Allende <alnux@ya.ru>
     * edit by NgatNgay
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
            $this->template->breadCrumbLinks = $this->links;
            $this->template->render();
        }


        /**
         * Add link
         * @param string $title
         * @param string|null $link
         */
        public function addLink(string $title, string $link = null)
        {
            $this->links[md5($title)] = (object)[
                'title' => $title,
                'link'  => $link
            ];
        }


        /**
         * Edit link
         * @param string $title
         * @param string|null $link
         * @author Leonardo Allende <alnux@ya.ru>
         */
        public function editLink(string $title, string $link = null)
        {
            if (array_key_exists(md5($title), $this->links)) {
                $this->addLink($title, $link);
            }
        }


        /**
         * Remove link
         * @param string $key
         * @throws Exception
         */
        public function removeLink(string $key)
        {
            $key = md5($key);
            if (array_key_exists($key, $this->links)) {
                unset($this->links[$key]);
            } else {
                throw new Exception("Key does not exist.");
            }
        }
    }