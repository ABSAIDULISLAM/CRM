<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lead;
use App\Models\LeadOwner;
use App\Models\OfficeStuff;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalLeads = Lead::count();
        $marketingOfficers = LeadOwner::count();
        $officeStuffs = OfficeStuff::count();
        return view('admin.home.index', compact(['totalClients','totalLeads', 'marketingOfficers', 'officeStuffs']));
    }

    public function profile()
    {
        return view('admin.profile');
    }
}
