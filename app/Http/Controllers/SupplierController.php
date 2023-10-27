<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = DB::select('SELECT *
                            FROM vendor
                            WHERE status_aktif = ?', [1]);
        return view('pages.admins.suplier', [
            'suppliers' => $suppliers,
            'title' => 'Vendor'
        ]);
    }

    public function create(Request $request)
    {
        $supplierName = $request->input('nama_supplier');
        $badanHukum = $request->input('badan_hukum');

        $existingSupplier = DB::select('SELECT *
                                FROM vendor
                                WHERE nama_vendor = ? LIMIT 1', [$supplierName]);

        if (!empty($existingSupplier)) {
            return response()->json(['error' => 'A supplier with the same name already exists.']);
        }

        $newSupplier = DB::insert('INSERT INTO vendor (nama_vendor, badan_hukum, status_aktif)
                                VALUES (?, ?, 1)', [$supplierName, $badanHukum]);
        if ($newSupplier) {
            $supplierData = DB::select('SELECT *
                                        FROM vendor
                                        WHERE nama_vendor = ? LIMIT 1', [$supplierName]);
            if (!empty($supplierData)) {
                return response()->json($supplierData[0]);
            } else {
                return response()->json(['error' => 'Failed to add the supplier.']);
            }
        } else {
            return response()->json(['error' => 'Failed to add the supplier.']);
        }
    }

    public function update(Request $request, $idsupplier)
    {
        $supplierName = $request->input('edit_nama_supplier');
        $badanHukum = $request->input('edit_badan_hukum');

        $affectedRows = DB::update('UPDATE vendor
                                SET nama_vendor = ?, badan_hukum = ?
                                WHERE idvendor = ? AND status_aktif = 1', [$supplierName, $badanHukum, $idsupplier]);

        if ($affectedRows > 0) {
            $supplierData = DB::select('SELECT *
                                    FROM vendor
                                    WHERE idvendor = ? LIMIT 1', [$idsupplier]);

            if (!empty($supplierData)) {
                return response()->json($supplierData[0]);
            } else {
                return response()->json(['error' => 'Failed to update the supplier. Please try again.']);
            }
        } else {
            return response()->json(['error' => 'Failed to update the supplier. Please try again.']);
        }
    }

    public function softDelete($idsupplier)
    {
        $affectedRows = DB::update('UPDATE vendor
                                    SET status_aktif = 0
                                    WHERE idvendor = ?', [$idsupplier]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Supplier deleted successfully']);
        } else {
            return response()->json(['error' => 'Failed to delete the supplier']);
        }
    }

    public function getSoftDeletedSuppliers()
    {
        $softDeletedSuppliers = DB::select('SELECT *
                                        FROM vendor
                                        WHERE status_aktif = ?', [0]);
        return response()->json($softDeletedSuppliers);
    }

    public function restoreSupplier($id)
    {
        $affectedRows = DB::update('UPDATE vendor
                                    SET status_aktif = ?
                                    WHERE idvendor = ?', [1, $id]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Supplier restored successfully.']);
        } else {
            return response()->json(['error' => 'Failed to restore the supplier.']);
        }
    }
}
