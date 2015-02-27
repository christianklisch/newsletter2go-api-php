<?php
namespace Newsletter2Go;

class Sms extends \Newsletter2Go\AbstractMessage implements \Newsletter2Go\SmsInterface
{

    protected $category;

    public function __construct($vars = null)
    {
        if ($vars) {
            parent::__construct();
            
            if (array_key_exists('category', $vars))
                $this->category = $vars['category'];
        }
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}