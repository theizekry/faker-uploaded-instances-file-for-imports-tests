<?php

namespace App\FakerUploadedInstanceGenerator\Controllers;

use App\FakerUploadedInstanceGenerator\Imports\UsersImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportsUserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Facades\Excel;

class UserImportsController extends Controller
{
    /**
     * @param ImportsUserRequest $request
     *
     * @return JsonResponse
     */
    public function import(ImportsUserRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        return response()->json('All Done!', 200);
    }
}