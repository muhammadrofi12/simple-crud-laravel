<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    //Berisi OOP PHP
    public function index()
    {
        $categories = CategoryProduct::all();

        if($categories->isEmpty()) {
            return response()->json(data: [
                'status' => 400,
                'message' => 'Data tidak ditemukan',
                'data' => ''
            ]);
        }

        // berupa file json
        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil diambil',
            'data' => $categories
        ]);
    }

    // create data
    public function createCategory(Request $request)
    {
        $validator = Validator::make( $request->all(),  [
            'name' => 'required'
        ]);

        if ($validator->fails()){
            $errors = collect();
            foreach ($validator->errors()->getMessages() as $key => $value) {
                foreach ($value as $error) {
                    $errors->push( $error);
                }
            }

            return response()->json( data: [
                'status' => 400,
                'message' => 'Validation Error!',
                'data' => $error
            ]);
        }

        $category = CategoryProduct::create([
            'name' => $request->name
        ]);

        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil dibuat',
            'data' => $category
        ]);
    }

    public function updateCategory(Request $request, $id) {
        // $category = CategoryProduct::where('id', $id)->first();
        $category = CategoryProduct::find($id);

        $validator = Validator::make($request->all(),  [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = collect();
            foreach ($validator->errors()->getMessages() as $key => $value) {
                foreach ($value as $error) {
                    $errors->push($error);
                }
            }

            return response()->json(data: [
                'status' => 400,
                'message' => 'Validation Error!',
                'data' => $error
            ]);
        }

        $category->update([
            'name' => $request->name
        ]);

        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil diupdate',
            'data' => $category
        ]);
    }

    public function deleteCategory($id) {
        $category = CategoryProduct::find($id);

        $category->delete();

        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil dihapus',
        ]);
    }

    public function getDetailCategory($id) {

        $category = CategoryProduct::find($id);

        if(!$category) {
            return response()->json(data: [
                'status' => 400,
                'message' => 'Data tidak ditemukan',
                'data' => ''
            ]);
        }

        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil diambil',
            'data' => $category
        ]);
    }
}
