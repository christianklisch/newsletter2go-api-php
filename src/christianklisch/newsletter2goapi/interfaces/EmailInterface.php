<?php
namespace Newsletter2Go;

interface EmailInterface
{

    public function getTo();

    public function setTo($to);

    public function getFrom();

    public function setFrom($from);

    public function getText();

    public function setText($text);

    public function getId();

    public function setId($id);

    public function getDate();

    public function setDate($date);

    public function getRef();

    public function setRef($ref);

    public function getSubject();

    public function setSubject($subject);

    public function getHtml();

    public function setHtml($html);

    public function getReply();

    public function setReply($reply);

    public function getLinktracking();

    public function setLinktracking($linktracking);

    public function getOpentracking();

    public function setOpentracking($opentracking);
}