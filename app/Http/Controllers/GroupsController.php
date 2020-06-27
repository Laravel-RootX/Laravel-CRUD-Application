<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Illuminate\Support\Facades\Validator;


class GroupsController extends Controller
{

    public function index()
    {
        $data['groups'] = Group::all()->where('display', 1);

        return view('groups.index', $data);
    }


    public function create()
    {
        return view('groups.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:groups,name',
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }
        $name = $request->input('name');

        Group::insert(['name' => $name]);

        session()->flash('message', 'Group has been created successfully.');
        return redirect('/groups');
    }


    public function edit($id)
    {
        $data['groups'] = Group::find($id);

        return view('groups.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:groups,name,' . $id,
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $name = $request->input('name');

        Group::where('id', $id)->update(['name' => $name]);

        session()->flash('message', 'Group has been updated successfully.');
        return redirect('/groups');
    }


    public function destroy($id)
    {
        $groups = Group::find($id);
        if (!empty($groups)) {
            $groups->delete();
            session()->flash('message', 'Group has been deleted successfully.');
        } else {
            session()->flash('message', 'Somethings wents wrong');
            session()->flash('alert_tag', 'alert-danger');
        }
        return redirect('/groups');
    }

}
