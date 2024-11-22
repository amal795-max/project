<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserName extends Controller
{
   //الطلب الاول
        public function showList(Request $request){
    
            $file_content = file_get_contents('C:\xampp\htdocs\user.json');
            $users = json_decode($file_content,true);
    
            $capitalizedUsers = array_map(function ($user) {
                $user['name'] = ucwords($user['name']);
                return $user;
            }, $users);
    
            $names = array_column($capitalizedUsers, 'name');
            return response()->json($names);
        }
    //الطلب الثاني
    
        public function isCorrect(Request $request){
            $entered = $request->validate([
                'email' => 'nullable|email',
                 'phone' => 'nullable|string'
            ]);
            if(! $entered){
                return response()->json([
                    'message' => "you must have enter the email or phone number"
                ]);
            }
            $file_content = file_get_contents('C:\xampp\htdocs\user.json');
            $users = json_decode($file_content,true);
    
            $exists = collect($users)->contains(function ($user) use ($request) {
                            return ($request->email && $user['email'] === $request->email) &&
                                   ($request->phone && $user['phone'] === $request->phone);
                        });
             if($exists){
                return response()->json([
                    'message' => 'user exist'
               ]); 
            }
            return response()->json([
                'message' => "you entered incorrect user"
            ]);
        }
    }