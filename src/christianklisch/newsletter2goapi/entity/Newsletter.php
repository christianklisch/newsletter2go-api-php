<?php
namespace Newsletter2Go;

class Newsletter implements \Newsletter2Go\NewsletterInterface
{

    private $id;

    private $name;

    private $type;

    private $category;

    private $subject;

    private $html;

    private $text;

    private $from;

    private $reply;

    private $ref;

    private $recipients = array();

    private $date;

    public function __construct($vars = null)
    {
        if ($vars && is_array($vars)) {
            if (array_key_exists('id', $vars))
                $this->id = $vars['id'];
            if (array_key_exists('name', $vars))
                $this->name = $vars['name'];
            if (array_key_exists('type', $vars))
                $this->type = $vars['type'];
            if (array_key_exists('category', $vars))
                $this->category = $vars['category'];
            if (array_key_exists('subject', $vars))
                $this->subject = $vars['subject'];
            if (array_key_exists('html', $vars))
                $this->html = $vars['html'];
            if (array_key_exists('text', $vars))
                $this->text = $vars['text'];
            if (array_key_exists('from', $vars))
                $this->from = $vars['from'];
            if (array_key_exists('reply', $vars))
                $this->reply = $vars['reply'];
            if (array_key_exists('ref', $vars))
                $this->ref = $vars['ref'];
            if (array_key_exists('date', $vars))
                $this->date = $vars['date'];
        } elseif ($vars && ! is_array($vars)) {
            $this->name = $vars;
        }
    }

    public function setMessage($message)
    {
        if ($message instanceof Email) {
            $this->type = 'email';
            $this->subject = $message->getSubject();
            $this->html = $message->getHtml();
            $this->text = $message->getText();
            $this->from = $message->getFrom();
            $this->reply = $message->getReply();
            $this->ref = $message->getRef();
        }
        if ($message instanceof Sms) {
            $this->type = 'sms';
            $this->text = $message->getText();
            $this->from = $message->getFrom();
            $this->ref = $message->getRef();
            $this->category = $message->getCategory();
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getReply()
    {
        return $this->reply;
    }

    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    public function addRecipient($recipient)
    {
        $this->recipients[] = $recipient;
    }

    public function getRecipients()
    {
        return $this->recipients;
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
}
