<?php

namespace App\Http\Controllers;

use App\Models\lokasi_uang;
use App\Models\uang_keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
class Uang_KeluarController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:uang_keluar-list|uang_keluar-create| uang_keluar-edit| uang_keluar-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:uang_keluar-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:uang_keluar-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:uang_keluar-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $uang_keluar = uang_keluar::paginate(5);
    //     return view('uang_keluar.index', compact('uang_keluar'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    //         // $uang_keluar = uang_keluar::latest()->paginate(5); ... the "latest" term will sort new on top rather than the bottom.//

    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = uang_keluar::select('*');
            $query_data = new uang_keluar();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('created_by', 'like', $search_value)
                        ->orWhere('lokasi_uang', 'like', $search_value)
                        ->orWhere('jumlah_keluar', 'like', $search_value)
                        ->orWhere('keterangan_keluar', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('created_by', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('lokasi_uang', function (uang_keluar $uang_keluar) {
                    return $uang_keluar -> lokasi_uang_nama -> nama_lokasi;
                })
                ->addColumn('action', function ($row) {
                    //$btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    //                 $btn = '<form action="' . route('uang_keluar.destroy', $row->id) . '"method="POST">
    //                 <a class="btn btn-info" href="' . route('uang_keluar.show', $row->id) . '">Show</a>;
    // <a class="btn btn-primary" href="' . route('uang_keluar.edit', $row->id) . '">Edit</a>
    // ' . csrf_field() . method_field('DELETE') . '
    // <button type="submit" class="btn btn-danger">Delete</button>
    // </form>
    // ';

                $btn = '<form action="' . route('uang_keluar.destroy', $row->id) . '" method="POST">
                <a class="btn btn-info" href="' . route('uang_keluar.show', $row->id) . '">Show</a>';
                // dd(Auth::user());
                if (Auth::user()->can('uang_keluar-edit')) {
                    $btn = $btn . '<a class="btn btn-primary" href="' . route('uang_keluar.edit', $row->id) . '">Edit</a>';
                }
                if (Auth::user()->can('uang_keluar-delete')) {
                    // $btn = $btn . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger">Delete</button>';
                    $btn = $btn . "<a href=\"#\" onclick=\"deleteConfirm('".route('uang_keluar.destroy', $row->id)."')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                }
                $btn = $btn . '</form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('uang_keluar.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_lokasi_uang = lokasi_uang::all();
        return view('uang_keluar.create', compact('data_lokasi_uang'));
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
            'jumlah_keluar' => 'required',
            'keterangan_keluar' => 'required',
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
            $uang_keluarfile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uang_keluarfile);
            $input['file'] = "$uang_keluarfile";
        }

        uang_keluar::create($input);

        return redirect()->route('uang_keluar.index')
            ->with('success', 'Data Uang Keluar created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * * @param \App\uang_keluar $uang_keluar
     * * @return \Illuminate\Http\Response
     */
    public function show(uang_keluar $uang_keluar)
    {
        return view('uang_keluar.show', compact('uang_keluar'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * * @param \App\uang_keluar $uang_keluar
     * * @return \Illuminate\Http\Response
     */
    public function edit(uang_keluar $uang_keluar)
    {
        $data_lokasi_uang = lokasi_uang::all();
        return view('uang_keluar.edit', compact('uang_keluar', 'data_lokasi_uang'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * * @param \Illuminate\Http\Request $request
     * * @param \App\uang_keluar $uang_keluar
     * * @return \Illuminate\Http\Respons
     */
    public function update(Request $request, uang_keluar $uang_keluar)
    {
        $request->validate([
            'created_by' => 'required',
            'lokasi_uang' => 'required',
            'jumlah_keluar' => 'required',
            'keterangan_keluar' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2e+6',
        ]);

        $uang_keluarpiece = uang_keluar::where('id', $uang_keluar->id)->first();
        $input['file'] = $uang_keluar->image;
        $input = $request->all();
        if ($file = $request->file('file')) {
            $destinationPath = 'fileassets/';
            $uang_keluarfile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uang_keluarfile);
            $input['file'] = "$uang_keluarfile";
        } else {
            unset($input['file']);
        }

        $uang_keluar->update($input);

        return redirect()->route('uang_keluar.index')
            ->with('success', 'Data Uang Keluar updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * * @param \App\uang_keluar $uang_keluar
     * * @return \Illuminate\Http\Response
     */
    public function destroy(uang_keluar $uang_keluar)
    {
        $uang_keluar->delete();

        return redirect()->route('uang_keluar.index')
            ->with('success', 'Data Uang Keluar deleted successfully');
    }

    function exportPDF()
    {
        $uang_keluar = uang_keluar::all();
        $pdf = Pdf::loadview('uang_keluar.exportpdf', ['uang_keluar' => $uang_keluar]);
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->download('LaporanDatauang_keluar.pdf');
    }
}
