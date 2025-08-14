<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang.
     */
   // app/Http/Controllers/BarangController.php

// ... (kode di atas tidak ada perubahan) ...

public function index(Request $request)
{
    $query = Barang::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('code', 'like', "%{$search}%")
              ->orWhere('machine', 'like', "%{$search}%")
              ->orWhere('name_of_good', 'like', "%{$search}%")
              ->orWhereHas('detail', function ($q) use ($search) {
                  $q->where('specification', 'like', "%{$search}%")
                    ->orWhere('box', 'like', "%{$search}%")
                    ->orWhere('closing', 'like', "%{$search}%");
              });
    }

    $barangs = $query->with('detail')->paginate(10);

    // Periksa apakah permintaan datang dari AJAX
    if ($request->ajax()) {
        return response()->json([
            'barangs' => $barangs
        ]);
    }

    return view('barang.index', compact('barangs'));
}

// ... (kode di bawah tidak ada perubahan) ...
    /**
     * Menyimpan data barang baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:tb_barang,code|max:255',
            'machine' => 'required|max:255',
            'name_of_good' => 'required|max:255',
            'specification' => 'required|max:255',
            'box' => 'required|max:255',
            'using_2024' => 'required|numeric',
            'opening' => 'required|numeric',
            'received' => 'required|numeric',
            'used' => 'required|numeric',
            'closing' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal!', 'errors' => $validator->errors()], 422);
        }
    
        try {
            $barang = Barang::create($validator->validated());
            $barang->detail()->create(array_merge($validator->validated(), ['code_detail' => $barang->code]));
            $newBarang = Barang::with('detail')->where('code', $barang->code)->first();
    
            return response()->json(['success' => true, 'message' => 'Data barang berhasil ditambahkan!', 'data' => $newBarang], 201);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Memperbarui data barang yang sudah ada.
     */
    public function update(Request $request, $code)
    {
        $barang = Barang::where('code', $code)->first();

        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan!'], 404);
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255|unique:tb_barang,code,' . $barang->code . ',code', 
            'machine' => 'required|max:255',
            'name_of_good' => 'required|max:255',
            'specification' => 'required|max:255',
            'box' => 'required|max:255',
            'using_2024' => 'required|max:255',
            'opening' => 'required|max:255',
            'received' => 'required|numeric',
            'used' => 'required|numeric',
            'closing' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal!', 'errors' => $validator->errors()], 422);
        }

        try {
            $barang->update($validator->validated());
            // Periksa apakah relasi detail sudah ada sebelum mencoba update
            if ($barang->detail) {
                $barang->detail->update(array_merge($validator->validated(), ['code_detail' => $barang->code]));
            } else {
                // Jika tidak ada detail, buat yang baru
                $barang->detail()->create(array_merge($validator->validated(), ['code_detail' => $barang->code]));
            }
            
            $updatedBarang = Barang::with('detail')->where('code', $barang->code)->first();

            return response()->json(['success' => true, 'message' => 'Data barang berhasil diperbarui!', 'data' => $updatedBarang]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Menghapus data barang.
     */
    public function destroy($code)
    {
        $barang = Barang::where('code', $code)->first();

        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan!'], 404);
        }

        try {
            // Hapus data detail terlebih dahulu
            if ($barang->detail) {
                $barang->detail->delete();
            }
            
            // Kemudian hapus data barang
            $barang->delete();

            return response()->json(['success' => true, 'message' => 'Data barang berhasil dihapus!'], 200);
        
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }
}
