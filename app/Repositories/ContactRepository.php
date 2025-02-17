<?php

namespace App\Repositories;


use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAll($perPage = 10)
    {

        return Contact::paginate($perPage);
    }

    public function findById($id)
    {
        return Contact::findOrFail($id);
    }

    public function create(array $data)
    {
        return Contact::create($data);
    }

    public function update($id, array $data)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($data);
        return $contact;
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        return $contact->delete();
        
    }

    public function bulkInsert($name, $phone)
    {
        // Check if contact already exists
        $exists = Contact::where('phone_number', $phone)->exists();
        if ($exists) {
            return false;
        }

        $contact = new Contact();
        $contact->name = $name;
        $contact->phone_number = $phone;
        $contact->save(); 
        return true;
    }
}

