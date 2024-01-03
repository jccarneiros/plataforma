<?php

namespace App\Imports;

use App\Enums\SupportStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class CoordinationsImport implements ToModel
{
    /**
     * @param  array  $row
     * @return Model|Model[]|null
     */
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
                'role' => SupportStatus::CO,
                'name' => nameCase($row[0]),
                'email' => $row[1],
            ]);
        }
    }
}
