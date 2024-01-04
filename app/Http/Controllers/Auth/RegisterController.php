<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $kelas = Kelas::all();
        return view('auth.register', compact('kelas'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nis' => ['required', 'integer', 'digits:8', 'unique:users,nis', 'min:0'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_tlp' => ['required', 'numeric', 'digits_between:12,15'],
            'foto' => ['required', 'max:2048'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
            'nis.required' => 'NIS harus diisi.',
            'nis.integer' => 'NIS harus berupa bilangan bulat.',
            'nis.digits' => 'NIS harus terdiri dari 8 digit.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.min' => 'NIS tidak boleh bernilai negatif.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'no_tlp.required' => 'Nomor telepon harus diisi.',
            'no_tlp.numeric' => 'Nomor telepon harus berupa angka.',
            'no_tlp.digits_between' => 'Nomor telepon harus terdiri dari 12 hingga 15 digit.',
            'foto.required' => 'Foto harus diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        return "Halo";
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $kelas = Kelas::find($data['kelas_id']);

        $foto = $data['foto'];

        // Menggunakan storeAs untuk menyimpan file dengan nama acak
        $namaFoto = $foto->storeAs('foto', uniqid() . '.' . $foto->getClientOriginalExtension(), 'public');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nis' => $data['nis'],
            'kelas_id' => $data['kelas_id'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat' => $data['alamat'],
            'no_tlp' => $data['no_tlp'],
            'foto' => $namaFoto,
        ]);

        $datasiswa = $user->datasiswa()->create([
            'user_id' => $user->id,
            'nama_siswa' => $data['name'],
            'nis' => $data['nis'],
            'kelas_id' => $data['kelas_id'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat' => $data['alamat'],
            'nomor_telepon' => $data['no_tlp'],
            'email' => $data['email'],
        ]);

        return $user;
    }

   /**
 * The user has been registered.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  mixed  $user
 * @return mixed
 */
protected function registered(Request $request, $user)
{
    // Validasi tambahan untuk memastikan email tidak terdaftar lagi
    $emailExists = User::where('email', $request->input('email'))->exists();

    return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    
    if ($emailExists) {
        // Jika email sudah terdaftar, logika untuk menampilkan pesan alert di sini
        // Anda dapat menggunakan session atau langsung memasukkan pesan ke dalam redirect
        return redirect()->route('register')->with('error', 'Email sudah digunakan. Silakan gunakan email lain.');
    }
}

}
