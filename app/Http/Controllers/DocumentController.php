<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download($id)
    {
        $document = Document::findOrFail($id);
        $document->increment('download_count');

        return Storage::disk('public')->download($document->file_path);
    }
}
