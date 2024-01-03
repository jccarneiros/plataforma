<?php

namespace App\Imports;

use App\Enums\SupportStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class SupervisionsImport implements ToModel
{
    public function model(array $row)
    {
        $exist = DB::table('users')->where('email', '=', $row[1])->exists();
        if ($exist) {
            DB::table('users')->where('email', '=', $row[1])->update([
                'name' => nameCase($row[0]),
            ]);
        } else {
            return new User([
                'admin' => 1,
                'role' => SupportStatus::SU,
                'name' => nameCase($row[0]),
                'email' => $row[1],
            ]);
        }
    }
}
