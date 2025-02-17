<?php


namespace App\Services;

use App\Repositories\ContactRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class ImportExportService
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function exportXML()
    {
        // $contacts = $this->contactRepository->getAll();
        // $xml = new SimpleXMLElement('<contacts/>');

        // foreach ($contacts as $contact) {
        //     $contactXML = $xml->addChild('contact');
        //     $contactXML->addChild('first_name', $contact->first_name);
        //     $contactXML->addChild('last_name', $contact->last_name);
        //     $contactXML->addChild('phone', $contact->phone);
        // }

        // $fileName = 'contacts_' . now()->format('YmdHis') . '.xml';
        // Storage::put("public/exports/{$fileName}", $xml->asXML());


        $contacts = [
            ["name" => "Kökten Adal", "phone" => "+90 333 8859342"],
            ["name" => "Hamma Abdurrezak", "phone" => "+90 333 1563682"],
            // Add more contacts here
        ];

        $xml = new SimpleXMLElement("<contacts/>");
        foreach ($contacts as $contact) {
            $entry = $xml->addChild("contact");
            $entry->addChild("name", $contact['name']);
            $entry->addChild("phone", $contact['phone']);
        }

        $fileName = "sample_contacts.xml";
        Storage::put("$fileName", $xml->asXML());
        return response()->download(storage_path("app/public/$fileName"));


        // return response()->download(storage_path("app/public/exports/{$fileName}"))->deleteFileAfterSend();
    }

    public function importXML($file)
    {
        $xmlContent = simplexml_load_file($file);
        $data = [];
        $failedRecords = [];

        foreach ($xmlContent->contact as $contact) {
            $firstName = (string) $contact->first_name;
            $lastName = (string) $contact->last_name;
            $phone = (string) $contact->phone;

            if (empty($firstName) || empty($lastName) || empty($phone)) {
                $failedRecords[] = $contact;
                continue;
            }

            $data[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            $this->contactRepository->bulkInsert($data);
        }

        return back()->with([
            'success' => count($data) . ' contacts imported successfully.',
            'errors' => count($failedRecords) . ' contacts failed to import.'
        ]);
    }
}
