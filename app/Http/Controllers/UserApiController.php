<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
         try {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Name Is Required',
            'email.required' => 'Email Is Required',
            'email.email' => 'Email Must Be Valid',
            'email.unique' => 'Email Must Be Unique',
            'password.required' => 'Password Is Required'
        ];

        $request->validate($rules, $customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 201);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'errors' => $e->errors()
        ], 422);
    }
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
