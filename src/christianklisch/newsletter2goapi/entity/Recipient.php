<?php
namespace Newsletter2Go;

class Recipient
{

    protected $email;

    protected $mobile;

    protected $firstname;

    protected $lastname;

    protected $gender;

    protected $doicode;

    protected $groups = array();

    protected $attributes = array();

    public function __construct($vars = null)
    {
        print_r($vars);
        if ($vars) {
            if (array_key_exists('email', $vars))
                $this->email = $vars['email'];
            if (array_key_exists('mobile', $vars))
                $this->mobile = $vars['mobile'];
            if (array_key_exists('firstname', $vars))
                $this->firstname = $vars['firstname'];
            if (array_key_exists('lastname', $vars))
                $this->lastname = $vars['lastname'];
            if (array_key_exists('gender', $vars))
                $this->gender = $vars['gender'];
            if (array_key_exists('doicode', $vars))
                $this->doicode = $vars['doicode'];
            
            if (array_key_exists('groups', $vars)) {
                $groupsa = array();
                
                foreach ($vars['groups'] as $grp => $val) {
                    $group = new Group($val);
                    $groupsa[] = $group;
                }
                
                $this->groups = $groupsa;
            }
            if (array_key_exists('customattributes', $vars))
                $this->attributes = array();
            
            foreach ($vars['customattributes'] as $attr)
                $this->addAttribute($attr['attribute_name'], $attr['value']);
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getDoicode()
    {
        return $this->doicode;
    }

    public function setDoicode($doicode)
    {
        $this->doicode = $doicode;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function addAttribute($attribute)
    {
        $this->attributes[] = $attribute;
    }

    public function addGroup($value)
    {
        if (! substr($value, 0, 5) == 'group')
            $value = 'group' . $value;
        $this->groups[] = $value;
    }

    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}