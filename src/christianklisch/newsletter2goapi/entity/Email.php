<?php
namespace Newsletter2Go;

class Email extends \Newsletter2Go\AbstractMessage implements \Newsletter2Go\EmailInterface
{

    protected $subject;

    protected $html;

    protected $reply;

    protected $linktracking;

    protected $opentracking;

    public function __construct($vars = null)
    {
        if ($vars) {
            parent::__construct($vars);
            
            if (array_key_exists('subject', $vars))
                $this->subject = $vars['subject'];
            if (array_key_exists('html', $vars))
                $this->html = $vars['html'];
            if (array_key_exists('reply', $vars))
                $this->reply = $vars['reply'];
            if (array_key_exists('linktracking', $vars))
                $this->linktracking = $vars['linktracking'];
            if (array_key_exists('opentracking', $vars))
                $this->opentracking = $vars['opentracking'];
        }
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

    public function getReply()
    {
        return $this->reply;
    }

    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    public function getLinktracking()
    {
        return $this->linktracking;
    }

    public function setLinktracking($linktracking)
    {
        $this->linktracking = $linktracking;
    }

    public function getOpentracking()
    {
        return $this->opentracking;
    }

    public function setOpentracking($opentracking)
    {
        $this->opentracking = $opentracking;
    }
}