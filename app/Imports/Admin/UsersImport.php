<?php

namespace App\Imports\Admin;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure, WithChunkReading
{
    use Importable, SkipsFailures;

    public static $allFailures = [];

    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(is_numeric($row[5])) {
            $birthday = Carbon::instance(Date::excelToDateTimeObject($row[5]));
        }
        else{
            $birthday = Carbon::createFromFormat('d/m/Y', $row[5])->format('Y-m-d');
        }
        return new User([
            'username' => $row[0],
            'password' => bcrypt($row[1]),
            'name' => $row[2],
            'role_id' => $row[3],
            'status' => $row[4],
            'birthday' => $birthday,
            'phone' => $row[6],
            'email' => $row[7],
            'address' => $row[8],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|max:20|unique:users,username',
            '1' => 'required|min:5|max:20',
            '2' => 'required|max:50',
            '3' => 'required|exists:roles,id',
            '4' => 'required',
            '5' => 'nullable|before_or_equal:today',
            '6' => 'nullable|digits:10|unique:users,phone',
            '7' => 'nullable|max:200|email|unique:users,email',
            '8' => 'nullable|max:500',
        ];
    }

    public function customValidationAttributes(): array
    {
        return [
            '0' => 'Tài khoản',
            '1' => 'Mật khẩu',
            '2' => 'Họ và tên',
            '3' => 'Vai trò',
            '4' => 'Trạng thái',
            '5' => 'Ngày sinh',
            '6' => 'Số điện thoại',
            '7' => 'Email',
            '8' => 'Địa chỉ',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        self::$allFailures = array_merge(self::$allFailures, $failures);
    }

    public function chunkSize(): int
    {
        return 1;
    }
}
