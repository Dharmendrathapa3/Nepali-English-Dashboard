<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{


    public function __construct(User $user)
    {
        $this->middleware(['permission:view-Users|add-Users|update-Users|delete-Users'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Users'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Users'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Users'], ['only' => ['destroy']]);
        $this->user = $user;

        $this->middleware('auth');
    }

    use HasRoles;

    public function index()
    {

        $user = User::orderBy('id', 'DESC')->where('delete_status', '0')->paginate(10);



        return view('Users/show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        $text = 'Add';
        $user = null;
        return view('Users/form', compact('text', 'user', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([

            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'min:8|required_with:cpassword|same:cpassword',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        if ($request->role_id) {
            $user->assignRole([$request->role_id]);
        }



        return redirect(route('user.index'))->with('success', 'User Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::all();
        $text = 'Edit';
        $user = User::find($id);
        return view('Users/form', compact('text', 'user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required',

        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        return redirect(route('user.index'))->with('success', 'User Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->where('id', $user->id)->update(['delete_status' => '1']);
        return redirect(route('user.index'))->with('error', 'User Moved to Trash');
    }

    public function search(Request $request)
    {
        // dd($request->keyword);

        $user = User::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);

        return view('Users/show', compact('user'));
    }


    public function trashuser()
    {
        $trashuser = User::orderBy('id', 'DESC')->where('delete_status', '1')->paginate(10);
        return view('Users/trashuser', compact('trashuser'));
    }

    public function trashrestore($id)
    {
        $user = User::find($id);
        $user->where('id', $user->id)->update(['delete_status' => '0']);

        return redirect(route('user.trash.index'))->with('success', 'User Restore successfully!');
    }

    public function trashdelete($id)
    {
        User::find($id)->delete();
        return redirect(route('user.trash.index'))->with('error', 'User permanently Deleted successfully!');
    }


    public function changepasswordform($id)
    {

        $user = User::find($id);
        return view('Users/changepassword', compact('user'));
    }

    public function changepassword(Request $request, $id)
    {

        $request->validate([
            'password' => 'min:8|required_with:cpassword|same:cpassword',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect(route('user.index'))->with('success', 'Password Changed successfully!');
    }

    public function trashsearch(Request $request)
    {
        // dd($request->keyword);

        $trashuser = $trashuser = User::orderBy('id', 'DESC')->where('delete_status', '1')->where('name', 'like', '%' . $request->keyword . '%')->paginate(20);

        return view('Users/trashuser', compact('trashuser'));
    }
}
