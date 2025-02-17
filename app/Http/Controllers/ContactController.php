<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAllContacts();
        return view('contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $this->contactService->createContact($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
