<?php
namespace Newsletter2Go;

class Newsletter2GoService
{

    private $host = "www.newsletter2go.de";

    private $port = 443;

    private $ssl = true;

    private $api_key;

    private $debug = 0;

    private $defaultlinktracking = 0;

    private $defaultopentracking = 0;

    function __construct($key)
    {
        if (! isset($key) || empty($key))
            throw new \Newsletter2Go\Newsletter2GoException('No n2g-auth');
        
        $this->api_key = $key;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function isSsl()
    {
        return $this->ssl;
    }

    public function setSsl($ssl)
    {
        $this->ssl = $ssl;
    }

    public function getDebug()
    {
        return $this->debug;
    }

    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    public function getDefaultlinktracking()
    {
        return $this->defaultlinktracking;
    }

    public function setDefaultlinktracking($defaultlinktracking)
    {
        $this->defaultlinktracking = $defaultlinktracking;
    }

    public function getDefaultopentracking()
    {
        return $this->defaultopentracking;
    }

    public function setDefaultopentracking($defaultopentracking)
    {
        $this->defaultopentracking = $defaultopentracking;
    }
    
    // logic
    
    /**
     * get the account status.
     * returns object of type Account.
     *
     * @return \Newsletter2Go\Account
     */
    public function getAccountStatus()
    {
        return new Account($this->handleGetRequest('/de/api/get/credits/', null));
    }

    /**
     * Sends Email object via api.
     *
     * @param
     *            $email
     * @throws \Newsletter2Go\Newsletter2GoException
     * @return \Newsletter2Go\Status
     */
    public function sendSingleMail($email)
    {
        $params = array();
        
        if ($this->debug)
            $params['debug'] = $this->debug;
        
        $params['to'] = $email->getTo();
        $params['from'] = $email->getFrom();
        $params['subject'] = $email->getSubject();
        
        if ($email->getText())
            $params['text'] = $email->getText();
        if ($email->getId())
            $params['id'] = $email->getId();
        if ($email->getDate())
            $params['date'] = $email->getDate();
        if ($email->getRef())
            $params['ref'] = $email->getRef();
        
        if ($email->getHtml())
            $params['html'] = $email->getHtml();
        if ($email->getLinktracking())
            $params['linktracking'] = $email->getLinktracking();
        else 
            if ($this->getDefaultlinktracking())
                $params['linktracking'] = $this->getDefaultlinktracking();
        if ($email->getOpentracking())
            $params['opentracking'] = $email->getOpentracking();
        else 
            if ($this->getDefaultopentracking())
                $params['opentracking'] = $this->getDefaultopentracking();
        
        if (! $email->getHtml() && ! $email->getText())
            throw new \Newsletter2Go\Newsletter2GoException('No message to send');
        
        return new Status($this->handleSendRequest('/de/api/send/email/', $params));
    }

    /**
     * Sends Sms object via api.
     *
     * @param
     *            $sms
     * @throws \Newsletter2Go\Newsletter2GoException
     * @return \Newsletter2Go\Status
     */
    public function sendSingleSms($sms)
    {
        $params = array();
        $params['category'] = 'basic';
        if ($this->debug)
            $params['debug'] = $this->debug;
        
        $params['to'] = $sms->getTo();
        $params['from'] = $sms->getFrom();
        
        if ($sms->getText())
            $params['message'] = $sms->getText();
        if ($sms->getId())
            $params['id'] = $sms->getId();
        if ($sms->getDate())
            $params['date'] = $sms->getDate();
        if ($sms->getRef())
            $params['ref'] = $sms->getRef();
        
        if ($sms->getCategory())
            $params['category'] = $sms->getCategory();
        
        if (! $sms->getText())
            throw new \Newsletter2Go\Newsletter2GoException('No message to send');
        
        return new Status($this->handleSendRequest('/de/api/send/sms/', $params));
    }

    /**
     * Save a recipient in newsletter2go addressbook.
     *
     * @param
     *            $recipient
     * @return \Newsletter2Go\Status
     */
    public function createRecipient($recipient)
    {
        $params = array();
        $params['email'] = $recipient->getEmail();
        $params['mobile'] = $recipient->getMobile();
        
        if ($recipient->getFirstname())
            $params['firstname'] = $recipient->getFirstname();
        if ($recipient->getLastname())
            $params['lastname'] = $recipient->getLastname();
        if ($recipient->getGender())
            $params['gender'] = $recipient->getGender();
        if ($recipient->getDoicode())
            $params['doicode'] = $recipient->getDoicode();
        
        foreach ($recipient->getGroups() as $grp => $val) {
            if ($val instanceof Group)
                $params[$val->getId()] = $val->getName();
            else
                $params[$grp] = $val;
        }
        foreach ($recipient->getAttributes() as $attr => $val)
            $params[$attr] = $val;
        
        return new Status($this->handleSendRequest('/de/api/create/recipient/', $params));
    }

    /**
     * Update a recipient in newsletter2go addressbook.
     *
     * @param
     *            $recipient
     * @return \Newsletter2Go\Status
     */
    public function updateRecipient($recipient)
    {
        $params = array();
        $params['email'] = $recipient->getEmail();
        $params['mobile'] = $recipient->getMobile();
        
        if ($recipient->getFirstname())
            $params['firstname'] = $recipient->getFirstname();
        if ($recipient->getLastname())
            $params['lastname'] = $recipient->getLastname();
        if ($recipient->getGender())
            $params['gender'] = $recipient->getGender();
        if ($recipient->getDoicode())
            $params['doicode'] = $recipient->getDoicode();
        
        foreach ($recipient->getAttributes() as $attr => $val)
            $params[$attr] = $val;
        
        return new Status($this->handleSendRequest('/de/api/set/recipient/', $params));
    }

    /**
     * Delete a recipient from newsletter2go addressbook.
     *
     * @param
     *            $recipient
     * @return \Newsletter2Go\Status
     */
    public function deleteRecipient($recipient)
    {
        $params = array();
        $params['email'] = $recipient->getEmail();
        $params['mobile'] = $recipient->getMobile();
        
        return new Status($this->handleSendRequest('/de/api/delete/recipient/', $params));
    }

    /**
     * Remove all subscriptions of recipient.
     *
     * @param
     *            $recipient
     * @return \Newsletter2Go\Status
     */
    public function unsubscribeRecipient($recipient)
    {
        $params = array();
        $params['email'] = $recipient->getEmail();
        $params['mobile'] = $recipient->getMobile();
        
        return new Status($this->handleSendRequest('/de/api/set/unsubscribed/', $params));
    }

    /**
     * Get a recipient from adressbook by mail address.
     *
     * @param
     *            $email
     * @return \Newsletter2Go\Recipient
     */
    public function getRecipient($email)
    {
        $params = array();
        $params['email'] = $email;
        
        return new Recipient($this->handleGetRequest('/de/api/get/recipient/', $params));
    }

    /**
     * Get all recipients or recipients of group.
     *
     * @param $group group-id
     *            or group-object.
     * @return string array of data
     */
    public function getRecipientsArray($group = null)
    {
        $params = array();
        if ($group) {
            if ($group instanceof Group && $group->getId() >= 0)
                $params['groupid'] = $group->getId();
            else {
                $groups = $this->getGroups();
                foreach ($groups as $grp)
                    if ($grp->getName() == $group)
                        $params['groupid'] = $grp->getId();
            }
        }
        
        $page = 0;
        $params['page'] = $page;
        $params['recipients_per_page'] = 5000;
        
        $result = $this->handleGetRequest('/de/api/get/recipients/', $params);
        $recipients = array();
        $recipients = $result['recipients'];
        while ($result['currentPage'] + 1 < $result['totalPages']) {
            $params['page'] = ++$page;
            $result = $this->handleGetRequest('/de/api/get/recipients/', $params);
            $recipients = $result['recipients'];
        }
        
        return $recipients;
    }

    /**
     * Get all recipients or recipients of group.
     *
     * @param $group group-id
     *            or group-object.
     * @return array of \Newsletter2Go\Recipient
     */
    public function getRecipients($group = null)
    {
        $recipients = array();
        $arr = $this->getRecipientsArray($group);
        foreach ($arr as $rec)
            $recipients[] = $this->getRecipient($rec['mail']);
        
        return $recipients;
    }

    /**
     * Get all mail addresses of recipients or recipients of group.
     *
     * @param $group group-id
     *            or group-object.
     * @return string array of mail addresses.
     */
    public function getRecipientsAsMailArray($group = null)
    {
        $mails = array();
        $arr = $this->getRecipientsArray($group);
        foreach ($arr as $rec)
            $mails[] = $rec['mail'];
        
        return $mails;
    }

    /**
     * Get arraylist of used attributes.
     */
    public function getAttributes()
    {
        return $this->handleGetRequest('/de/api/get/attributes/', null);
    }

    /**
     * Get array of all own groups.
     *
     * @return array of \Newsletter2Go\Group
     */
    public function getGroups()
    {
        $groupsarray = array();
        $groups = $this->handleGetRequest('/de/api/get/groups/', null);
        
        foreach ($groups as $key => $val) {
            $grp = new Group();
            $grp->setId($key);
            $grp->setName($val);
            $groupsarray[] = $grp;
        }
        
        return $groupsarray;
    }

    /**
     * get recipient-count of group.
     *
     * @param $group group-id
     *            or group-object.
     * @return int size of requested group
     */
    public function getGroupSize($group)
    {
        $params = array();
        if ($group instanceof Group && $group->getId() >= 0)
            $params['id'] = $group->getId();
        else {
            $groups = $this->getGroups();
            foreach ($groups as $grp)
                if ($grp->getName() == $group)
                    $params['id'] = $grp->getId();
        }
        
        return $this->handleGetRequest('/de/api/get/groupsize/', $params)['size'];
    }

    /**
     * Create new group on newsletter2go server.
     *
     * @param $group group-name
     *            as string
     *            or group-object.
     * @return \Newsletter2Go\Status
     */
    public function createGroup($group)
    {
        $params = array();
        if ($group instanceof Group)
            $params['name'] = $group->getName();
        else
            $params['name'] = $group;
        
        return new Status($this->handleSendRequest('/de/api/create/group/', $params));
    }

    /**
     * Delete requested group.
     *
     * @param $group group-name
     *            as string
     *            or group-object.
     * @return \Newsletter2Go\Status
     */
    public function deleteGroup($group)
    {
        $params = array();
        if ($group instanceof Group && $group->getId() > 0)
            $params['groupid'] = $group->getId();
        else {
            $groups = $this->getGroups();
            $key = array_search($group, $groups);
            $params['groupid'] = $key;
        }
        
        return new Status($this->handleSendRequest('/de/api/delete/group/', $params));
    }

    /**
     * Create new Atttribute by name.
     *
     * @param string $name            
     * @return \Newsletter2Go\Status
     */
    public function createAttribute($name)
    {
        $params = array();
        $params['name'] = $name;
        
        return new Status($this->handleSendRequest('/de/api/create/attribute/', $params));
    }

    /**
     * Create newsletter-draft with selected recipients in newsletter object.
     *
     * @param $newsletter object            
     * @return \Newsletter2Go\Status
     */
    public function createNewsletter($newsletter)
    {
        $params = array();
        
        $params['name'] = $newsletter->getName();
        $params['subject'] = $newsletter->getSubject();
        
        if ($newsletter->getType() == 'email') {
            if ($newsletter->getHtml())
                $params['html'] = $newsletter->getHtml();
            if ($newsletter->getText())
                $params['text'] = $newsletter->getText();
            $params['type'] = 'email';
            $params['from'] = $newsletter->getFrom();
            $params['reply'] = $newsletter->getReply();
        }
        if ($newsletter->getType() == 'sms') {
            if ($newsletter->getText())
                $params['sms'] = $newsletter->getText();
            $params['type'] = 'sms';
            $params['category'] = $newsletter->getCategory();
        }
        
        if ($newsletter->getRef())
            $params['reference'] = $newsletter->getRef();
        
        $result = new Status($this->handleSendRequest('/de/api/create/newsletter/', $params));
        
        $nId = $result->getValue();
        
        foreach ($newsletter->getRecipients() as $rcp)
            $this->addRecipient2Newsletter($nId, $rcp);
        
        return $result;
    }

    /**
     * Add an recipient to existing newsletter.
     *
     * @param $newsletter int
     *            newletter id or newsletter object
     * @param $recipient recipient
     *            object
     * @return \Newsletter2Go\Status
     */
    public function addRecipient2Newsletter($newsletter, $recipient)
    {
        $params = array();
        $params['email'] = $recipient->getEmail();
        $params['mobile'] = $recipient->getMobile();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['id'] = $newsletter->getId();
        else {
            $params['id'] = $newsletter;
        }
        
        return new Status($this->handleSendRequest('/de/api/set/recipient/', $params));
    }

    /**
     * Get string array of newsletters.
     */
    public function getNewslettersArray()
    {
        return $this->handleGetRequest('/de/api/get/newsletters/', null);
    }

    /**
     * Get array of newsletter objects.
     *
     * @return array of \Newsletter2Go\Newsletter
     */
    public function getNewsletters()
    {
        $letters = array();
        
        foreach ($this->getNewslettersArray() as $nl)
            $letters[] = new Newsletter($nl);
        
        return $letters;
    }

    /**
     * Create the newsletter on newsletter2go server and send it to selected recipients in newsletter.
     *
     * @param $newsletter newsletter
     *            object
     * @return int newsletter-id
     */
    public function createAndSendNewsletter($newsletter)
    {
        $status = $this->createNewsletter($newsletter);
        return $this->sendNewsletter($status->getValue());
    }

    /**
     * Send newsletter by id or object.
     *
     * @param $newsletter int
     *            id or newsletter object.
     * @return \Newsletter2Go\Status
     */
    public function sendNewsletter($newsletter)
    {
        $params = array();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['nlid'] = $newsletter->getId();
        else
            $params['nlid'] = $newsletter;
        
        if ($newsletter->getDate())
            $params['date'] = $newsletter->getDate();
        
        return new Status($this->handleSendRequest('/de/api/send/newsletter/', $params));
    }

    /**
     * Add whole newsletter2go adressbook to newsletter.
     *
     * @param $newsletter int
     *            id or newsletter object.
     * @return \Newsletter2Go\Status
     */
    public function addAddressbook2Newsletter($newsletter)
    {
        $params = array();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['nlid'] = $newsletter->getId();
        else
            $params['nlid'] = $newsletter;
        
        return new Status($this->handleSendRequest('/de/api/set/grouptonewsletter/', $params));
    }

    /**
     * Add a group of recipients from newsletter2go addressbook to newsletter.
     *
     * @param $newsletter int
     *            id
     *            or newsletter object.
     * @param $group string
     *            group name or group object.
     * @return \Newsletter2Go\Status
     */
    public function addGroup2Newsletter($newsletter, $group)
    {
        $params = array();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['nlid'] = $newsletter->getId();
        else
            $params['nlid'] = $newsletter;
        
        if ($group instanceof Group && $group->getId() > 0)
            $params['groupid'] = $group->getId();
        else {
            $groups = $this->getGroups();
            $key = array_search($group, $groups);
            $params['groupid'] = $key;
        }
        
        return new Status($this->handleSendRequest('/de/api/set/grouptonewsletter/', $params));
    }

    /**
     * Remove a group of recipients from newsletter2go addressbook from newsletter.
     *
     * @param $newsletter int
     *            id
     *            or newsletter object.
     * @param $group string
     *            group name or group object.
     * @return \Newsletter2Go\Status
     */
    public function removeGroupFromNewsletter($newsletter, $group)
    {
        $params = array();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['nlid'] = $newsletter->getId();
        else
            $params['nlid'] = $newsletter;
        
        if ($group instanceof Group && $group->getId() > 0)
            $params['groupid'] = $group->getId();
        else {
            $groups = $this->getGroups();
            $key = array_search($group, $groups);
            $params['groupid'] = $key;
        }
        
        return new Status($this->handleSendRequest('/de/api/delete/groupfromnewsletter/', $params));
    }

    /**
     * Add all groups with recipients from newsletter2go addressbook to newsletter.
     * 
     * @param $newsletter int
     *            id
     *            or newsletter object.
     * @return \Newsletter2Go\Status
     */
    public function addAllGroupsNewsletter($newsletter)
    {
        $params = array();
        
        if ($newsletter instanceof Newsletter && $newsletter->getId() > 0)
            $params['nlid'] = $newsletter->getId();
        else
            $params['nlid'] = $newsletter;
        
        return new Status($this->handleSendRequest('/de/api/delete/allgroupsfromnewsletter/', $params));
    }
    
    // handles
    private function handleGetRequest($url, $params)
    {
        $params['key'] = $this->api_key;
        
        // Newsletter2Go API returns json format:
        $json = $this->http_request_curl('POST', $this->host, $this->port, $url, array(), $params);
        // convert json to php array:
        $json = json_decode($json, true);
        // return it to caller:
        
        if ($json['success'] == 0 || $json['status'] != 200 && $json['status'] != 201)
            throw new \Newsletter2Go\Newsletter2GoException('Error with n2g-communication: ' . $json['status'] . ' ' . $json['success']);
        
        return $json['value'];
    }

    private function handleSendRequest($url, $params)
    {
        $params['key'] = $this->api_key;
        // Newsletter2Go API returns json format:
        $json = $this->http_request_curl('POST', $this->host, $this->port, $url, array(), $params);
        // convert json to php array:
        $json = json_decode($json, true);
        // return it to caller:
        
        if ($json['success'] == 0 || $json['status'] != 200 && $json['status'] != 201)
            throw new \Newsletter2Go\Newsletter2GoException('Error with n2g-communication: ' . $json['status'] . ' ' . $json['success']);
        
        return $json;
    }

    private function http_request_curl($method, $host, $port, $path, $get, $post)
    {
        // Initialize session.
        $ch = curl_init();
        $prefix = "http://";
        if ($this->ssl) {
            $prefix = "https://";
        }
        
        curl_setopt($ch, CURLOPT_URL, $prefix . $host . $path);
        
        // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $postdata_str = '';
        foreach ($post as $k => $v) {
            $postdata_str .= urlencode($k) . '=' . urlencode($v) . '&';
        }
        $postdata_str = substr($postdata_str, 0, - 1);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata_str);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // Get the response and close the channel.
        $json = curl_exec($ch);
        curl_close($ch);
        return $json;
    }
}



