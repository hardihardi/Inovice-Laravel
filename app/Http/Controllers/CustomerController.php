<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = customer::orderBy('created_at','DESC')->paginate(10);//paginate() adalah salah satu method yang disediakan Laravel untuk untuk me-load data berdasarkan parameter yang dikirim
        return view('customer.index',compact('customers'));
    }
    public function create()
    {
        return view('customer.add');
    }
    public function save(Request $request)
{
    //VALIDASI DATA
    $this->validate($request, [
        'name' => 'required|string',
        'phone' => 'required|max:13', //maximum karakter 13 digit
        'address' => 'required|string',
        //unique berarti email ditable customers tidak boleh sama
        'email' => 'required|email|string|unique:customers,email' // format yag diterima harus email
    ]);

    try {
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email
        ]);
        return redirect('/customer')->with(['success' => 'Data telah disimpan']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}
public function edit($id)
{
    $customer = Customer::find($id);
    return view('customer.edit', compact('customer'));
}
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required|string',
        'phone' => 'required|max:13',
        'address' => 'required|string',
        'email' => 'required|email|string|exists:customers,email'
    ]);

    try {
        $customer = Customer::find($id);
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect('/customer')->with(['success' => 'Data telah diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}
public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with(['success' => '<strong>' . $customer->name . '</strong> Telah dihapus']);
    }
}
