<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showcustomerDashboard(){
        return view("Customer.userDashboard");
    }

    public function addPatient(){
        return view("Customer.add_patient");
    }

}
