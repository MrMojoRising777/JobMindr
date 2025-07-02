<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,txt',
        ]);

        Excel::import(new ExcelImport(), $request->file('file'));

        return back()->with('success', 'Import successful!');
    }
}
