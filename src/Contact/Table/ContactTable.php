<?php
namespace App\Contact\Table;

use App\Contact\Entity\Contact;
use ClientX\Database\Query;
use ClientX\Database\Table;

class ContactTable extends Table
{

    protected $table = "contacts";
    protected $entity = Contact::class;
    protected $element = "subject";

    public function findLastRequestForIp(string $ip):?Contact
    {
        $result = $this->makeQuery()
        ->where("c.anonymized_ip = :ip")
        ->params(['ip' => $ip])
        ->order('id DESC')
        ->fetch();
        return $result === false ? null : $result;
    }

    public function insertContact(Contact $contact)
    {
        return $this->insert([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'content' => $contact->getContent(),
            'anonymized_ip' => $contact->getIp(),
            'subject'       => $contact->getSubject()
        ]);
    }
}
