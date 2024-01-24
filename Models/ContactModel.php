<?php

class Contacts
{
    private $Name;
    private $Email;
    private $PhoneNumber;

    private $contactsFile = 'contacts.txt';

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber($PhoneNumber)
    {
        $this->PhoneNumber = $PhoneNumber;
    }

    public function addContact($contact)
    {
        $serializedContact = serialize($contact);
        file_put_contents($this->contactsFile, $serializedContact . PHP_EOL, FILE_APPEND);
        return true;
    }

    public function editContact($name, $newContact)
    {
        $contacts = $this->getContacts();

        $index = $this->findContactIndex($contacts, $name);

        if ($index !== false) {
            $contacts[$index] = $newContact;

            $this->saveContacts($contacts);

            return true; 
        }

        return false; // Return false if contact not found
    }

    private function findContactIndex($contacts, $name)
    {
        foreach ($contacts as $index => $contact) {
            if ($contact->getName() === $name) {
                return $index; 
            }
        }

        return false; // Return false if contact not found
    }

    public function deleteContact($contact)
    {
        $contacts = $this->getContacts();

        $contacts = array_filter($contacts, function ($c) use ($contact) {
            return $c != $contact;
        });

        $this->saveContacts($contacts);

        return true;
    }

    private function getContacts()
    {
        if (file_exists($this->contactsFile)) {
            $serializedContacts = file($this->contactsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            return array_map('unserialize', $serializedContacts);
        } else {
            return [];
        }
    }

    private function saveContacts($contacts)
    {
        $serializedContacts = array_map('serialize', $contacts);
        file_put_contents($this->contactsFile, implode(PHP_EOL, $serializedContacts));
    }

    public function checkExistingEmail($email) 
    {
    $existingEmails = $this->getAllEmails();

    return in_array($email, $existingEmails);
    }

    private function getAllEmails()
    {
        $contacts = $this->getContacts();
    
        if (empty($contacts)) {
            return [];
        }
    
        $emails = array_column($contacts, 'Email');
    
        return $emails;
    }

    public function checkEmailAndPhone($email, $phone)
    {
        $contactsData = file_get_contents($this->contactsFile);
        $contacts = unserialize($contactsData);

        if ($contacts instanceof Contacts) {
            $storedEmail = $contacts->getEmail();
            $storedPhone = $contacts->getPhoneNumber();

            if ($email === $storedEmail && $phone === $storedPhone) {
                return $contacts;
            }
        }

        return null;
    }



}
?>