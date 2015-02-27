<?php
namespace Newsletter2Go;

abstract class AbstractMessage
{

    protected $to;

    protected $from;

    protected $text;

    protected $id;

    protected $date;

    protected $ref;

    public function __construct($vars = null)
    {
        if ($vars) {
            if (array_key_exists('to', $vars))
                $this->to = $vars['to'];
            if (array_key_exists('from', $vars))
                $this->from = $vars['from'];
            if (array_key_exists('text', $vars))
                $this->text = $vars['text'];
            if (array_key_exists('id', $vars))
                $this->id = $vars['id'];
            if (array_key_exists('date', $vars))
                $this->date = $vars['date'];
            if (array_key_exists('ref', $vars))
                $this->ref = $vars['ref'];
        }
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
    }
}