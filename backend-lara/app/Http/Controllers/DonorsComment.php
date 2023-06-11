<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DonorsComments;
use Exception;
use Validator;
use DB;

class DonorsComment extends Controller
{

    /**
     * Get all donors_comments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = DonorsComments::all();
        if ($data->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No organizations found',
                'data' => [],
            ], 201);
        }
        return response()->json([
            'data' => $data
        ], 201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content' => 'required|string|min:3',
                'user_name' => 'required|string|min:3',
                'organisations_name' => 'required|string|min:3',
                'organisations_id' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }


            $donorsComment = DonorsComments::create(array_merge(
                $validator->validated()
            ));

            return response()->json([
                'success' => true,
                'message' => 'Comment successfully created',
                'data' => $donorsComment,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create comment: ' . $e->getMessage()
            ], 500);
        }
    }
}
