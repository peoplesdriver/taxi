<?php

class Controller
{
    public $slim;
    public $twig_vars;
    public $view;
    protected $ci;

    public function __construct($container) {
        $this->ci = $container;
        $this->twig_vars = [];
    }

    public function allTree($vars)
    {
        $tree = [];
        foreach ($vars as $var) {
            $tree[$var['id']] = $var;
        }
        return $tree;
    }

    protected function _uploadFiles($input_name, $destination = '/files')
    {
        $upload = new Upload($input_name);
        $upload->move_uploaded_to = $_SERVER['DOCUMENT_ROOT'].$destination;
        $upload_result = $upload->upload();
        $files = [];

        if ($upload_result === true) {
            $files_data = $upload->getUploadedData();
            foreach ($files_data as $data) {
                $file['name'] = $data['new_name'];
                $file['extension'] = $data['extension'];
                $file['full_path'] = $data['full_path_new_name'];

                $paths = explode('/', $file['full_path']);
                $name = md5(array_pop($paths).time()).'.'.$file['extension'];
                $destination = substr($name, 0, 2).'/'.substr($name, 2, 2).'/'.substr($name, 4, 90);
                $paths[] = $destination;
                $paths = implode('/', $paths);

                $subfolder = explode('/', $paths);
                array_pop($subfolder);
                $subfolder = implode('/', $subfolder);
                if (!file_exists($subfolder)) {
                    mkdir($subfolder, 0777, true);
                }

                rename($file['full_path'], $paths);
                $file['full_path'] = $paths;
                $file['url'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file['full_path']);
                $object = File::create($file);
                $files[] = $object->toArray();
            }
        }

        return $files;
    }

    public function render()
    {
        $response = $this->ci->get('response');
        try {
            return $this->ci->view->render($response, $this->view, $this->twig_vars);
        } catch(\Twig_Error_Loader $e) {
            $text = explode('"', $e->getMessage() );
            $template = $text[1];
            $this->slim->render('errors/error-not-found-template.html.twig',
                ['mes' => $e->getMessage(), 'template' => $template] );
        }
    }


}