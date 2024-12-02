<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Setting;
use App\Models\EmailModel;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Session;

class UsersController extends Controller
{
  public function showLogin()
  {
    return View('users.login');
  }

  public function login(LoginRequest $request)
  {
    $reussi = Auth::attempt(['email' => $request->email,'password' => $request->password]);
    if($reussi){
      return redirect()->route('suppliers.index')->with('message',__('login.successfulLogin'));
    }
    else{
      return redirect()->route('login')->with('errorMessage',__('login.wrongCredentials'));
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login')->with('message',__('login.successfulLogout'));
  }  

  public function show()
  {
    $users = User::all();
    $settings = Setting::first();
    $mailModel = EmailModel::all();
    $supplier = new Supplier();
    $supplier->neq = 1111111111;
    $supplier->name = "Entreprise Demo";
    $supplier->email = "EntrepriseDemo@exemple.com";
    $supplier->site = "www.EntrepriseDemo.com";
    return View('settings.settings',compact('users', 'settings', 'mailModel', 'supplier'));
  }

  public function updateUser(UserUpdateRequest $request)
  {
    $usersIds = $request->usersIds;
    $userRoles = $request->userRolesShow;
    $usersWithRoles = collect($usersIds)
      ->combine($userRoles)
      ->toArray();
    $newUserEmails = $request->userEmails;
    try {
      $existingUsersIds = User::pluck('id')->toArray();
      $userIdsToKeep = array_filter($usersIds, fn($id) => $id != -1); 
      $userIdsToDelete = array_diff($existingUsersIds, $userIdsToKeep);
      foreach ($userIdsToDelete as $idToDelete) {
        $userToDelete = User::findOrFail($idToDelete);
        $userToDelete->delete();
      }
      
      $newEmailIndex = 0;
      foreach ($usersWithRoles as $userId => $role) {
        if ($userId == -1) {
          $newUser = new User();
          $newUser->email = $newUserEmails[$newEmailIndex]; 
          $newUser->password = Hash::make('Secret1234!');
          $newUser->role = $role;
          $newUser->save();
          $newEmailIndex++;
        } else {
          $userFound = User::findOrFail($userId);
          if ($userFound) {
            $userFound->role = $role;
            $userFound->save();
          }
        }
      }
      return redirect()->route('users.settings')
      ->with('message', __('settings.successUpdateUsers'));
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('users.settings')
      ->withErrors('message', __('global.updateFailed'));
    }
  }
}
