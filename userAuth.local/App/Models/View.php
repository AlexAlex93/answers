<?php 

namespace App\Models;

class View
{
    static $templates_path = __DIR__ . '\..\Templates\\';
    public $data;
    public $content;

    public function assign( $name, $data)
    {
        $this->data[$name] = $data;
        return $this;
    }

    public function render( $template)
    {
        ob_start();
        $template = self::$templates_path . $template . '.php';
        include $template;
        $this->content = ob_get_contents();
        ob_end_clean();
        return $this;
    }

    public function display( $template)
    {
        echo $this->render($template)->content;
        return $this;
    }

}