<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Supplier;
use App\Models\Attachment;

class AttachmentsController extends Controller
{
  const USING_FILESTREAM = false;

  public function show($supplier_id, $attachment_id){
    $supplier = Supplier::findOrFail($supplier_id);
    $attachment = Attachment::findOrFail($attachment_id);

    if(!(self::USING_FILESTREAM)){
      $directory = $supplier->id;
      $filename = $attachment->name . "." . $attachment->type;
      $path = env('FILE_STORAGE_PATH'). "\\". $directory . "\\" . $filename;
      Log::debug($path);

      if (!file_exists($path)) {
        abort(404);
      }

      return response()->file($path, [
        'Content-Type' => mime_content_type($path),
        'Content-Disposition' => 'inline; filename="' . $filename  . '"',
      ]);
    }
  }
}
