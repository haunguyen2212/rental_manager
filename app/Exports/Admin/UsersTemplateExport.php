<?php

namespace App\Exports\Admin;

use App\Repositories\RoleRepository;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersTemplateExport implements FromArray, WithHeadings, WithColumnWidths
{

    protected $roleRepository;

    public function __construct(){
        $this->roleRepository = app(RoleRepository::class);
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        $roles = $this->roleRepository->getDropdown(false);
        return [
            "A" => "Tài khoản",
            "B" => "Mật khẩu",
            "C" => "Họ và tên",
            "D" => "Vai trò \n" . describe_array($roles),
            "E" => "Trạng thái \n" . describe_array(USER_STATUS),
            "F" => "Ngày sinh",
            "G" => "Số điện thoại",
            "H" => "Email",
            "I" => "Địa chỉ",
        ];
    }

    /**
    * @return array
    */
    public function array(): array
    {
        return [
            [
                "user01",
                "123456",
                "Nguyễn Văn A",
                2,
                1,
                "1/1/1990",
                "0901234567",
                "user01@example.com",
                "123 Đường ABC, TP.HCM",
            ]
        ];
    }

    /**
    * @return array
    */
    public function columnWidths(): array
    {
        return [
            "A" => 15,
            "B" => 15,
            "C" => 20,
            "D" => 30,
            "E" => 30,
            "F" => 15,
            "G" => 15,
            "H" => 25,
            "I" => 35,
        ];
    }
}
