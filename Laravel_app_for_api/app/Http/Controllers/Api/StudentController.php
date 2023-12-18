<?php

namespace App\Http\Controllers\Api;

use App\Models\student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    //
    public function index (){
        $students = student::all();
       if ($students->count() > 0){
        return response()->json( [
            'status'=> 200 ,
            'students'=> $students,
        ],200) ;
       }
       else {
        return response()->json( [
            'status'=> 404 ,
            'message'=> 'there are no students on data base',
        ],404) ;
       }

       }
       public function store (Request $request){
        $validator = validator::make($request->all(),[
        'name'=> 'required |string|max :191',
        'course'=> 'required |string|max :191',
        'email'=> 'required |email|max :191',
        'phone'=> 'required |digits:10',

        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=> 422 ,
                'errors'=> $validator->messages(),
            ],422);
        
        }
        else{
            $student = student::create([
                'name'=> $request->name ,
                'course'=> $request->course ,
                'email'=> $request->email ,
                'phone'=> $request->phone ,
        
            ]);
            if($student){
                return response()->json([
                    'status'=>200 ,
                    'message'=>'student added successfuly'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>500 ,
                    'message'=>'something went wrong'
                ],500);

            }

        }
        
       }
       public function show($id){

        $student = student::find($id);
        if($student){
            return response()->json([
                'status'=>200 ,
                'message'=>$student
            ],200);
        }
        else{
            return response()->json([
                'status'=>404 ,
                'message'=>'No student found'
            ],404);

        }

       }
       public function edit ($id){

         $student = student::find($id);
        if($student){
            return response()->json([
                'status'=>200 ,
                'student'=>$student
            ],200);
        }
        else{
            return response()->json([
                'status'=>404 ,
                'message'=>'No student found'
            ],404);

        }

       }
       public function update (Request $request , int $id){
        $validator = validator::make($request->all(),[
        'name'=> 'required |string|max :191',
        'course'=> 'required |string|max :191',
        'email'=> 'required |email|max :191',
        'phone'=> 'required |digits:10',

        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=> 422 ,
                'errors'=> $validator->messages(),
            ],422);
        
        }
        else{
            $student = student::find($id);
            $student->update([
                'name'=> $request->name ,
                'course'=> $request->course ,
                'email'=> $request->email ,
                'phone'=> $request->phone ,
              
            ]);
            if($student){
                return response()->json([
                    'status'=>200 ,
                    'message'=>'student updated successfuly'
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404 ,
                    'message'=>'No such student found'
                ],404);

            }

        }
        
       }
       public function destroy ($id){
        $student = student::find($id);
       if($student){
        $student->delete();
        return response()->json([
            'status'=>200,
            'message' =>'student was deleted successfuly'
        ],200);
       }
       else{
        return response()->json([
            'status'=>404,
            'message'=> 'student was not deleted',
        ],404);
       }



       }
    
    }

