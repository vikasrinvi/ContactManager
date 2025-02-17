<?php

namespace App\Repositories;


use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAll()
    {
        return Contact::all();
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
        return Contact::destroy($id);
    }
}

