<?php


namespace App\Services;

use App\Repositories\ContactRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContacts()
    {
        return $this->contactRepository->getAll();
    }

    public function createContact($data)
    {
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20|unique:contacts',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return $this->contactRepository->create($data);
    }

    public function deleteContact($id)
    {
        return $this->contactRepository->delete($id);
    }

    private function validateContact($data, $id = null)
    {
        $rules = [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20|unique:contacts,phone_number,' . $id,
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function updateContact($id, $data)
    {
        $this->validateContact($data, $id);

        return $this->contactRepository->update($id, $data);
    }

    public function getContactById($id)
    {
        return $this->contactRepository->findById($id);
    }


}
