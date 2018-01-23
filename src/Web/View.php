<?php

namespace Jenny\ToDo\Web;

class View
{
    /** @var array */
    private $variables;

    /**
     * @param string $view
     */
    public function __construct()
    {
        $this->variables = [];
    }

    /**
     * @return string
     */
    public function render() : string
    {
        ob_start();
        require __DIR__ . "/ToDoView.php";
        return ob_get_clean();
    }

    /**
     * @param string $key
     */
    public function __set(string $key, $value)
    {
        $this->variables[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        if (isset($this->variables[$key])) {
            return $this->variables[$key];
        }
        return null;
    }
}
