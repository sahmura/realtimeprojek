<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Courirs;
use App\User;
use App\Transactions;
use App\Addresses;

class DashboardController extends Controller
{
    public function indexAddress($id = null)
    {
        if ($id == null) {
            return view('address.index');
        } else {
            $data = Addresses::find($id);
            return view('address.index', compact('data'));
        }
    }

    public function addAddress(Request $request)
    {
        Addresses::create(
            [
                'user_id' => Auth()->user()->id,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'address' => $request->address,
            ]
        );

        return redirect('home');
    }

    public function editAddress(Request $request)
    {
        Addresses::find($request->id)->update(
            [
                'user_id' => Auth()->user()->id,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'address' => $request->address,
            ]
        );

        return redirect('home');
    }

    public function deleteAddress($id)
    {
        Addresses::find($id)->delete();
        return redirect('home');
    }

    public function indexBelanja()
    {
        $data = Products::all();
        $address = Addresses::where('user_id', '=', Auth()->user()->id)->get();
        $courirs = Courirs::with('user')->get();
        return view('belanja.index', compact('data', 'address', 'courirs'));
    }

    public function addTransaksi(Request $request)
    {
        Transactions::create(
            [
                'user_id' => Auth()->user()->id,
                'product_id' => $request->product_id,
                'address_id' => $request->address_id,
                'courir_id' => $request->courir_id,
            ]
        );

        return redirect('home');
    }

    public function transaksiDetail($id)
    {
        $detail = Transactions::where('id', '=', $id)->with(['user', 'courir', 'address', 'product'])->first();
        return view('transaksi.index', compact('detail'));
    }
}
