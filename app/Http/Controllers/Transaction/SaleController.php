<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Excel as Excelmodel;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sale;
use Illuminate\Support\Collection;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sale::all();
        return view('administrator/SaleManager/SaleReport',array('data'=>$data));
    }

   
    public function create()
    {
        
        return view('administrator/SaleManager/AddSale');
    }

    public function addByExcel()
    {
        return view('administrator/SaleManager/AddSaleExcel');
    }

    public function reviewExcelData(Request $request)
    {
        Excelmodel::truncate();
        $validated = $request->validate([
            'date'     => 'required|date',
            'file'     => 'required|mimes:xlsx',
        ]);
        Excel::import(new ExcelImport, $request->file);
        $sale = Excelmodel::all();
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($sale);
 
        
    }

    public function fetchEditExcelData(Request $request)
    {
       $id = $request->id;
       $sale = Excelmodel::find($id);
       header('Content-Type: application/json; charset=utf-8');
       echo json_encode($sale);
       
    }

    public function updateEditExcelData(Request $request)
    {
        $validated = $request->validate([
            'sId'      => 'required',
            'date'     => 'required|date',
            'menu'     => 'required',
            'quantity' => 'required|numeric',
            'price'    => 'required|numeric',
        ]);
        $data = Excelmodel::find($request->sId);
        $data['menu']     = $request->menu;
        $data['quantity'] = $request->quantity;
        $data['discount'] = $request->discount;
        $data['total']    = $request->price;
        $data['review']   = $request->review;
        $data['entry']    = date('Y-m-d',strtotime($request->date));
        $data->save();
        $sale = Excelmodel::all();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('msg'=>'Your Data is successfully Updated','responce'=>$sale));
    }

    public function removeEditExcelData(Request $request)
    {
       $id   = $request->id;
       $sale = Excelmodel::find($id);
       $sale->delete();
       header('Content-Type: application/json; charset=utf-8');
       echo json_encode('Your Data is successfully Removed');
       
    }

    public function uploadAllExcelData(Request $request)
    {
       $data = array();
       $sale = Excelmodel::all();
       if($sale){
        foreach($sale as $s){
            $data[] = array('menu'=>$s->menu,'quantity'=>$s->quantity,'discount'=>$s->discount,'total'=>$s->total,'review'=>$s->review,'entry'=>$s->entry);
        }
       }
       Sale::insert($data);
       Excelmodel::truncate();
       header('Content-Type: application/json; charset=utf-8');
       echo json_encode('Your Data is successfully Removed');
       
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required|date',
            'menu'     => 'required',
            'quantity' => 'required|numeric',
            'price'    => 'required|numeric',
        ]);
        $data = new Sale();
        $data['menu']     = $request->menu;
        $data['quantity'] = $request->quantity;
        $data['discount'] = $request->discount;
        $data['total']    = $request->price;
        $data['review']   = $request->review;
        $data['entry']    = date('Y-m-d',strtotime($request->date));
        $data->save();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode('Your Data is successfully Stored');
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit(Request $request)
    {
        $id = $request->id;
        $sale = Sale::find($id);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($sale);
    }

 
    public function update(Request $request)
    {
        $validated = $request->validate([
            'sId'      => 'required',
            'date'     => 'required|date',
            'menu'     => 'required',
            'quantity' => 'required|numeric',
            'price'    => 'required|numeric',
        ]);
        $data = Sale::find($request->sId);
        $data['menu']     = $request->menu;
        $data['quantity'] = $request->quantity;
        $data['discount'] = $request->discount;
        $data['total']    = $request->price;
        $data['review']   = $request->review;
        $data['entry']    = date('Y-m-d',strtotime($request->date));
        $data->save();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('msg'=>'Your Data is successfully Updated'));
    }

    public function destroy(Request $request)
    {
       $id   = $request->id;
       $sale = Sale::find($id);
       $sale->delete();
       header('Content-Type: application/json; charset=utf-8');
       echo json_encode('Your Data is successfully Removed');
    }
}
