@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-semibold text-center mb-6">Contact Manager</h2>

    {{-- Success and Error Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('errors'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('errors') }}
        </div>
    @endif

    {{-- Failed Records (Scrollable) --}}
    @if(session('failed_records') && count(session('failed_records')) > 0)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 max-w-xl mx-auto">
            <h3 class="text-lg font-semibold mb-2">Failed Records:</h3>

            <!-- Fixed max height of 210px, scrollable inside -->
            <div class="max-h-[210px] overflow-y-auto border border-red-300 rounded p-2 bg-red-50" style="max-height: 210px;">
                <ul class="space-y-2">
                    @foreach(session('failed_records') as $failedRecord)
                        <li class="p-2 border border-red-300 rounded bg-white">
                            <p><strong class="text-red-600">Name:</strong> {{ $failedRecord['contact']['name'] ?? 'N/A' }}</p>
                            <p><strong class="text-red-600">Phone:</strong> {{ $failedRecord['contact']['phone'] ?? 'N/A' }}</p>
                            <p><strong class="text-red-600">Error:</strong> {{ $failedRecord['error'] ?? 'Unknown error' }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif







    {{-- Import & Export Contacts --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 align-left">
        <h4 class="text-lg font-semibold mb-4">Import & Export Contacts</h4>
        <div class="flex flex-wrap gap-4 items-center">
            <form action="{{ route('contacts.import.xml') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                @csrf
                <input type="file" name="file" class="border border-gray-300 rounded-md p-2 w-full md:w-auto" accept=".xml" required>
                <button type="submit" class="bg-gray-500 text-black py-2 px-4 rounded-md hover:bg-gray-700 transition">
                    Import XML
                </button>
            </form>

            <a href="{{ route('contacts.export.xml') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition">
                Download Sample XML
            </a>

            <a href="{{ route('contacts.create') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition">
                Create Contact
            </a>
        </div>

        
    </div>

    {{-- Contact List Table --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h4 class="text-lg font-semibold mb-4">Contact List</h4>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $contact->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $contact->phone_number }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('contacts.show', $contact->id) }}" 
                                       class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">
                                        View
                                    </a>
                                    <a href="{{ route('contacts.edit', $contact->id) }}" 
                                       class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>

</div>

@endsection
