<?php

namespace App\Http\Controllers;

// Import class Controller dasar dari framework Laravel
use Illuminate\Routing\Controller as BaseController; 

abstract class Controller extends BaseController 
{
    // Sekarang, AdminController (dan controller lain yang extends Controller)
    // akan mewarisi semua method dasar seperti middleware(), validate(), dll.
}