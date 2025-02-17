@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Add New Contact</h2>

    <div class="bg-white p-6 shadow-lg rounded-lg">
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="first_name" class="w-full p-3 border rounded" placeholder="First Name" required>
                <input type="text" name="last_name" class="w-full p-3 border rounded" placeholder="Last Name">
            </div>
            <input type="number" name="phone_number" class="w-full p-3 border rounded mb-4" placeholder="Phone Number" required>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Add Contact</button>
        </form>
    </div>
</div>
@endsection
