<?php
namespace Newsletter2Go;

class Status
{

    private $success;

    private $value;

    private $status;

    private $reason;

    public function __construct($vars = null)
    {
        if ($vars) {
            if (array_key_exists('success', $vars))
                $this->success = $vars['success'];
            if (array_key_exists('value', $vars))
                $this->value = $vars['value'];
            if (array_key_exists('status', $vars))
                $this->status = $vars['status'];
            if (array_key_exists('reason', $vars))
                $this->reason = $vars['reason'];
        }
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }
}
