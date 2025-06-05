<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Tampilkan daftar anggota.
     */
    public function index()
    {
        $members = Member::orderBy('created_at', 'desc')->get();
        return view('members.list', compact('members'));
    }

    /**
     * Tampilkan form untuk membuat anggota baru.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Simpan anggota baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'join_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:active,inactive'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.regex' => 'Nomor telepon harus berupa angka dan minimal 10 digit',
            'join_date.required' => 'Tanggal bergabung wajib diisi',
            'join_date.before_or_equal' => 'Tanggal bergabung tidak boleh lebih dari hari ini',
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status harus active atau inactive'
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk mengedit anggota.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Perbarui anggota yang ada di database.
     */
    public function update(Request $request, Member $member)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('members')->ignore($member->id),
            ],
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'join_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:active,inactive'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.regex' => 'Nomor telepon harus berupa angka dan minimal 10 digit',
            'join_date.required' => 'Tanggal bergabung wajib diisi',
            'join_date.before_or_equal' => 'Tanggal bergabung tidak boleh lebih dari hari ini',
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status harus active atau inactive'
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Hapus anggota dari database.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}

