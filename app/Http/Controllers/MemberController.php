<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $members = Member::when($search, function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('id', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%");
        })->paginate(10);
        
        return view('admin.members.index', compact('members', 'search'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:members',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:members',
            'class' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:L,P',
            'birth_date' => 'nullable|date',
        ]);

        Member::create($request->all());

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nis' => 'required|string|unique:members,nis,' . $member->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:members,email,' . $member->id,
            'class' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:L,P',
            'birth_date' => 'nullable|date',
        ]);

        $member->update($request->all());

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
