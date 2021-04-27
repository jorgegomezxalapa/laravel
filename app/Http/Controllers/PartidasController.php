<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Entrada;
use App\Salida;
use Carbon\Carbon;


class PartidasController extends Controller
{
    //
     public function getExcel ($id) {

     	echo asset('storage/file.txt');
     	
     	
		//CON ESO OBTENGO LA FECHA ACTUAL
		
		$fecha = date("d/m/Y", strtotime(Carbon::now()->toDateString()));
		$fechaString = Carbon::now()->isoFormat('dddd D \d\e MMMM \d\e\l Y');
		return $fecha;

     	switch (intval($id)) {
	    case 0:
	    $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de entrada');
		$sheet->setCellValue('B1', 'Responsable');
		$sheet->setCellValue('C1', 'Concepto');
		$sheet->setCellValue('D1', 'Cantidad');
		$sheet->setCellValue('E1', 'Descripción');
		$sheet->setCellValue('F1', 'Unidad de medida');
		$sheet->setCellValue('G1', 'MARCA');
		$sheet->setCellValue('H1', 'MODELO');

		$rows = 2;
		$count = 0;

		$partidas = Entrada::with('responsable')->with('producto')->get();
		foreach($partidas as $partida){
		$sheet->setCellValue('A' . $rows, $partida->created_at);
		$sheet->setCellValue('B' . $rows, $partida->responsable->name);
		$sheet->setCellValue('C' . $rows, $partida->concepto);
		$sheet->setCellValue('D' . $rows, $partida->cantidad);
		$sheet->setCellValue('E' . $rows, $partida->producto->descripcion);
		$sheet->setCellValue('F' . $rows, $partida->producto->unidaddemedida);
		$sheet->setCellValue('G' . $rows, $partida->producto->marca);
		$sheet->setCellValue('H' . $rows, $partida->producto->modelo);
		$rows++;
		}

		
		

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=entradas.xlsx");
		ob_end_clean();
		$writer->save('php://output');
		exit();
	        
	        break;
	    case 1:
	    $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Fecha de Salida');
		$sheet->setCellValue('B1', 'Responsable');
		$sheet->setCellValue('C1', 'Concepto');
		$sheet->setCellValue('D1', 'Cantidad');
		$sheet->setCellValue('E1', 'Descripción');
		$sheet->setCellValue('F1', 'Unidad de medida');
		$sheet->setCellValue('G1', 'MARCA');
		$sheet->setCellValue('H1', 'MODELO');

		$rows = 2;
		$count = 0;

		$partidas = Salida::with('empleado')->with('producto')->get();
		foreach($partidas as $partida){
		$sheet->setCellValue('A' . $rows, $partida->created_at);
		$sheet->setCellValue('B' . $rows, $partida->empleado->name);
		$sheet->setCellValue('C' . $rows, $partida->concepto);
		$sheet->setCellValue('D' . $rows, $partida->cantidad);
		$sheet->setCellValue('E' . $rows, $partida->producto->descripcion);
		$sheet->setCellValue('F' . $rows, $partida->producto->unidaddemedida);
		$sheet->setCellValue('G' . $rows, $partida->producto->marca);
		$sheet->setCellValue('H' . $rows, $partida->producto->modelo);
		$rows++;
		}

		
		

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=salidas.xlsx");
		ob_end_clean();
		$writer->save('php://output');
		exit();
	        
	        break;
	   
	}
     	

		$rows = 2;
		$count = 0;

		

			
		

		


		
		foreach($partidas as $partida){
		$sheet->setCellValue('A' . $rows, $partida->created_at);
		$sheet->setCellValue('B' . $rows, $partida->responsable->name);
		$sheet->setCellValue('C' . $rows, $partida->concepto);
		$sheet->setCellValue('D' . $rows, $partida->cantidad);
		$sheet->setCellValue('E' . $rows, $partida->producto->descripcion);
		$sheet->setCellValue('F' . $rows, $partida->producto->unidaddemedida);
		$sheet->setCellValue('G' . $rows, $partida->producto->marca);
		$sheet->setCellValue('H' . $rows, $partida->producto->modelo);
		$rows++;
		}

		$sheet->setCellValue('A1', 'Hello World !');

		

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=archivo.xlsx");
		ob_end_clean();
		$writer->save('php://output');
		exit();
    }
     
}
