<?php

namespace Newsletter2Go;

interface SmsInterface
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
    
    public function getCategory();
    
    public function setCategory($category);
}