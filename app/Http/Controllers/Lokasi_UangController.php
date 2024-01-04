<?php

namespace App\Http\Controllers;

use App\Models\lokasi_uang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class Lokasi_UangController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:lokasi_uang-list|lokasi_uang-create| lokasi_uang-edit| lokasi_uang-delete',['only' => ['index', 'show']]);
        $this->middleware('permission:lokasi_uang-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:lokasi_uang-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lokasi_uang-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $lokasi_uang = lokasi_uang::paginate(5);
    //     return view('lokasi_uang.index', compact('lokasi_uang'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    //         // $lokasi_uang = lokasi_uang::latest()->paginate(5); ... the "latest" term will sort new on top rather than the bottom.//

    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Mahasiswa::select('*');
            $query_data = new lokasi_uang();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('nama_lokasi', 'like', $search_value)
                        ->orWhere('keterangan_lokasi', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('nama_lokasi', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    //$btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                //     $btn = '
                //     <form action="' . route('lokasi_uang.destroy', $row->id) . '"method="POST">
                // <a class="btn btn-info" href="' . route('lokasi_uang.show', $row->id) . '">Show</a>
                // <a class="btn btn-primary" href="' . route('lokasi_uang.edit', $row->id) . '">Edit</a>
                // ' . csrf_field() . method_field('DELETE') . '
                // <button type="submit" class="btn btn-danger">Delete</button>
                // </form>
                // ';
                
                $btn = '<form action="' . route('lokasi_uang.destroy', $row->id) . '" method="POST">
                <a class="btn btn-info" href="' . route('lokasi_uang.show', $row->id) . '">Show</a>';
                // dd(Auth::user());
                if (Auth::user()->can('lokasi_uang-edit')) {
                    $btn = $btn . '<a class="btn btn-primary" href="' . route('lokasi_uang.edit', $row->id) . '">Edit</a>';
                }
                if (Auth::user()->can('lokasi_uang-delete')) {
                    // $btn = $btn . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger">Delete</button>';
                    $btn = $btn . "<a href=\"#\" onclick=\"deleteConfirm('".route('lokasi_uang.destroy', $row->id)."')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                }
                $btn = $btn . '</form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('lokasi_uang.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lokasi_uang.create');
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
            'nama_lokasi' => 'required',
            'keterangan_lokasi' => 'required',
        ]);

        //store all data
        $input = $request->all();

        // Loop through the input data and apply htmlspecialchars to each value
        foreach ($input as $key => $value) {
            $input[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        $request->merge($input); // Update the request data with the sanitized input



        lokasi_uang::create($input);

        return redirect()->route('lokasi_uang.index')
            ->with('success', 'Data Lokasi Uang created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * * @param \App\lokasi_uang $lokasi_uang
     * * @return \Illuminate\Http\Response
     */
    public function show(lokasi_uang $lokasi_uang)
    {
        return view('lokasi_uang.show', compact('lokasi_uang'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * * @param \App\lokasi_uang $lokasi_uang
     * * @return \Illuminate\Http\Response
     */
    public function edit(lokasi_uang $lokasi_uang)
    {
        return view('lokasi_uang.edit', compact('lokasi_uang'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * * @param \Illuminate\Http\Request $request
     * * @param \App\lokasi_uang $lokasi_uang
     * * @return \Illuminate\Http\Respons
     */
    public function update(Request $request, lokasi_uang $lokasi_uang)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'keterangan_lokasi' => 'required'
        ]);


        $lokasi_uang->update($request->all());

        return redirect()->route('lokasi_uang.index')
            ->with('success', 'Data Lokasi Uang updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * * @param \App\lokasi_uang $lokasi_uang
     * * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        lokasi_uang::where('id','=',$id)->delete();

        return redirect()->route('lokasi_uang.index')
            ->with('success', 'Data Lokasi Uang deleted successfully');
    }
}
