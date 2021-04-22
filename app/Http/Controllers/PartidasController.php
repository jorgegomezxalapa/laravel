<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Entrada;
use Carbon\Carbon;


class PartidasController extends Controller
{
    //
     public function excel (Request $request) {
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

		if (true) {

			$partidasC = Entrada::with('responsable')->with('producto')->count();

			$count = $count + intval($partidasC);

			$partidas = Entrada::with('responsable')->with('producto')->get();

		}else{

			$from = date('2018-01-01');

			$to = date('2018-05-02');

			$partidasC = Entrada::with('responsable')->with('producto')->whereBetween('reservation_from', [$from, $to])->count();

			$count = $count + intval($partidasC);

			$partidas = Entrada::with('responsable')->with('producto')->whereBetween('reservation_from', [$from, $to])->get();
		}

		if ($count == 0) {
			return false;
		}


		
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
