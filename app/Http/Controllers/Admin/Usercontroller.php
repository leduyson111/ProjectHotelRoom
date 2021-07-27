<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Usercontroller extends Controller
{
   public function __construct(User $user)
   {
      $this->user = $user;
   }


   public function index()
   {

      $users = $this->user->paginate(15);

      return view('admin.users.index', compact('users'));
   }

   public function add()
   {

      return view('admin.users.add');
   }

   public function store(Request $request)
   {


      $this->user->create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'phone_number' => $request->phone_number,
         'avatar' => $request->avatar,
      ]);
      return redirect()->route('users')->with('status', 'Thêm thành viên thành công');
   }


   public function update($id , Request $request){
      $this->user->find($id)->update([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'phone_number' => $request->phone_number,
         'avatar' => $request->avatar,
      ]);
      return redirect()->route('users')->with('status', 'Cập nhật thành viên thành công');
   }

   public function delete($id){
      try {
         $this->user->find($id)->delete();
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

   public function profile($id){

      $user = $this->user->find($id);
      return view('admin.users.profile' ,compact('user'));
   }


}
