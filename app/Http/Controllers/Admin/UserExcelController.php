<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\UsersTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\Admin\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserExcelController extends Controller
{
    public function import(Request $request){
        try{
            $import = new UsersImport();
            $import->import($request->file('file'));
            if (!empty(UsersImport::$allFailures)) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.import_success_with_error'),
                    'errors' => UsersImport::$allFailures,
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => __('messages.import_success'),
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    public function downloadTemplate()
    {
        try{
            $filename = 'mau-import-tai-khoan.xlsx';
            return Excel::download(new UsersTemplateExport, $filename);
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}
