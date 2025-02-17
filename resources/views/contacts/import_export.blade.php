@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Import/Export Contacts</h2>

    <!-- Export Button -->
    <a href="{{ route('export.xml') }}" class="btn btn-primary">Export XML</a>

    <!-- Import Form -->
    <form action="{{ route('import.xml') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <label>Select XML File:</label>
        <input type="file" name="xml_file" class="form-control">
        @error('xml_file')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success mt-2">Import</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if(session('errors'))
        <div class="alert alert-danger mt-3">{{ session('errors') }}</div>
    @endif
</div>
@endsection
