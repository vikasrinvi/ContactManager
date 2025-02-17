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

    }


    public function importXML($file)
	{
		$xmlContent = simplexml_load_file($file);
	    $failedRecords = [];
	    $successCount = 0;

	    foreach ($xmlContent->contact as $contact) {
	        $name = (string) $contact->name;
	        $phone = (string) $contact->phone;

	        if (empty($name) || empty($phone)) {

	            $failedRecords[] = [
	                'contact' => [
		                'name' => $name,
		                'phone' => $phone
		            ],
	                'error' => 'Missing required fields (First Name, Last Name, or Phone).'
	            ];
	            continue;
	        }

	        // Call repository method to insert, checking for duplicates
	        $inserted = $this->contactRepository->bulkInsert($name, $phone);

	        if ($inserted) {
	            $successCount++;
	        } else {
	        	$failedRecords[] = [
                	'contact' => [
		                'name' => $name,
		                'phone' => $phone
		            ],
	                'error' => 'Duplicate contact with the same phone number exists.'
	            ];
	        }
	    }
	    return back()->with([
	        'success' => $successCount . ' contacts imported successfully.',
	        'errors' => count($failedRecords) . ' contacts failed to import.',
        	'failed_records' => $failedRecords,
	    ]);

	}
}
