<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tugas;
use App\Exports\TugasExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class TugasController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->jabatan=='Admin') {
             $data = array(
            'title'           => 'Data Tugas',
            'menuAdminTugas'   => 'active',
            'tugas'            => Tugas::with('user')->get(),
        );
        return view('admin/tugas/index', $data);
        } else{
            $data = array(
                'title'               => 'Data Tugas',
                'menuKaryawanTugas'   => 'active',
                'tugas'               => Tugas::with('user')->where('user_id', $user->id)->first(),
            );
            return view('karyawan/tugas/index', $data);
        }
       
    }

    public function create(){
        $data = array(
            'title'            => 'Tambah Data Tugas',
            'menuAdminTugas'   => 'active',
            'user'             => User::where('jabatan','Karyawan')->where('is_tugas',false)->get(),
        );
        return view('admin/tugas/create', $data);
    }

    public function store(Request $request){
        $request->validate([
            'user_id'                   => 'required',
            'tugas'                  => 'required',
            'tanggal_mulai'          => 'required',
            'tanggal_selesai'        => 'required',
        ],[
            'user_id.required'                        => 'Nama Tidak Boleh Kosong',
            'tugas.required'                          => 'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required'                  => 'Tanggal Tidak Boleh Kosong',
            'tanggal_selesai.required'                => 'Tanggal Tidak Boleh Kosong',
        ]);

        $user = User::findOrFail($request->user_id);
        $tugas = new Tugas;
        $tugas->user_id             = $request->user_id;
        $tugas->tugas               = $request->tugas;
        $tugas->tanggal_mulai       = $request->tanggal_mulai;
        $tugas->tanggal_selesai     = $request->tanggal_selesai;
        $tugas->save();
        $user->is_tugas = true;
        $user->save();

        return redirect()->route('tugas')->with('success', 'Tugas Baru Ditambahkan');
    }

    public function edit($id){
        $data = array(
            'title'            => 'Edit Data Tugas',
            'menuAdminTugas'   => 'active',
            'tugas'            => Tugas::with('user')->findOrFail($id),
            
        );
        return view('admin/tugas/update', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'tugas'                  => 'required',
            'tanggal_mulai'          => 'required',
            'tanggal_selesai'        => 'required',
        ],[
            'tugas.required'                          => 'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required'                  => 'Tanggal Tidak Boleh Kosong',
            'tanggal_selesai.required'                => 'Tanggal Tidak Boleh Kosong',
        ]);
        $tugas = Tugas::findOrFail($id);
        $tugas->tugas               = $request->tugas;
        $tugas->tanggal_mulai       = $request->tanggal_mulai;
        $tugas->tanggal_selesai     = $request->tanggal_selesai;
        $tugas->save();
 
        return redirect()->route('tugas')->with('success', 'Tugas Diperbarui');
     }

     public function destroy($id){
        $tugas = Tugas::findOrFail($id);
        $user = User::find($tugas->user_id);
        $tugas->delete();   
        if ($user) {
            $user->is_tugas = false;
            $user->save();
        }
    
        return redirect()->route('tugas')->with('success', 'Tugas dihapus');
    }
    
    public function excel(){
        $filename = now()->format('d-m-Y H.i.s');
        $data = array(
            'user'      => User::get(),
            'tanggal'   => now()->format('d-m-Y'),
            'jam'       => now()->format('H.i.s'),
        );
        return Excel::download(new TugasExport, 'DataTugas_'.$filename.' .xlsx');
        
    }

    public function pdf(){
        $user = Auth::user();
        $filename = now()->format('d-m-Y H.i.s');

        if ($user->jabatan=='Admin'){
            $data = array(
            'tugas'      => Tugas::with('user')->get(),
            'tanggal'    => now()->format('d-m-Y'),
            'jam'        => now()->format('H.i.s'),
        );

        $pdf = Pdf::loadView('admin/tugas/pdf', $data);
        return $pdf->download('DataTugas_'.$filename.' .pdf');
        } else {
            $data = array(
                'tanggal'    => now()->format('d-m-Y'),
                'jam'        => now()->format('H.i.s'),
                'tugas'      => Tugas::with('user')->where('user_id',$user->id)->first(),
            );
    
            $pdf = Pdf::loadView('karyawan/tugas/pdf', $data);
            return $pdf->download('DataTugas_'.$filename.' .pdf');
            }
        }
        
    
}
