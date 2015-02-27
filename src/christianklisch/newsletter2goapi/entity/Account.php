<?php
namespace Newsletter2Go;

class Account
{

    private $freemailcount;

    private $emailcount;

    private $abocount;

    private $smscount;

    public function __construct($vars = null)
    {
        if ($vars) {
            if (array_key_exists('freemailcount', $vars))
                $this->freemailcount = $vars['freemailcount'];
            if (array_key_exists('emailcount', $vars))
                $this->emailcount = $vars['emailcount'];
            if (array_key_exists('abocount', $vars))
                $this->abocount = $vars['abocount'];
            if (array_key_exists('smscount', $vars))
                $this->smscount = $vars['smscount'];
        }
    }

    public function getFreemailcount()
    {
        return $this->freemailcount;
    }

    public function setFreemailcount($freemailcount)
    {
        $this->freemailcount = $freemailcount;
    }

    public function getEmailcount()
    {
        return $this->emailcount;
    }

    public function setEmailcount($emailcount)
    {
        $this->emailcount = $emailcount;
    }

    public function getAbocount()
    {
        return $this->abocount;
    }

    public function setAbocount($abocount)
    {
        $this->abocount = $abocount;
    }

    public function getSmscount()
    {
        return $this->smscount;
    }

    public function setSmscount($smscount)
    {
        $this->smscount = $smscount;
    }
}
