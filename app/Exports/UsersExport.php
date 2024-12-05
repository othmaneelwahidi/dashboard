<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        // Fetch users and map the data to match the desired export format
        return User::all(['name', 'email', 'role', 'created_at'])
            ->map(function ($row, $index) {
                return [
                    $index + 1,
                    $row->name,
                    $row->email,
                    $row->role,
                    $row->created_at,
                ];
            });
    }

    public function headings(): array
    {
        // Define the headings for the exported file
        return [
            '#',
            'Name',
            'Email',
            'Role',
            'Created At',
        ];
    }
}
