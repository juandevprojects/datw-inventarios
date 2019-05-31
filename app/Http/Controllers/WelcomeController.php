<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function __invoke()
    {
        return view('welcome');
    }
}
