<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    //
    public function index()
{
    $books = Book::with('author')->get();

    if ($books->count() > 0) {
        return response()->json([
            'status' => 200,
            'books' => $books,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No records Found',
        ], 404);
    }
}

    
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:191',
        'description' => 'required|string|max:191',
        'author_id' => 'required|numeric|max:200',
    ]);

    $author = Author::find($request->author_id);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ], 422);
    }

    elseif(!$author){
        return response()->json([
            'status' => 404,
            'errors' => 'Failed to create the Book, Author does not exist'
        ], 404);
    }

    $book = Book::create([
        'title' => $request->title,
        'description' => $request->description,
        'author_id' => $request->author_id,
    ]);

    return $book
        ? response()->json([
            'status' => 201,
            'message' => 'Book Created Successfully'
        ], 201)
        : response()->json([
            'status' => 500,
            'message' => 'Something went wrong trying to create a new Book'
        ], 500);
}


public function show($id)
{
    $book = Book::with('author')->find($id);

    if ($book) {
        return response()->json([
            'status' => 200,
            'book' => $book,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No book found',
        ], 404);
    }
}


    public function edit($id){
        $book = Book::find($id);
        if($book){
            return response()->json([
                'status' => 200,
                'book' => $book
            ],200);
        }
        else{
            return response()->json([
                'status' =>  404,
                'message' =>  'No book found'
            ],404);
        }
    }

    public function update(Request $request,int $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'author_id' => 'required|numeric|max:200',
        ]);

        $author = Author::find($request->author_id);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }

        elseif(!$author){
            return response()->json([
                'status' => 404,
                'errors' => 'Book not updated, Author does not exist'
            ], 404);
        }

        else{
            $book = Book::find($id);
            

            if($book){

                $book -> update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'author_id' => $request->author_id,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'book Updated Successfully'
                ],200);
            }
            else{
                return response()->json([
                    'status' =>  404,
                    'message' =>  'No such book found'
                ],404);
            }
        }
    }

    public function destroy($id){

        $book = Book::find($id);

        if($book){

            $book -> delete();

            return response()->json([
                'status' => 200,
                'message' => 'book Deleted Successfully'
            ],200);
        }
        else{
            return response()->json([
                'status' =>  404,
                'message' =>  'No such book found'
            ],404);
        }
    }
}
