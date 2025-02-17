@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Edit Contact</h2>

    <div class="bg-white p-6 shadow-lg rounded-lg">
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="first_name" class="w-full p-3 border rounded" value="{{ $contact->first_name }}" required>
                <input type="text" name="last_name" class="w-full p-3 border rounded" value="{{ $contact->last_name }}">
            </div>
            <input type="text" name="phone_number" class="w-full p-3 border rounded mb-4" value="{{ $contact->phone_number }}" required>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Update Contact</button>
        </form>
    </div>
</div>
@endsection