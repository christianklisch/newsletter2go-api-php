<?php
namespace Newsletter2Go;

class Group
{

    private $id;

    private $name;

    public function __construct($vars = null)
    {
        if ($vars) {
            if (array_key_exists('name', $vars))
                $this->name = $vars['name'];
            if (array_key_exists('id', $vars))
                $this->id = $vars['id'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
