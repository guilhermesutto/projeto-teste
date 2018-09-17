<?php

namespace App\Http\Controllers;


use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{     

    public function list(Request $request){

        $param = [];
        
        if(isset($request->search)){
            $params = $request->except('page');           
            $param['Model'] = Users::where(function($q) use ($params){
                
                if(preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $params['search']) || is_numeric($params['search'])){                    
                    $q->where('cpf', str_replace('.', '', str_replace('-', '', $params['search'])));
                }else if (filter_var($params['search'], FILTER_VALIDATE_EMAIL)){                    
                    $q->where('email', $params['search']);
                }else{                    
                    $q->where('nome', 'LIKE', $params['search']);
                }


            })->paginate(5);
        }else{
            $param['Model'] = Users::paginate(5);
        }

        return view('list', $param);
    }

    public function get(Request $request, Users $User){
       return response()->json(["user" => $User->find($request->id)], 200);
    }

    public function create(Request $request){
        
        $request->validate([            
            'email' => 'unique:users',
            'cpf' => 'unique:users',            
        ]);        

        $save = Users::create($request->all());
        
        if($save) return response()->json(['message'=>'Salvo com sucesso!', 'id'=>$save->id], 200);
        else return response()->json(['message'=>'Erro!'], 200);
        
    }
    public function update(Request $request){
        $user = User::updateOrCreate($request->all());

        if($save) return response()->json(['message'=>'Salvo com sucesso!', 'id'=>$request->id], 200);
        else return response()->json(['message'=>'Erro!'], 200);
    }
    

    public function delete($id)
    {
        $user = Users::find($id);
        if($user->delete()){
            return response()->json(['message', 'Deletado com sucesso'], 200);
        }


    }


}
