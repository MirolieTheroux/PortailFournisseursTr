<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
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
      return redirect()->route('suppliers.index')->with('message',"Connexion réussie");
    }
    else{
      return redirect()->route('users.showLogin')->with('errorMessage',__('login.wrongCredentials'));
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('users.showLogin')->with('message',"Déconnexion réussie");
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
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
