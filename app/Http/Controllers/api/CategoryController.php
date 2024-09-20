<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return response()->json([
            'categories' => Category::where('user_id', '=', $id)->withCount('contacts')->get(),
            // 'categories' => Category::whereUser_id($id)->get(),
            // 'categories' => Category::where([
            //     ['user_id', '=', $id],
            // ])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        } else {

            // return response()->json($request->all());
            if (Category::create($request->all())) {
                return response()->json([
                    'success' => 'Magic has been spelled!',
                ]);
            } else {
                return response()->json([
                    'failure' => 'Magic has failed to spell!',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'category' => Category::find($id),
            // 'category' => Category::whereId($id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        } else {
            if (Category::find($id)->update($request->all())) {
                return response()->json([
                    'success' => 'Magic has been spelled!',
                ]);
            } else {
                return response()->json([
                    'failure' => 'Magic has failed to spell!',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
