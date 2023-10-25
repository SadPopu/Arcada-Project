<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    //
    public function index(){
        $authors = Author::all();
        
        if($authors->count() > 0) {
            return response()->json([
                'status' => 200,
                'authors' => $authors
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'No records Found'
            ], 404);
        }
        
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }
        else{
            $author = Author::create([
                'name' => $request->name,
                'surname' => $request->surname,
            ]);

            if($author){
                return response()->json([
                    'status' => 200,
                    'message' => 'Author Created Successfully'
                ],200);
            }
            else{
                return response()->json([
                    'status' =>  500,
                    'message' =>  'Something went wrong trying to create a new Author'
                ],500);
            }
        }
    }

    public function show($id){
        $author = Author::find($id);
        if($author){
            return response()->json([
                'status' => 200,
                'author' => $author
            ],200);
        }
        else{
            return response()->json([
                'status' =>  404,
                'message' =>  'No author found'
            ],404);
        }
    }

    public function edit($id){
        $author = Author::find($id);
        if($author){
            return response()->json([
                'status' => 200,
                'author' => $author
            ],200);
        }
        else{
            return response()->json([
                'status' =>  404,
                'message' =>  'No author found'
            ],404);
        }
    }

    public function update(Request $request,int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }
        else{
            $author = Author::find($id);
            

            if($author){

                $author -> update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Author Updated Successfully'
                ],200);
            }
            else{
                return response()->json([
                    'status' =>  404,
                    'message' =>  'No such Author found'
                ],404);
            }
        }
    }

    public function destroy($id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'status' => 404,
                'message' => 'No such Author found'
            ], 404);
        }
        
        if ($author->books->count() > 0) {
            return response()->json([
                'status' => 422, 
                'message' => 'Author cannot be deleted because there are associated books'
            ], 422);
        }

        $author->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Author Deleted Successfully'
        ], 200);
    }

}
