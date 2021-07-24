<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ServicesController extends Controller
{

    public function __construct(Services $servicesModel)
    {
        $this->services = $servicesModel;
    }

    public function index()
    {

        $services = $this->services->all();

        return view('admin.services.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.add');
    }

    public function store(Request $request)
    {
        $dataCreate = [ 'name' => $request->name  ];
        // if ($request->hasFile('icon')) {
        //     $path = $request->file('icon')->storeAs('public/uploads/services', uniqid() . '-' . $request->icon->getClientOriginalName());
        //     $dataCreate['icon'] = str_replace('public/', '', $path);
        // }
        if ($request->hasFile('icon')) {
            $file  =$request->icon;
            $fileNameHash = Str::random(20).'.'.$file->getClientOriginalExtension();
            $filePath = $request->file('icon')->storeAs('public/services', $fileNameHash);
            $dataCreate[ 'icon' ] = Storage::url($filePath);
        }
        $this->services->create($dataCreate);
        return redirect()->route('services')->with('status', 'Thêm dịch vụ thành công');
    }

    public function edit($id)
    {
        $service = $this->services->find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update($id, Request $request)
    {
        $dataUpdate = [
            'name' => $request->name,
        ];
        if ($request->hasFile('icon')) {
            $file  =$request->icon;
            $fileNameHash = Str::random(20).'.'.$file->getClientOriginalExtension();
            $filePath = $request->file('icon')->storeAs('public/services', $fileNameHash);
            $dataUpdate[ 'icon' ] = Storage::url($filePath);
        }

        $this->services->find($id)->update($dataUpdate);
        return redirect()->route('services')->with('status', 'Cập nhật dịch vụ thành công');
    }

    public function delete($id)
    {
        try {
            $this->services->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("message" . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], 500);
        }
    }
}
