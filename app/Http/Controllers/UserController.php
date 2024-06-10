<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Department;
use App\Models\BussinesUnit;
use App\Models\KategoriUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserRequest;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Requests\User\UpdateUserRequest;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = User::whereIn('role', ['user', 'visitor'])->get();                                                                    
        $kategoris = Kategori::all();
        $BU = BussinesUnit::all();
        $department = Department::with('bussinesUnit')->get();
    
        // Define roles array
        $roles = ['user', 'visitor'];
    
        return view('pages.backsite.master-data.user.index', compact('datas', 'kategoris', 'BU', 'department', 'roles'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Mendapatkan data yang divalidasi dari request
        $validatedData = $request->validated();
    
        // Menambahkan password default jika tidak ada password yang diberikan
        if (!isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt('123456'); // Enkripsi password
        }
    
        // Mendapatkan informasi admin yang sedang login
        $admin = Auth::user();
    
        // Menambahkan informasi admin yang membuat akun ke kolom "PIC"
        $validatedData['pic'] = $admin->name; // Misalnya, disini kita mengambil nama admin
    
        // Membuat user baru dengan data yang telah dimodifikasi
        $user = User::create($validatedData);
    
        // Mengambil semua kategori yang ada
        $kategoris = Kategori::all();
        $bu = BussinesUnit::all();
    
        // Melampirkan semua kategori ke user baru
        $user->kategoris()->attach($kategoris->pluck('id'));
    
        // Redirect kembali dengan pesan keberhasilan
        alert()->success('Success Message', 'Berhasil Ditambahkan');
        return redirect()->back();
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengambil semua kategori user untuk user tertentu
        $kategoriUsers = KategoriUser::where('user_id', $id)->with('kategori')->get();
        
       // Mendapatkan nilai total untuk user tertentu
        $totalNilai = KategoriUser::where('user_id', $id)->sum('nilai_total');
        
        return view('pages.backsite.master-data.user.detailUser', compact('user', 'kategoriUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data pengguna dengan ID tertentu
        $user = User::findOrFail($id);
    
        // Mendapatkan semua kategoris untuk ditampilkan di form
        $kategoris = Kategori::all();
        $BU = BussinesUnit::all();
        $department = Department::all();
    
        return view('pages.backsite.master-data.user.edit', compact('user', 'kategoris', 'BU', 'department'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
    
        // Mengambil pengguna berdasarkan ID yang diberikan
        $user = User::findOrFail($id);
    
        // Memperbarui password jika ada input password baru
        if ($request->input('password') != null) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }
    
        // Memperbarui data pengguna dengan data yang telah divalidasi
        $user->update($data);

        alert()->success('Success Message', 'Berhasil Diperbarui');
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.user.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        alert()->success('Success Message', 'Berhasil Menghapus');
        return redirect()->back(); 
    }

    public function printPDF($id)
    {
        $user = User::findOrFail($id);
        $kategoriUsers = KategoriUser::where('user_id', $id)->with('kategori')->get();
        // Mendapatkan nilai total untuk user tertentu
        $totalNilai = KategoriUser::where('user_id', $id)->sum('nilai_total');
        foreach ($kategoriUsers as $kategoriUser) {
            // Contoh logika untuk menentukan grade
            $nilaiTotal = $kategoriUser->nilai_total;
        
            if ($nilaiTotal == 0) {
                $grade = ' ';
            } else if ($nilaiTotal >= 83 && $nilaiTotal <= 100) {
                $grade = 'Lulus';
            } else {
                $grade = 'Tidak Lulus';
            }
        
            // Tambahkan grade ke dalam objek $kategoriUser
            $kategoriUser->grade = $grade;
        }
    
        // Load konten dari file blade
        $html = view('pages.backsite.master-data.user.printpdf', compact('user', 'kategoriUsers'))->render();
    
        // Gabungkan kop surat dengan konten dari file blade
        $fullHtml = $html;
    
        // Instantiate Dompdf class
        $pdf = new Dompdf();
    
        // Optionally set some options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
    
        // Instantiate Dompdf with our options
        $pdf->setOptions($options);
    
        // Load HTML content to Dompdf
        $pdf->loadHtml($fullHtml);
    
        // Render PDF
        $pdf->render();
    
        // Output PDF
        return $pdf->stream('user_detail.pdf');
    }
    public function editUser($id)
    {
        $idkategori = KategoriUser::findorfail($id);

    
        return view('pages.backsite.master-data.user.edit_user', compact('idkategori'));
    }
    public function update_kategori_user(Request $request, $id) {
    
        // Mengambil pengguna berdasarkan ID yang diberikan
        $kategori_nilai = KategoriUser::findOrFail($id);

        $kategori_nilai->nilai_total = $request->input('nilai_total');
           
        // Memperbarui data pengguna dengan data yang telah divalidasi
        $kategori_nilai->save();

        alert()->success('Success Message', 'Berhasil Diperbarui');
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.user.index');
    }
    
        /**
     * Export users' data to Excel.
     */
    public function exportExcel()
    {
        // Get all categories
        $categories = Kategori::pluck('nama', 'id')->toArray();

        // Get all users
        $users = User::where('role', 'user')->get();

        // Initialize spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers for user data
        $sheet->setCellValue('A1', 'SAP');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Business Unit');
        $sheet->setCellValue('D1', 'Department');

        // Set column headers for categories
        $col = 'E';
        foreach ($categories as $category) {
            $sheet->setCellValue($col . '1', $category);
            $col++;
        }

        // Populate data for each user
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->SAP);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->BU);
            $sheet->setCellValue('D' . $row, $user->department);

            // Get categories for the user with nilai_total
            $userCategories = KategoriUser::where('user_id', $user->id)->with('kategori')->get();

            // Initialize category values for this user
            $userCategoryValues = array_fill_keys(array_keys($categories), 0);

            // Set nilai_total for each category
            foreach ($userCategories as $kategoriUser) {
                $userCategoryValues[$kategoriUser->kategori_id] = $kategoriUser->nilai_total;
            }

            // Set category values in corresponding columns
            $col = 'E';
            foreach ($userCategoryValues as $categoryId => $nilaiTotal) {
                $sheet->setCellValue($col . $row, $nilaiTotal);
                $col++;
            }

            $row++;
        }

        // Set the table range for sorting
        $lastColumn = $sheet->getHighestDataColumn();
        $lastRow = $sheet->getHighestDataRow();
        $tableRange = 'A1:' . $lastColumn . $lastRow;

        // Set the table range
        $sheet->setAutoFilter($tableRange);

        // Set filename and save the file
        $filename = 'users.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
    
}
