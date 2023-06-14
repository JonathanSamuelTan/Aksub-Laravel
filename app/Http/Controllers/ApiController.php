<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\ValidationException;



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
            'data' => $driver,
            'user' => auth()->user()
        ]);
    }

    // Read
    public function index(){
        $drivers = Driver::all();

        return response()->json([
            'message' => 'success',
            'data' => $drivers,
            'user' => auth()->user()
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
            'data' => $driver,
            'user' => auth()->user()
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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'success',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'failed',
                'data' => $exception->errors(),
            ], 422);
        }
    }


    // login
    public function login(Request $request){
        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => 'The provided credentials are incorrect.',
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'success',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'failed',
                'data' => $exception->errors(),
            ], 401);
        }
    }


    


}
