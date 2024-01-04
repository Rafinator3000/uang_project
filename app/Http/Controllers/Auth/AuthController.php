<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\lokasi_uang;
use App\Models\uang_keluar;
use App\Models\uang_masuk;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Apply htmlspecialchars to input fields
        $credentials['email'] = htmlspecialchars($credentials['email'], ENT_QUOTES, 'UTF-8');
        $credentials['password'] = htmlspecialchars($credentials['password'], ENT_QUOTES, 'UTF-8');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have successfully logged in');
        }

        return redirect("login")->withError('Oops! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        // Apply htmlspecialchars to input fields
        $data['name'] = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $data['password'] = htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8');

        $data['password'] = Hash::make($data['password']);
        $user = $this->create($data);

        Auth::login($user);
        $user->assignRole('Regular');

        return redirect("dashboard")->withSuccess('Great! You have successfully registered and logged in');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
            //hash = encrypts data in sql database
        ]);
    }

    public function dashboard()
    {
        $total_uang_masuk = uang_masuk::sum('jumlah_masuk');
        $total_uang_keluar = uang_keluar::sum('jumlah_keluar');

        $data = uang_masuk::get();
        $dataK = uang_keluar::get(); 
        // $uang_masuk_base_location = uang_masuk::where('')->get();
        // $uang_keluar_base_location = uang_keluar::where()->get();
        $total_users = User::count();
        if (Auth::check()) {
            return view('auth.dashboard',compact('total_uang_masuk','total_uang_keluar','total_users','data','dataK'));
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}





// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Session;

// class AuthController extends Controller
// {
//     public function index()
//     {
//         return view('auth.login');
//     }
//     public function registration()
//     {
//         return view('auth.registration');
//     }
//     public function postLogin(Request $request)
//     {
//         $request->validate([
//             'email' => 'required',
//             'password' => 'required',
//         ]);

//         $credentials = $request->only(
//             'email',
//             'password'
//         );
//         if (Auth::attempt($credentials)) {
//             return redirect()->intended('dashboard')
//                 ->withSuccess('You have Successfully logged in');
//         }

//         return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
//     }
//     public function postRegistration(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|min:6',
//         ]);

//         $data = $request->all();
//         $check = $this->create($data);

//         return redirect("login")->withSuccess('Great! You have Successfully logged in');
//     }
// public function dashboard()
// {
//     if (Auth::check()) {
//         return view('auth.dashboard');
//     }

//     return redirect("login")->withSuccess('Opps! You do not have access');
// }
// public function create(array $data)
// {
//     return User::create([
//         'name' => $data['name'],
//         'email' => $data['email'],
//         'password' => Hash::make($data['password'])
//         //hash = encrypts data in sql database
//     ]);
// }

//     public function logout()
//     {
//         Session::flush();
//         Auth::logout();

//         return Redirect('login');
//     }
// }
