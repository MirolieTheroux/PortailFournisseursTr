<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{ 
  public function updateSettings(SettingsUpdateRequest $request){
    Log::debug($request);
    try{
      $settings = Setting::first();
      $settings->approbation_email = $request->approverEmail;
      $settings->finance_email = $request->financesEmail;
      $settings->file_max_size = $request->maxSizeFiles;
      $settings->revision_delay = $request->timeBeforeRevisionMonth;
      $settings->save();
      return redirect()->route('users.settings')
      ->with('message',__('settings.successUpdateSettings'))
      ->header('Location', route('users.settings') . '#settings-section');
    }
    catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('users.settings')
        ->withErrors('message',__('global.updateFailed'));
    }
  }
}
