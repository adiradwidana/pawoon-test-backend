<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use Validator;
use App\Http\Models\User;
use Illuminate\Http\Request;
/**
* 
*/
class UserController extends Controller
{
	
	public function index_api()
	{
		$users = User::paginate(10);

		if ($users->count() < 1) {
			return response($users, 204);
		}

		return response($users, 200);
	}

	public function index()
	{
		$users = User::get();

		if ($users->count() < 1) {
			return response($users, 204);
		}

		return view('users')->with('users', $users);
	}

	public function store_api(Request $request)
	{
		$rules = [
			'name'   =>  'required|unique:users',
			'alamat' =>  'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
          return response($validation->errors(), 400);
        }

		$user = User::whereName($request->input('name'))->first();

		if ($user) {
			return response("User sudah terdaftar", 422);
		}

		try {
			DB::beginTransaction();

			$user         = new User;
			$user->name   = $request->input('name');
			$user->alamat = $request->input('alamat');
			$user->save();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return response('Terjadi Kesalahan', 500);
		}

		return response('Berhasil menambahkan data user', 202);

	}

	public function store(Request $request)
	{
		$rules = [
			'name'   =>  'required|unique:users',
			'alamat' =>  'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()) {
		    return Redirect::back()->withErrors($validation);
		}

		$user = User::whereName($request->input('name'))->first();

		if ($user) {
			return response("User sudah terdaftar", 422);
		}

		try {
			DB::beginTransaction();

			$user         = new User;
			$user->name   = $request->input('name');
			$user->alamat = $request->input('alamat');
			$user->save();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return response('Terjadi Kesalahan', 500);
		}

		return redirect('/')->with('message', 'Berhasil menambahkan data user');

	}
}
?>