<?php

namespace App\Http\Controllers\Api;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all to do list

        $user = auth()->user();
        $userId = $user->id;

        $toDoList = ToDoList::where('user_id', $userId)->get();

        if (!$toDoList->isEmpty()) {
            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $toDoList,
                'message'   => 'Data found'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 404,
                'content'   => [],
                'message'   => 'Data not found'
            ];
        }

        return response()->json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;

        $rules = [
            'taks'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'code'      => 400,
                'content'   => $validator->errors(),
                'message'   => 'Validation Error'
            ], 400);
        }

        $dataSave = [
            'user_id'   => $userId,
            'taks'      => $request->taks
        ];


        $store = ToDoList::create($dataSave);

        if ($store) {

            $toDoList = ToDoList::where('user_id', $userId)->get();
            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $toDoList,
                'message'   => 'Data saved successfully'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 400,
                'content'   => [],
                'message'   => 'Failed to save data'
            ];
        }


        return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDoList = ToDoList::find($id);
        if ($toDoList) {
            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $toDoList,
                'message'   => 'Data found'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 404,
                'content'   => [],
                'message'   => 'Data not found'
            ];
        }

        return response()->json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toDoList = ToDoList::find($id);
        $user = auth()->user();
        $userId = $user->id;

        $rules = [
            'taks'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'code'      => 400,
                'content'   => $validator->errors(),
                'message'   => 'Validation Error'
            ], 400);
        }

        $dataSave = [
            'taks'      => $request->taks
        ];


        $update = ToDoList::where('id', $toDoList->id)
            ->update($dataSave);

        if ($update) {

            $toDoLists = ToDoList::where('user_id', $userId)->get();
            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $toDoLists,
                'message'   => 'Data updated successfully'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 400,
                'content'   => [],
                'message'   => 'Failed to update data'
            ];
        }


        return response()->json($response, $response['code']);
    }

    public function updateStatus(Request $request, $id)
    {
        $toDoList = ToDoList::find($id);
        $user = auth()->user();
        $userId = $user->id;

        $rules = [
            'status'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'code'      => 400,
                'content'   => $validator->errors(),
                'message'   => 'Validation Error'
            ], 400);
        }

        $dataSave = [
            'status'    => $request->status
        ];


        $update = ToDoList::where('id', $toDoList->id)
            ->update($dataSave);

        if ($update) {

            $toDoLists = ToDoList::where('user_id', $userId)->get();
            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $toDoLists,
                'message'   => 'Data updated successfully'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 400,
                'content'   => [],
                'message'   => 'Failed to update data'
            ];
        }


        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toDoList = ToDoList::find($id);
        $destroy = ToDoList::destroy($toDoList->id);

        if ($destroy) {
            $response = [
                'status'    => true,
                'code'      => 204,
                'content'   => [],
                'message'   => 'Data deleted successfully'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 400,
                'content'   => [],
                'message'   => 'Failed to delete data'
            ];
        }

        return response()->json($response, $response['code']);
    }
}
