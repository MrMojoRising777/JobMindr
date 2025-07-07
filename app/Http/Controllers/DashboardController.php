<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $weekQuery = Application::where('applied_at', '>=', now()->subDays(7));

        $applications = $weekQuery->get();
        $rejectedApplications = $weekQuery->where('status', 'rejected')->where('updated_at', '>=', now()->subDays(7))->get();

        return view('dashboard', compact('applications', 'rejectedApplications'));
    }
}
