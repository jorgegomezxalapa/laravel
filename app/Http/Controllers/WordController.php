<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Cotizacion;
use Carbon;
use Storage;



class WordController extends Controller
{

	public function descargarDocumento ($cotizacion,$rs,$tipo,$documento) {

	return Storage::download('documentos/1/1/cotizacion.docx');

date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d');



$dt = Carbon\Carbon::now();
$fecha = strtoupper ( $dt->format('l jS \\of F Y') ) ;  



		$id = intval($cotizacion);
          $cotizacion = Cotizacion::where('id', '=', $id )
          ->with('solicitud')
          ->with('utilidad')
          ->with('solicitud.agente')
          ->with('solicitud.cliente')
          ->with('solicitud.solicitante')
          ->with('solicitud.responsable')
          ->with('partidas')
          ->first();
          return $cotizacion->solicitud->all() ;
         
          $url="app/documentos/";
          $url=$url.$rs."/".$tipo."/".$documento;
         
		$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor(storage_path($url));
	

		

		
		$templateProcessor->setValue(' fecha', "JUEVES 22 DE ABRIL DEL 2021");

		$templateProcessor->setValue('representante', $cotizacion->cliente->nombre);

		 

		$templateProcessor->setValue('cargo', 'AUXILIAR ADMINISTRATIVO');

		$templateProcessor->setValue('cliente', 'FISCALÍA GENERAL DEL ESTADO DE VERACRUZ');

		$templateProcessor->setValue('parrafo', 'Coloque su tabla aqui.');

		

		 

		


		
header('Content-Disposition: attachment; filename="Documento.docx"');

//Enviar el output del objeto al explorador para descarga del usuario.

$templateProcessor->saveAs("php://output");

	}
   public function word2 () {
      try {

		$documento = new \PhpOffice\PhpWord\PhpWord();
		$propiedades = $documento->getDocInfo();
		$propiedades->setCreator("SIN INFORMACIÓN");
		$propiedades->setCompany("SIN INFORMACIÓN");
		$propiedades->setTitle("FORMATO DE COTIZACIÓN");
		$propiedades->setDescription("FORMATO DE COTIZACIÓN");
		$propiedades->setCategory("COTIZACIÓN");
		$propiedades->setLastModifiedBy("SIN INFORMACIÓN");
		$propiedades->setCreated(time());
		$propiedades->setModified(time());
		$propiedades->setSubject("COTIZACIÓN");
		$propiedades->setKeywords("documento, php, word");
		# Para que no diga que se abre en modo de compatibilidad
		$documento->getCompatibility()->setOoxmlVersion(15);
		# Idioma español de México
		$documento->getSettings()->setThemeFontLang(new Language("ES-MX"));
		//a partir de aqui va el body

		$seccion = $documento->addSection();
# Títulos. Solo modificando depth (el número)
$fuenteTitulo = [
    "name" => "Verdana",
    "size" => 20,
    "color" => "000000",
];
$documento->addTitleStyle(1, $fuenteTitulo);
$seccion->addTitle("Cotizaciones web", 1);
$textRun = $seccion->addTextRun([
    "alignment" => Jc::BOTH,
    "lineHeight" => 1, # Quedará muy pegado
]);
$fuente = [
    "name" => "Arial",
    "size" => 12,
    "color" => "8bc34a",
    "italic" => true,
    "bold" => true,
];

$textRun->addText("Un sistema web con PHP y MySQL que permite crear clientes y a partir de ellos cotizaciones con el costo automático, así como el tiempo de la cotización. ");
$textRun->addTextBreak(2);
$textRun->addText("Más tarde, eso se puede imprimir. Aparte de eso, se cuenta con el apartado de los ajustes, en donde se personalizan algunos mensajes");
$textRun->addTextBreak(2);
$textRun->addText("Hice el sistema porque personalmente necesitaba un software para cotizaciones que a veces son requeridas por mis clientes");

$textRun->addTextBreak(5);

$textRun->addText("Texto con una fuente, en el mismo párrafo ", $fuente);

$fuente = [
    "name" => "Verdana",
    "size" => 10,
    "color" => "00ff00",
];
$textRun->addText("que continúa aquí con otra fuente ", $fuente);
$fuente = [
    "name" => "Courier new",
    "size" => 8,
    "color" => "0000ee",
];
$textRun->addText("y sigue por aquí...", $fuente);

# Se pueden agregar más textruns, este va alineado al centro

$otroTextRun = $seccion->addTextRun([
    "alignment" => Jc::CENTER,
    "lineHeight" => 0.7,
]);
$fuente = [
    "name" => "Century Gothic",
    "size" => 15,
    "color" => "000000",
];

$otroTextRun->addText("Lorem ipsum dolor sit amet consectetur adipiscing, elit nulla et aptent ultricies inceptos, tristique torquent lacinia auctor integer. Facilisi eu tempus donec platea inceptos diam dis aliquam mi, vitae senectus ullamcorper nisi torquent auctor vehicula. Viverra rhoncus vestibulum ante bibendum dui volutpat duis auctor dictumst nulla, risus feugiat fusce nisl semper urna nullam aliquam.", $fuente);
$otroTextRun->addTextBreak(2);
$otroTextRun->addText("Pharetra pulvinar curae ac ante risus vestibulum mus diam neque, facilisi scelerisque dignissim velit suscipit ultrices nostra. Laoreet vivamus sem pretium nisi risus natoque magnis cubilia, aliquet eleifend posuere imperdiet dictum sociosqu vel fringilla, diam luctus penatibus eu at ultricies praesent. Nulla habitasse duis felis nostra senectus dapibus, sociosqu porttitor interdum scelerisque tortor donec pharetra, enim ligula dignissim hac nisl.", $fuente);
$otroTextRun->addTextBreak(2);

$seccion = $documento->addSection();
# Simple texto
$seccion->addText("Hola, esto es algo de texto");
# Agregar 5 saltos
$seccion->addTextBreak(5);
$seccion->addText("Texto 5 saltos después");
# Agregar un salto de página
$seccion->addPageBreak();
$seccion->addText("Estoy en una nueva línea");
$seccion->addPageBreak();
$seccion->addText("Estoy en una nueva línea");

		// # Guardarlo
		// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, "Word2007");
		// $objWriter->save("formato_cotizacion.docx");
		# Enviar encabezados para indicar que vamos a enviar un documento de Word
		$nombre = "libro.docx";
		header("Content-Description: File Transfer");
		header('Content-Disposition: attachment; filename="' . $nombre . '"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, "Word2007");
		# Y lo enviamos a php://output
		$objWriter->save("php://output");
      } catch (Exception $e) {
        

      }
    }

}
