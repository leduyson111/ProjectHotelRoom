<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;
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

        $services = $this->services->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function add()
    {
        return view('admin.services.add');
    }

    public function store(ServicesRequest $request)
    {
        $dataCreate = [
            'name' => $request->name,
            'icon' => $request->icon
        ];
    
        $this->services->create($dataCreate);
        return redirect()->route('services')->with('status', 'Thêm dịch vụ thành công');
    }

    public function edit($id)
    {
        $service = $this->services->find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update($id, ServicesRequest $request)
    {
        $dataUpdate = [
            'name' => $request->name,
            'icon' => $request->icon
        ];

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
