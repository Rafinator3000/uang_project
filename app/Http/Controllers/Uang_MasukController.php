<?php

namespace App\Http\Controllers;

use App\Models\lokasi_uang;
use App\Models\uang_masuk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
class Uang_MasukController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:uang_masuk-list|uang_masuk-create| uang_masuk-edit| uang_masuk-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:uang_masuk-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:uang_masuk-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:uang_masuk-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $uang_masuk = uang_masuk::paginate(5);
    //     return view('uang_masuk.index', compact('uang_masuk'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    //         // $uang_masuk = uang_masuk::latest()->paginate(5); ... the "latest" term will sort new on top rather than the bottom.//

    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = uang_masuk::select('*');
            $query_data = new uang_masuk();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('created_by', 'like', $search_value)
                        ->orWhere('lokasi_uang', 'like', $search_value)
                        ->orWhere('jumlah_masuk', 'like', $search_value)
                        ->orWhere('keterangan_masuk', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('created_by', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('lokasi_uang', function (uang_masuk $uang_masuk) {
                    return $uang_masuk -> lokasi_uang_nama -> nama_lokasi;
                })
                ->addColumn('action', function ($row) {
                    //$btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    //                     $btn = '<form action="' . route('uang_masuk.destroy', $row->id) . '"method="POST">
                    //  <a class="btn btn-info" href="' . route('uang_masuk.show', $row->id) . '">Show</a>
                    //  <a class="btn btn-primary" href="' . route('uang_masuk.edit', $row->id) . '">Edit</a>
                    //  ' . csrf_field() . method_field('DELETE') . '
                    //  <button type="submit" class="btn btn-danger">Delete</button>
                    //  </form>
                    //  ';

                    $btn = '<form action="' . route('uang_masuk.destroy', $row->id) . '" method="POST">
                    <a class="btn btn-info" href="' . route('uang_masuk.show', $row->id) . '">Show</a>';
                    // dd(Auth::user());
                    if (Auth::user()->can('uang_masuk-edit')) {
                        $btn = $btn . '<a class="btn btn-primary" href="' . route('uang_masuk.edit', $row->id) . '">Edit</a>';
                    }
                    if (Auth::user()->can('uang_masuk-delete')) {
                        // $btn = $btn . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger">Delete</button>';
                        $btn = $btn . "<a href=\"#\" onclick=\"deleteConfirm('".route('uang_masuk.destroy', $row->id)."')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn = $btn . '</form>';
    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('uang_masuk.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_lokasi_uang = lokasi_uang::all();
        return view('uang_masuk.create', compact('data_lokasi_uang'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * * @param \Illuminate\Http\Request $request
     * * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'created_by' => 'required',
            'lokasi_uang' => 'required',
            'jumlah_masuk' => 'required',
            'keterangan_masuk' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2e+6',
            //required, must be an image, max= 2 gigabytes (measured in kilobytes)//
        ]);

        //store all data
        $input = $request->all();

        // Loop through the input data and apply htmlspecialchars to each value
        foreach ($input as $key => $value) {
            $input[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        $request->merge($input); // Update the request data with the sanitized input

        //upload process
        if ($file = $request->file('file')) {
            //determines where uploaded files will go
            //'public' folder
            $destinationPath = 'fileassets/';
            //new file created_by
            $uang_masukfile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uang_masukfile);
            $input['file'] = "$uang_masukfile";
        }

        uang_masuk::create($input);

        return redirect()->route('uang_masuk.index')
            ->with('success', 'Data Uang Masuk created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * * @param \App\uang_masuk $uang_masuk
     * * @return \Illuminate\Http\Response
     */
    public function show(uang_masuk $uang_masuk)
    {
        return view('uang_masuk.show', compact('uang_masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * * @param \App\uang_masuk $uang_masuk
     * * @return \Illuminate\Http\Response
     */
    public function edit(uang_masuk $uang_masuk)
    {
        $data_lokasi_uang = lokasi_uang::all();
        return view('uang_masuk.edit', compact('uang_masuk', 'data_lokasi_uang'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * * @param \Illuminate\Http\Request $request
     * * @param \App\uang_masuk $uang_masuk
     * * @return \Illuminate\Http\Respons
     */
    public function update(Request $request, uang_masuk $uang_masuk)
    {
        $request->validate([
            'created_by' => 'required',
            'lokasi_uang' => 'required',
            'jumlah_masuk' => 'required',
            'keterangan_masuk' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2e+6',
        ]);

        $uang_masukpiece = uang_masuk::where('id', $uang_masuk->id)->first();
        $input['file'] = $uang_masuk->image;
        $input = $request->all();
        if ($file = $request->file('file')) {
            $destinationPath = 'fileassets/';
            $uang_masukfile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uang_masukfile);
            $input['file'] = "$uang_masukfile";
        } else {
            unset($input['file']);
        }

        $uang_masuk->update($input);

        return redirect()->route('uang_masuk.index')
            ->with('success', 'Data Uang Masuk updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * * @param \App\uang_masuk $uang_masuk
     * * @return \Illuminate\Http\Response
     */
    public function destroy(uang_masuk $uang_masuk)
    {
        $uang_masuk->delete();

        return redirect()->route('uang_masuk.index')
            ->with('success', 'Data Uang Masuk deleted successfully');
    }

    function exportPDF()
    {
        $uang_masuk = uang_masuk::all();
        $pdf = Pdf::loadview('uang_masuk.exportpdf', ['uang_masuk' => $uang_masuk]);
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->download('LaporanDatauang_masuk.pdf');
    }
}
