<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        // Query native to fetch data
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
        $badanHukum = $request->input('badan_hukum'); // Add this line

        // Check if a supplier with the same name already exists
        $existingSupplier = DB::select('SELECT *
                                FROM vendor
                                WHERE nama_vendor = ? LIMIT 1', [$supplierName]);

        if (!empty($existingSupplier)) {
            return response()->json(['error' => 'A supplier with the same name already exists.']);
        }

        // Insert data into the "vendor" table with the badan_hukum column
        $newSupplier = DB::insert('INSERT INTO vendor (nama_vendor, badan_hukum, status_aktif)
                                VALUES (?, ?, 1)', [$supplierName, $badanHukum]); // Add $badanHukum here
        if ($newSupplier) {
            // Retrieve data for the newly created supplier
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
        $badanHukum = $request->input('edit_badan_hukum'); // Add this line

        // Update data in the "vendor" table using a raw query
        $affectedRows = DB::update('UPDATE vendor
                                SET nama_vendor = ?, badan_hukum = ?
                                WHERE idvendor = ? AND status_aktif = 1', [$supplierName, $badanHukum, $idsupplier]); // Add $badanHukum here

        if ($affectedRows > 0) {
            // If the update was successful
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
        // Update status_aktif to 0 (inactive) for the supplier with a specific id using a raw query
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
        // Retrieve data for suppliers that are soft-deleted (status_aktif = 0)
        $softDeletedSuppliers = DB::select('SELECT *
                                        FROM vendor
                                        WHERE status_aktif = ?', [0]);
        return response()->json($softDeletedSuppliers);
    }

    public function restoreSupplier($id)
    {
        // Set status_aktif of the supplier back to 1 (active)
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
