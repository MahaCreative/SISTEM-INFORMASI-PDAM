<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembayaranTagihan;
use App\Models\TagihanBulanan;
use Illuminate\Http\Request;

class TagihanBulananController extends Controller
{
    public function index(Request $request)
    {
        $roles = $request->user()->getRoleNames()[0];
        $query = TagihanBulanan::query();
        $tagihanBulanan = TagihanBulanan::with(['wilayah', 'pembayaranTagihan'])->get();
        return inertia('Admin/TagihanBulanan/TagihanBulanan', compact('tagihanBulanan', 'roles'));
    }

    public function pembayaran(Request $request)
    {
        $roles = $request->user()->getRoleNames()[0];
        $tagihan = TagihanBulanan::findOrFail($request->tagihan_id);
        $tagihan->update([
            'status_pembayaran' => 'Lunas',
            'status_konfirmasi_pembayaran' => 'telah di konfirmasi',
            'status_pembayaran' => 'Lunas',
            'nama_petugas_konfirmasi' => $request->user()->petugas->nama,
            'status_tunggakan' => 'tidak menunggak'
        ]);
        $pembayaran = PembayaranTagihan::create([
            'via_pembayaran' => 'Kantor PDAM',
            'tagihan_id' => $request->tagihan_id,
            'nama_penerima' => $request->user()->petugas->nama,
            'status_pembayaran' => 'telah di terima',
            'tanggal_pembayaran' => now(),
        ]);
        return redirect()->back()->with(['type' => 'success', 'message' => 'Berhasil melakukan pembayaran.']);
    }
}
