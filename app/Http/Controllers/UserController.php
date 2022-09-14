<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function showAllUsers()
    {
        try {
            $data = User::orderBy('id', 'DESC')->get();
            return response()->json([
                'status' => true,
                'message' => "User data listed successfully...",
                'data' => $data
            ],200); 
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Opps something went to wrong.."
            ],400);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'dob' => 'date',
                'color' => 'required'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->color = $request->color;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => "User data created successfully...",
                'data' => $user
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Opps something went to wrong.."
            ],400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $userID = $request->id;
            
            $update_data = User::find($userID);

            if($update_data)
            {
                if($request->name != null && $request->name != '') {
                    $update_data->name = $request->name;
                }

                if($request->email != null && $request->email != '') {
                    $update_data->email = $request->email;
                }

                if($request->dob != null && $request->dob != '') {
                    $update_data->dob = $request->dob;
                }

                if($request->color != null && $request->color != '') {
                    $update_data->color = $request->color;
                }
                
                $update_data->save();
                return response()->json([
                    'status' => true,
                    'message' => "User data updated successfully...",
                    'data' => $update_data
                ],200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User not found....!!"
                ],400);  
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Opps something went to wrong.."
            ],400); 
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $userID = $request->id;
            $delete_user = User::find($userID);
            if($delete_user) {
                $delete_user->delete();
                return response()->json([
                    'status' => true,
                    'message' => "User deleted successfully..."
                ],200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User not found"
                ],400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "User not found"
            ],400);
        }
    }
}
