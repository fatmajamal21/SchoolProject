<?php

namespace App\Http\Controllers\stages;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Stage;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class StageCotroller extends Controller
{
    function index()
    {
        return view('dashboard.grades.index');
    }

    function create()
    {
        $stages = Stage::all();
        return view('dashboard.grades.create', compact('stages'));
    }

    public function add(Request $request)
    {
        dd($request->all());

        $request->validate(
            [
                'name' => 'required|unique:grades,name',
                'stage' => 'required',
            ],
            [
                'name.required' => 'الرجاء إدخال حقل الاسم!',
                'name.unique' => 'الرجاء إدخال اسم غير مكرر.',
                'stage.required' => 'الرجاء إدخال حقل المرحلة.',
            ]
        );

        Grade::create([
            'name' => $request->name,
            'stage_id' => $request->stage,
        ]);


        return 'تم الإضافة بنجاح!';
    }
}
