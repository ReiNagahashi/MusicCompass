<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;

class SocialAuthFacebookController extends Controller
{
      /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
  public function redirectToProvider()
  {
      return Socialite::driver('facebook')->stateless()->redirect();
  }
  /**
   * Return a callback method from facebook api.
   *
   * @return callback URL from facebook
   */
  public function handleProviderCallback()
  {
      $user = Socialite::driver('facebook')->stateless()->user();
  }
}
