<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Models\RoomServices;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{

    public function __construct(Services $servicesModel, Room $roomModel, RoomServices $roomservicesModel)
    {
        $this->services = $servicesModel;
        $this->rooms = $roomModel;
        $this->roomservices = $roomservicesModel;
    }

    public function index()
    {
        $rooms =   $this->rooms->paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function edit($id)
    {
        $services = $this->services->all();
        $room = $this->rooms->find($id);
        $roomservices = RoomServices::where('room_id', $id)->get();
        return view('admin.rooms.edit', compact('room', 'services', 'roomservices'));
    }

    public function add()
    {
        $services = $this->services->all();
        return view('admin.rooms.add', compact('services'));
    }

    public function store(RoomRequest $request)
    {
        $dataCreate = [
            'room_no' => $request->room_no,
            'floor' => $request->floor,
            'detail' => $request->detail,
            'price' => $request->price,
            'image'=>$request->image,
        ];

        $rooms = $this->rooms->create($dataCreate);
        if ($request->service_id) {
            foreach ($request->service_id as $key => $value) {
                $dataCreatesee = [
                    'room_id' => $rooms->id,
                    'service_id' => $value,
                    'additional_price' => $request->additional_price[$key],
                ];
                $this->roomservices->create($dataCreatesee);
            }
        }
        return redirect()->route('rooms')->with('status', 'Thêm phòng thành công');
    }

    public function update($id, RoomRequest $request)
    {
        $dataUpdate = [
            'room_no' => $request->room_no,
            'floor' => $request->floor,
            'detail' => $request->detail,
            'price' => $request->price,
            'image'=>$request->image,
        ];
        $rooms = $this->rooms->find($id)->update($dataUpdate);
        $this->roomservices->where('room_id', $id)->delete();
        if ($request->service_id) {
            foreach ($request->service_id as $key => $value) {
                $dataUpdateSeriveRoom = [
                    'room_id' => $id,
                    'service_id' => $value,
                    'additional_price' => $request->additional_price[$key],
                ];
                $this->roomservices->create($dataUpdateSeriveRoom);
            }
        }
        return redirect()->route('rooms')->with('status', 'Cập nhật phòng thành công');
    }


    public function delete($id)
    {
        try {
            $this->roomservices->where('room_id', $id)->delete();
            $this->rooms->find($id)->delete();
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
