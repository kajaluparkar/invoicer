<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class DashborardController extends Controller
{
    public function _construct(){

        $this->middleware('auth');
    }

    public function index(){
        $invoices = Invoice::with('customer')->get();

        return view('dashboard',compact('invoices'));
    }

}
