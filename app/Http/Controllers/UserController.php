<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =User::all();
        return view('backend.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'userName'     => 'required|min:3',
            'userEmail'    => 'required|email|unique:users,email', // Add email format and unique validation
            'userPassword' => 'required|min:6',
        ]);

        //store in the database 
        $user = new User();
        $user->name = $request->userName;
        $user->email = $request->userEmail;
        $user->password = bcrypt($request->userPassword); // Don't forget to hash!
        $user->save();

        //redirect to list page
        return redirect()->route('users.index')->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user =User::find($id);
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           //validation
            $request->validate([
                'userName'     => 'required|min:3',
                'userEmail'    => 'required|min:3',
                'userPassword' => 'required|min:6',
            ]);
      

        $userName = $request->userName;
        $userEmail = $request->userEmail;
        $userPassword = $request->userPassword;

        // Update into database table
        $user = User::find($id);
        $user->name = $userName;
        $user->email = $userEmail;
        $user->password = bcrypt($userPassword);
        $user->save();

        // Redirect to list page
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index');   

    }
}
