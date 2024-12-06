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
        // Fetch users with their roles
        return User::with('role') 
            ->get()
            ->map(function ($user, $index) {
                return [
                    $index + 1,                      
                    $user->name,                     
                    $user->email,                    
                    $user->role->name ?? 'N/A',      
                    $user->created_at->format('Y-m-d H:i:s'), 
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
