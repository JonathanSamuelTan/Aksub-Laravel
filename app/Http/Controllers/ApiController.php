<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\User;


class ApiController extends Controller
{
    // Create
    public function store(Request $request){
        $driver = Driver::Create([
            'name' => $request->name,
            'team' => $request->team,
            'picture' => 'Api.jpeg'           
         ]);

         return response()->json([
            'message' => 'success',
            'data' => $driver
        ]);
    }

    // Read
    public function index(){
        $drivers = Driver::all();

        return response()->json([
            'message' => 'success',
            'data' => $drivers
        ]);
    }

    // update
    public function update(Request $request, string $id){
        $driver = Driver::find($id);
        $pict = $driver->picture;
        $driver->name = $request->name;
        $driver->team = $request->team;
        $driver->picture = $pict;
        $driver->save();

        return response()->json([
            'message' => 'success',
            'data' => $driver
        ]);
    }

    // delete
    public function destroy(string $id){
        $driver = Driver::find($id);
        $driver->delete();

        return response()->json([
            'message' => 'success',
            'data' => null
        ]);
    }

    // register
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)           
         ]);

         $token = $user->createToken('auth_token')->plainTextToken;

         return response()->json([
            'message' => 'success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    // login
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'failed',
                'data' => 'Unauthorized'
            ], 401);
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    


}
