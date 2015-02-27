<?php
namespace Newsletter2Go;

interface NewsletterInterface
{

    public function getName();

    public function setName($name);

    public function getType();

    public function setType($type);

    public function getCategory();

    public function setCategory($category);

    public function getSubject();

    public function setSubject($subject);

    public function getHtml();

    public function setHtml($html);

    public function getText();

    public function setText($text);

    public function getFrom();

    public function setFrom($from);

    public function getReply();

    public function setReply($reply);

    public function getRef();

    public function setRef($ref);

    public function addRecipient($recipient);

    public function getRecipients();

    public function getId();

    public function setId($id);

    public function getDate();

    public function setDate($date);
}