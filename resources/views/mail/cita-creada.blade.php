@extends('layouts.mail')
@section('content')
	<h4>Estimado(a) {{ ucfirst($tramite->nombres) }} {{ ucfirst($tramite->apellidos) }}</h4>
	<p>
		Nos complace informarle que se ha generado una cita en el sistema de taquilla virtual.
    </p>
		<h2 class="titulo">{{ $cita->fecha->format('d/m/Y') }}</h2>
		<p class="titulo">Fecha expresada en dia / mes / año</p>
    <p>
		A fin de proveer un mejor control de acceso y calidad de servicio en la gestión de sus solicitudes presente el código de trámite 
	</p>
    <table style="border: 0; margin: 1em" border="0" cellpadding="2" cellspacing="2" width="100%">
		<!-- <tr>
			<td align="right" style="text-align: right;"><b>Comprobante de Pago: </b></td>
		</tr> -->
		<tr>
			<td align="right" style="text-align: right;"><b>Código identificador: </b></td>
			<td>{{ $tramite->identificador }}</td>
		</tr>
        <tr>
			<td align="right" style="text-align: right;"><b>Titular del trámite: </b></td>
			<td>{{ ucfirst($tramite->nombres)}} {{ ucfirst($tramite->apellidos) }}</td>
		</tr>
		<tr>
			<td align="right" style="text-align: right;"><b>Cédula de indentidad: </b></td>
			<td>{{ $tramite->tipo_cedula }}-{{ $tramite->cedula }}</td>
		</tr>
        
	</table>
	<p>
		Adicionalmente le informamos que el registro de sus datos en el sistema no implica obligatoriedad de recepción, aceptación de sus documentos, trámites y solicitudes, 
        ni tampoco conformidad de parte de la Secretaría General con la información suministrada por usted.
	</p>
@endsection