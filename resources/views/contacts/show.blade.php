@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Contact Details</h2>

    <div class="bg-white p-6 shadow-lg rounded-lg">
        <p><strong>ID:</strong> {{ $contact->id }}</p>
        <p><strong>Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
        <p><strong>Phone Number:</strong> {{ $contact->phone_number }}</p>

        <a href="{{ route('contacts.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
    </div>
</div>
@endsection
