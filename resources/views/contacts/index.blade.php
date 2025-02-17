@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Contact Manager</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 mb-3">
        <h4>Add New Contact</h4>
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                </div>
                <div class="col-md-4">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Contact</button>
        </form>
    </div>

    <div class="card p-4">
        <h4>Contact List</h4>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->phone_number }}</td>
                        <td>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card p-4 mt-3">
        <h4>Import & Export Contacts</h4>
        <form action="{{ route('contacts.import.xml') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-3">
            @csrf
            <input type="file" name="file" class="form-control w-auto" accept=".xml" required>
            <button type="submit" class="btn btn-success">Import XML</button>
        </form>

        <a href="{{ route('contacts.export.xml') }}" class="btn btn-secondary mt-3">Download Sample XML</a>
    </div>
</div>

@endsection
