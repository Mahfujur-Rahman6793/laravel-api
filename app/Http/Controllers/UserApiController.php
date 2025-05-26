<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function index($id = null){
        if($id == ''){
            $data = User::get();
            $response = [
                'status' => 'success',
                'data' => $data
            ];
            return response()->json($response, 200);

        }
        else{
            $data = User::findorFail($id);
            $response = [
                'status' => 'success',
                'data' => $data
            ];
            return response()->json($response, 200);
        }
    }
    public function store(Request $request){
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        $response = [
            'status' => 'success',
            'data' => $user
        ];
        return response()->json($response, 201);
    }
    public function mul_store(Request $request){
        $datas = $request->all();
        foreach($datas['users'] as $data){
            // $user = new User();
            // $user->name = $data['name'];
            // $user->email = $data['email'];
            // $user->password = bcrypt($data['password']);
            // $user->save();
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
        }
        $response = [
            'status' => 'success',
            'message' => 'Users created successfully'
        ];
        return response()->json($response, 201);
    }
    public function update(Request $request, $id){
        $data = $request->all();
        $user = User::findorFail($id);
        if(isset($data['name'])){
            $user->name = $data['name'];
        }
        if(isset($data['email'])){
            $user->email = $data['email'];
        }
        if(isset($data['password'])){
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        $response = [
            'status' => 'success',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    public function destroy($id){
        $user = User::findorFail($id);
        $user->delete();
        $response = [
            'status' => 'success',
            'message' => 'User deleted successfully'
        ];
        return response()->json($response, 200);
    }
        
}
