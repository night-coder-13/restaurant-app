<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Wishlist;
use Faker\Provider\ar_EG\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
    public function orders()
    {
        $orders = Auth::user()->orders()->with('address')->paginate(4);

        return view('profile.order', compact('orders'));
    }

    public function transactions()
    {
        $transactions = Auth::user()->transactions()->orderByDesc('created_at')->paginate(4);
        return view('profile.transactions', compact('transactions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $user->id,
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('profile.index')->with('success', 'ویرایش با موفقیت انجام شد');
    }

    // Address *start*

    public function address(Request $request)
    {
        $addresses = Auth::user()->addresses;
        return view('profile.addresses.index', compact('addresses'));
    }

    public function addressCreate(Request $request)
    {
        $user = Auth::user();
        $provinces = Province::all();
        $cities = City::all();
        return view('profile.addresses.create', compact('user', 'provinces', 'cities'));
    }
    public function addressStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'cellphone' => ['required', 'regex:/^^09[0-9]{9}$/'],
            'postal_code' => ['required', 'regex:/^\d{5}[ -]?\d{5}$/'],
            'province_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string'
        ]);

        UserAddress::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'cellphone' => $request->cellphone,
            'postal_code' => $request->postal_code,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
        ]);

        return redirect()->route('address')->with('success', 'آدرس شما با موفقیت ثبت شد');
    }
    public function addressEdit(UserAddress $address)
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('profile.addresses.edit', compact('provinces', 'cities', 'address'));
    }
    public function addressUpdate(Request $request, UserAddress $address)
    {
        $request->validate([
            'title' => 'required|string',
            'cellphone' => ['required', 'regex:/^^09[0-9]{9}$/'],
            'postal_code' => ['required', 'regex:/^\d{5}[ -]?\d{5}$/'],
            'province_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string'
        ]);

        $address->update([
            'title' => $request->title,
            'cellphone' => $request->cellphone,
            'postal_code' => $request->postal_code,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
        ]);

        return redirect()->route('address')->with('success', 'آدرس شما با موفقیت ویرایش شد');
    }
    public function addressDelete(UserAddress $address)
    {
        $address->delete();
        return redirect()->route('address')->with('info', 'آدرس شما با موفقیت حذف شد');
    }

    // wishlist *start*
    public function wishlist()
    {
        $wishlists = Auth::user()->wishlists;
        return view('profile.wishlist', compact('wishlists'));
    }

    public function wishlistAdd(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);
        if (!Auth::check()) {
            return redirect()->back()->with('warning', 'لطفا ابتدا وارد شوید');
        }
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        if ($wishlist) {
            return redirect()->back()->with('info', 'محصول "' . $wishlist->product->name . '" در لیست علاقه‌مندی ها موجود است');
        } else {
            Wishlist::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
            ]);
            return redirect()->back()->with('success', 'محصول به لیست علاقه‌مندی ها اضافه شد');
        }
        return redirect()->route('home');
    }
    public function wishlistRemove(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->back()->with('info', 'محصول از لیست علاقه‌مندی ها حذف شد');
    }
}
