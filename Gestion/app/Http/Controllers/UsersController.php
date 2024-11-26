<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
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

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      //
  }

  /**
   * Store user
   */
  public function store(Request $request)
  {
    Log::debug($request);
    try{
      $newUser = new User();
      $newUser->email = $request->userEmail;
      $newUser->role = $request->userRoleModal;
      $newUser->password = Hash::make('Secret1234!');
      $newUser->save();
      return redirect()->route('users.settings')
      ->with('message',__('settings.successAddUser'));
    }
    catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('users.settings')
      ->withErrors('message',__('global.storeFailed'));
    }
  }

  public function checkEmailUser(Request $request)
  {
    $email = $request->input('email'); 
    $exists = User::where('email', $email)->exists();
    return response()->json(['exists' => $exists]);
  }


  public function checkNumbersOfAdmin()
  {
    $usersAdminCount = User::where('role', 'admin')->count();
    return response()->json(['count' => $usersAdminCount]);
  }

  /**
   * Display settings.
   */
  public function show()
  {
    $users = User::all();
    return View('users.settings',compact('users'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
      //
  }

  /**
   * Update users
   */
  public function updateUser(Request $request)
  {
    //Log::debug($request);
    $user = User::all();
    $usersIds = $request->usersIds;
    $userRoles = $request->userRolesShow;
    $usersWithRoles = collect($usersIds)
      ->combine($userRoles)
      ->toArray();
    try {
      foreach ($usersWithRoles as $userId => $role) {
        $userFound = User::find($userId);
        if ($userFound) {
          $userFound->role = $role;
          $userFound->save();
        }
      }
      $existingUsersIds = $user->pluck('id')->toArray();
      $userIdsToDelete = array_diff($existingUsersIds, $request->usersIds);
      Log::debug($userIdsToDelete);
      foreach ($userIdsToDelete as $idToDelete) {
        $userToDelete = User::findOrFail($idToDelete);
        $userToDelete->delete();
      }
      return redirect()->route('users.settings')
      ->with('message', __('settings.successUpdateUsers'));
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('users.settings')
      ->withErrors('message', __('global.updateFailed'));
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
