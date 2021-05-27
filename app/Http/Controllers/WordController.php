<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Cotizacion;
use App\Partida;
use App\Documento;
use App\Solicitud;
use App\Venta;
use App\User;
use App\Solicitante;
use App\Cliente;
use App\Utilidad;
use Carbon\Carbon;
use Storage;



class WordController extends Controller
{	
	public function getDescarga($idDocumento,$idCotizacion){

		

		$idDocumento = intval($idDocumento);
		$idCotizacion = intval($idCotizacion);

		
		$documento = Documento::where('id', '=', $idDocumento)->first();

		$carpeta1 = $documento->id_razonsocial;
		$carpeta2 = $documento->id_formato;
		$archivo = $documento->documento;
		$ruta = 'storage/documentos/'.$carpeta1.'/'.$carpeta2.'/'.$archivo;
		

		$cotizacion = Cotizacion::where('id', '=', $idCotizacion)->first();

		$solicitud = Solicitud::where('id', '=', $cotizacion->idSolicitud)->first();

		$agente = User::where('id', '=', $solicitud->agente)->first();

		$cliente = Cliente::where('id', '=', $solicitud->cliente)->first();

		$solicitante = Solicitante::where('id', '=', $solicitud->solicitante)->first();

		$responsable = User::where('id', '=', $solicitud->responsable)->first();

		$utilidad = Utilidad::where('id','=',$cotizacion->utilidadGlobal)->first();

		

		$partidas = Partida::where('idCotizacion', '=', $idCotizacion)
		->where('esMejora', '=', 0)
		->orderBy('idProducto', 'ASC')->get();

		$venta = Venta::where('idCotizacion', '=', $idCotizacion)->first();

		
		//VARIABLES
		$fechaNumeros = date("d/m/Y", strtotime(Carbon::now()->toDateString()));
		$fechaLetras = Carbon::now()->isoFormat('dddd D \d\e MMMM \d\e\l Y');

		$clienteRepresentante = $cliente->representante;
		$clienteCargoRepresentante = $cliente->cargoRepresentante;
		$clienteRazonSocial = $cliente->razonSocial;
		$clienteConAtencion = $cliente->conatencion;
		$clienteCargoConAtencion = $cliente->cargoConAtencion;
		$clienteRfc = $cliente->rfc;
		$clienteEmail = $cliente->email;
		$clienteTelefono = $cliente->telefono;

		$solicitanteNombre = $solicitante->nombre;
		$solicitanteEmail = $solicitante->email;
		$solicitanteTelefono = $solicitante->telefono;

		$agenteNombre = $agente->nombre;
		$agenteUsuario = $agente->userName;
		$agenteRol = $agente->rol;
		$agenteEmail = $agente->email;
		$agenteTelefono = $agente->telefono;
		$agenteSexo = $agente->sexo;

		$responsableNombre = $responsable->nombre;
		$responsableUsuario = $responsable->userName;
		$responsableRol = $responsable->rol;
		$responsableEmail = $responsable->email;
		$responsableTelefono = $responsable->telefono;
		$responsableSexo = $responsable->sexo;

		$solicitudFecha = $solicitud->fecha;
		$solicitudFolio = $solicitud->folio;
		$solicitudComentarios = $solicitud->comentario;
		$solicitudTipoUrgencia = ($solicitud->urgente == 1) ? 'URGENTE': 'MARCADA SIN URGENCIA';

		if ($cotizacion->estatus == 1) {
			$cotizacionEstatus = "EN PROCESO";
		}elseif($cotizacion->estatus == 2) {
			$cotizacionEstatus = "FINALIZADA/COTIZADA";
		}else {
			$cotizacionEstatus = "PENDIENTE DE INICIAR";
		}

		$cotizacionUtilidadPorcentaje = $utilidad->porcentaje."%";
		$cotizacionUtilidadDescripcion = $utilidad->descripcion;
		$cotizacionIVAConfigurado = $cotizacion->ivaGlobal;
		$cotizacionIEPSConfigurado = $cotizacion->iepsGlobal;
		$cotizacionFechaFinalizado = $cotizacion->fechafinalizado;

		

		$cotizacionSubtotal = $cotizacion->subtotal;
		$cotizacionIva = $cotizacion->ivaTotal;
		$cotizacionIeps = $cotizacion->iepsTotal;
		$cotizacionTotal = $cotizacion->total;

		$cotizacionAsunto = $cotizacion->asunto;
		$cotizacionVigencia = $cotizacion->vigencia;
		$cotizacionTiempodeentrega = $cotizacion->tiempodeentrega;
		$cotizacionCondicionesdeventa = $cotizacion->condicionesdeventa;

		$tablita = [];

		foreach($partidas as $partida){
			$valor =  [	'cotPartida' => $partida->partida,
						'cotDescripcion' => $partida->descripcion,
						'cotUnidadMedida' => $partida->unidadmedida,
						'cotCantidad' => $partida->cantidad,
						'cotPrecioProveedor' => $partida->precioproveedor,
						'cotPoliticaGarantia' => ($partida->politicas == 1) ? 'INCLUYE POLÍTICAS DE GARANTÍA' : 'NO INCLUYE POLÍTICAS DE GARANTÍA' ,
						'cotMarca' => $partida->marca,	
						'cotModelo' => $partida->modelo,
						'cotNumeroSerie' => $partida->numserie,
						'cotIvaPartida' => $partida->ivapartida."%",
						'cotIepsPartida' => $partida->iepspartida,
						'cotUtilidadPorcentajePartida' => $partida->utilidadpartida."%",
						'cotNotasPartida' => $partida->notasproducto,
						'cotImporte1' => $partida->importe1,
						'cotUtilidadPesosPartida' => $partida->utilidadgenerada,
						'cotPrecioUnitarioPartida' => $partida->preciounitario,
						'cotImporteTotal' => $partida->importe2,
						'cotDisponibilidadPartida'  => $partida->disponible,
						'cotDisponibilidadPartida'  => $partida->disponible,
						'cotSolicitadasPartida'  => $partida->solicitadas];
			array_push($tablita, $valor);
		}

	
		$templateProcessor=new \PhpOffice\PhpWord\TemplateProcessor(public_path($ruta));


		$templateProcessor->setValue('fechaNumeros', $fechaNumeros);
		$templateProcessor->setValue('fechaLetras', $fechaLetras);
		$templateProcessor->setValue('clienteRepresentante', $clienteRepresentante);
		$templateProcessor->setValue('clienteRazonSocial', $clienteRazonSocial);
		$templateProcessor->setValue('clienteConAtencion', $clienteConAtencion);
		$templateProcessor->setValue('clienteRfc', $clienteRfc);
		$templateProcessor->setValue('clienteEmail', $clienteEmail);
		$templateProcessor->setValue('clienteTelefono', $clienteTelefono);
		$templateProcessor->setValue('clienteCargoRepresentante', $clienteTelefono);
		$templateProcessor->setValue('clienteCargoConAtencion', $clienteTelefono);

		$templateProcessor->setValue('solicitanteNombre', $solicitanteNombre);
		$templateProcessor->setValue('solicitanteEmail', $solicitanteEmail);
		$templateProcessor->setValue('solicitanteTelefono', $solicitanteTelefono);

		$templateProcessor->setValue('agenteNombre', $agenteNombre );
		$templateProcessor->setValue('agenteUsuario', $agenteUsuario );
		$templateProcessor->setValue('agenteRol', $agenteRol );
		$templateProcessor->setValue('agenteEmail', $agenteEmail );
		$templateProcessor->setValue('agenteTelefono', $agenteTelefono );
		$templateProcessor->setValue('agenteSexo', $agenteSexo );
		$templateProcessor->setValue('responsableNombre', $responsableNombre );
		$templateProcessor->setValue('responsableUsuario', $responsableUsuario );
		$templateProcessor->setValue('responsableRol', $responsableRol );
		$templateProcessor->setValue('responsableEmail', $responsableEmail );
		$templateProcessor->setValue('responsableTelefono', $responsableTelefono );
		$templateProcessor->setValue('responsableSexo', $responsableSexo );
		$templateProcessor->setValue('solicitudFecha', $solicitudFecha );
		$templateProcessor->setValue('solicitudFolio', $solicitudFolio );
		$templateProcessor->setValue('solicitudComentarios', $solicitudComentarios );
		$templateProcessor->setValue('solicitudTipoUrgencia', $solicitudTipoUrgencia );
		$templateProcessor->setValue('cotizacionEstatus', $cotizacionEstatus );
		$templateProcessor->setValue('cotizacionUtilidadPorcentaje', $cotizacionUtilidadPorcentaje );
		$templateProcessor->setValue('cotizacionUtilidadDescripcion', $cotizacionUtilidadDescripcion );
		$templateProcessor->setValue('cotizacionIVAConfigurado', $cotizacionIVAConfigurado );
		$templateProcessor->setValue('cotizacionIEPSConfigurado', $cotizacionIEPSConfigurado );
		$templateProcessor->setValue('cotizacionFechaFinalizado', $cotizacionFechaFinalizado );
		$templateProcessor->setValue('cotizacionSubtotal', $cotizacionSubtotal );
		$templateProcessor->setValue('cotizacionIva', $cotizacionIva );
		$templateProcessor->setValue('cotizacionIeps', $cotizacionIeps );
		$templateProcessor->setValue('cotizacionTotal', $cotizacionTotal );

		$templateProcessor->setValue('cotizacionAsunto', $cotizacionAsunto );
		$templateProcessor->setValue('cotizacionVigencia', $cotizacionVigencia );
		$templateProcessor->setValue('cotizacionTiempodeentrega', $cotizacionTiempodeentrega );
		$templateProcessor->setValue('cotizacionCondicionesdeventa', $cotizacionCondicionesdeventa );



		$templateProcessor->cloneRowAndSetValues('cotCantidad', $tablita);
	
	

		
		header('Content-Disposition: attachment; filename="Documento.docx"');

		//Enviar el output del objeto al explorador para descarga del usuario.

		$templateProcessor->saveAs("php://output");
		
		// return Storage::download($ruta);
	}

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
