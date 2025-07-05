<?php

namespace App\Imports;

use App\Models\Application;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isEmpty()) {
                continue;
            }

            Log::info('Imported row:', $row->toArray());

            $company = new Company();
            $company->name = $row['company_name'];
            $company->street = '';
            $company->housenr = '';
            $company->zipcode = '';
            $company->region = '';
            $company->city = $row['location'];
            $company->country = '';
            $company->sector = '';
            $company->save();

            $application = new Application();
            $application->user_id = Auth::id();
            $application->company_id = $company->id;
            $application->position = $row['position'];
            $application->description = '';
            $application->found_on = '';
            $application->link = $row['link_to_job_application'] ?? '';
            $application->status = $row['status'];
            $cleanDate = preg_replace('/\s*\(.*?\)\s*/', '', $row['date_applied']);
            $application->applied_at = Carbon::parse($cleanDate)->format('Y-m-d');
            $application->notes = $row['notes'] || $row['reason_for_denial']
                ? trim(($row['notes'] ?? '') . ' ' . ($row['reason_for_denial'] ?? ''))
                : null;
            $application->save();
        }
    }
}
