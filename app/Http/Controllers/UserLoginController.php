<?php

namespace App\Http\Controllers;

use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{

   

    public function index()
    {
        return response()->json(UserLogin::all());
    }

    public function store(Request $request)
    {
        $user = UserLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return response()->json($user,201);
    }

    public function show($id)
    {
        return response()->json(UserLogin::findOrFail($id));
    }

    public function update(Request $request,$id)
    {
        $user = UserLogin::findOrFail($id);

        $user->update([
            'name'=>$request->name ?? $user->name,
            'email'=>$request->email ?? $user->email,
            'password'=>$request->password
                ? Hash::make($request->password)
                : $user->password
        ]);

        return response()->json($user);
    }

    public function destroy($id)
    {
        UserLogin::findOrFail($id)->delete();
        return response()->json(['message'=>'User deleted']);
    }


    
    private function getRemoteData()
    {
        $response = Http::timeout(10)->get('https://bit.ly/48ejMhW');

        if(!$response->ok()) return collect([]);

        $raw = trim($response->json()['DATA'] ?? '');

        $rows = preg_split('/\r\n|\r|\n/', $raw);
        array_shift($rows);

        return collect($rows)->map(function($row){

            $row = trim($row);
            if($row==='') return null;

            $parts = array_map('trim', explode('|',$row));
            if(count($parts)<3) return null;

            $nim=null; $nama=null; $ymd=null;

            foreach($parts as $p){

               
                if(preg_match('/^\d{8}$/',$p)){
                    $ymd=$p;
                }

              
                elseif(preg_match('/^\d{9,}$/',$p)){
                    $nim=$p;
                }

            
                else{
                    $nama=$p;
                }
            }

            return [
                'NIM'=>$nim,
                'NAMA'=>$nama,
                'YMD'=>$ymd
            ];

        })->filter()->values();
    }



    public function searchName($nama)
    {
        return response()->json(
            $this->getRemoteData()
            ->filter(fn($i)=>str_contains(
                strtolower($i['NAMA']),
                strtolower(trim($nama))
            ))
            ->sortBy('NAMA')
            ->values()
        );
    }

    public function searchNim($nim)
    {
        return response()->json(
            $this->getRemoteData()
            ->filter(fn($i)=>$i['NIM']==trim($nim))
            ->values()
        );
    }

    public function searchYmd($ymd)
    {
        return response()->json(
            $this->getRemoteData()
            ->filter(fn($i)=>$i['YMD']==trim($ymd))
            ->values()
        );
    }
}