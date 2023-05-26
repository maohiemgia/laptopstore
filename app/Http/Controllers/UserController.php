<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('role', 'desc')->get();

        if (preg_match("/api/", $request->url())) {
            return $users;
        }
      
        confirmDelete();
        // alert()->success('thành công rồi', 'thông báo okok');

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $request->validated();

        if (!is_null($request->image)) {
            $imageUpload = $request->file('image');
            $imageName = time() . '.' . $imageUpload->extension();

            // move image to public/images
            $request->image->move(public_path('images'), $imageName);
            $user['image'] = "images/" . $imageName;
        }

        $user['password'] = Hash::make($user['password']);
        User::create($user);

        return redirect('/users')->with('success', 'Tạo mới người dùng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $user = User::find($id);

        if (!is_null($user)) {
            $age = Carbon::parse($user->birthday)->age;
            $day_live = Carbon::now()->diff($user->created_at);
            $user->age = $age;
            $user->day_live = $day_live;
            $user->role_name = 'admin';
            if ($user->role == 0) {
                $user->role_name = 'user';
            }
        }

        if (preg_match("/api/", $request->url())) {
            return $user;
        }

        // return view('admin.user.create', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $request->updateUser($user);

        return redirect()->back()->with('success', 'Cập nhật người dùng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'Xóa người dùng thành công');
    }

    public function ordermanager()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        
        return view('client.user.ordermanager', compact('orders'));
    }
}
