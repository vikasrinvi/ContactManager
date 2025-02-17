<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use SimpleXMLElement;

class ImportController extends Controller
{
    public function importXML(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xml']);

        $xmlString = file_get_contents($request->file('file')->getPathname());
        $xml = new SimpleXMLElement($xmlString);

        foreach ($xml->contact as $contact) {
            Contact::create([
                'first_name' => preg_replace('/[^a-zA-Z]/', '', $contact->name),
                'last_name' => '',
                'phone_number' => (string)$contact->phone,
            ]);
        }

        return response()->json(['message' => 'Contacts imported successfully']);
    }
}

