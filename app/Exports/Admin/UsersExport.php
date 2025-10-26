<?php

namespace App\Exports\Admin;

use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $data;
    protected $roleRepository;

    public function __construct(Collection $data)
    {
        $this->data = $data;
        $this->roleRepository = app(RoleRepository::class);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        $roles = $this->roleRepository->getDropdown(false);
        return [
            "ID",
            "Tài khoản",
            "Họ và tên",
            "Vai trò \n" . describe_array($roles),
            "Trạng thái \n" . describe_array(USER_STATUS),
            "Ngày sinh",
            "Số điện thoại",
            "Email",
            "Địa chỉ",
        ];
    }
}
