<?php

namespace App\Http\Controllers\Admin;

use App\Model\CsvFiles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Importer;

class CsvFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CsvFiles::get();
        return view('admin.csvfiles.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.csvfiles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "csv_files" => ['required','mimes:xlsx'],
            'description' => 'required',
        ]);

        CsvFiles::where('type','0')->delete();
        $upload = new CsvFiles();
        $csvfile = $request->file('csv_files');
        if ($csvfile) {
            $file_name   = $csvfile->getClientOriginalName();
            $ext = $csvfile->getClientOriginalExtension();
            $thumbFile   = uniqid() . "_" . $file_name;
            $destinationPath = public_path('/uploads/csv_files');
            $csvfile->move($destinationPath, $thumbFile);

            $data = CsvFiles::where('type', 0)->first();
            $excelFile =  public_path('/uploads/csv_files/'.$thumbFile);
            $excel = Importer::make('Excel');
            $excel->load($excelFile);
            $collections = $excel->getCollection();

            $rowone = $collections[0];
            $result = [];
            for ($row = 1; $row < sizeof($collections); $row++) {
                try {
                    $temp = $collections[$row][0];
                    foreach ($collections[$row] as $coll => $val) {
                        if ($coll) {
                            $result[$rowone[$coll]][$temp] = $val;
                            // $result[$rowone[$coll]][$i][$temp] = $val;
                        }
                    }
                    // $i++;
                    // print_r($collections[$row]);
                } catch (\Exception $e) {
                    // return $this->notAcceptable('Sorry.');
                }
            }
            $upload->file_name = $thumbFile;
            $upload->file_path = $destinationPath;
            $upload->file_extension = $ext;
            $upload->file_description = $request->description;
            $upload->file_type = '1';
            $upload->type = '0';
            $upload->save();
            return redirect()->route('csvfiles.index')->with('success',"File Uploaded Successfully");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\CsvFiles  $csvFiles
     * @return \Illuminate\Http\Response
     */
    public function show(CsvFiles $csvFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CsvFiles  $csvFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(CsvFiles $csvFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CsvFiles  $csvFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CsvFiles $csvFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CsvFiles  $csvFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(CsvFiles $csvFiles)
    {
        //
    }

    public function getexcelfile()
    {
        $data = CsvFiles::where('type', 0)->first();
        $excelFile =  public_path('/uploads/csv_files/'.$data->file_name);

        $excel = Importer::make('Excel');
        $excel->load($excelFile);
        $collections = $excel->getCollection();

        $rowone = $collections[0];
        $result = [];
        for ($row = 1; $row < sizeof($collections); $row++) {
            try {
                 $temp = $collections[$row][0];
                foreach ($collections[$row] as $coll => $val) {
                    if ($coll) {
                        $result[$rowone[$coll]][$temp] = $val;
                        // $result[$rowone[$coll]][$i][$temp] = $val;
                    }
                }
            } catch (\Exception $e) {
                // return $this->notAcceptable('Sorry.');
            }

        }
        return $result;
    }
}
