<?php
namespace App\Contact\Entity;

use App\Contact\IpAnonymizer;
use ClientX\Entity\Timestamp;

class Contact
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $anonymizedIp;

    private string $subject;

    use Timestamp;

    public function getId():?int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName():?string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail():?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getContent():?string
    {
        return $this->content;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getIp():?string
    {
        return $this->ip;
    }
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    public function setRawIp(?string $ip)
    {
        $this->ip = $ip;
    }

    public function setAnonymizedIp(string $ip)
    {
        return  $this->setRawIp($ip);
    }

    public function getSubject():string
    {
        return $this->subject;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;

        return $this;
    }
}
