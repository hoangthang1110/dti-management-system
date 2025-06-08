<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Đảm bảo thêm dòng này để sử dụng User model
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10); // Lấy danh sách người dùng, phân trang 10 người mỗi trang
        return view('admin.users.index', compact('users')); // Trả về view admin/users/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic để hiển thị form tạo người dùng mới
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic để lưu người dùng mới vào database
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Logic để hiển thị chi tiết người dùng
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Logic để hiển thị form chỉnh sửa người dùng
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Logic để cập nhật thông tin người dùng
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Logic để xóa người dùng
    }
}