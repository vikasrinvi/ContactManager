<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\ImportExportService;
use Illuminate\Support\Facades\Validator;

class ImportExportController extends Controller
{
    protected $importExportService;

    public function __construct(ImportExportService $importExportService)
    {
        $this->importExportService = $importExportService;
    }

    public function exportXML()
    {
        return $this->importExportService->exportXML();
    }

    public function importXML(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xml|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        return $this->importExportService->importXML($request->file('file'));
    }
}
