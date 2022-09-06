@extends('layouts.mail')
@section('content')
<h4>Estimado(a) {{ ucfirst($tramite->nombres) }} {{ ucfirst($tramite->apellidos) }}</h4>
<p>
	Nos complace informarle que su registro de trámite en el sistema de taquilla virtual fué exitoso,
	este paso permitió confirmar sus datos personales e información de contacto, estos serán utilizados en la gestión de sus documentos.
</p>
<p>
	A fin de proveer un mejor control y calidad de servicio en la gestión de sus solicitudes,
	un funcionario administrativo de la Universidad Nacional Experimental Politécnica de la Fuerza Armada estará validando su información
	y enviará una respuesta de seguimiento a su correo electrónico.
</p>
<p>
	A fin de proveer un mejor control y calidad de servicio en la gestión de sus solicitudes se adjunta recibo de pago, código identificador de su transacción y resumen de los documentos solicitados
</p>

<h4>Solicitante</h4>
<table style="border: 0; margin: 1em" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr>
		<td width="40%" align="right" style="text-align: right; width: 40%;"><b>Código identificador: </b></td>
		<td>{{ $tramite->identificador }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Titular del trámite: </b></td>
		<td>{{ Str::ucfirst(Str::lower($tramite->nombres))}} {{ Str::ucfirst(Str::lower($tramite->apellidos)) }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Cédula de indentidad: </b></td>
		<td>{{ $tramite->tipo_cedula }}-{{ $tramite->cedula }}</td>
	</tr>
</table>

<h4>Comprobante de Pago</h4>
<table style="border: 0; margin: 1em" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr>
		<td width="40%" align="right" style="text-align: right; width: 40%;"><b>Transacción: </b></td>
		<td>{{ $pago->transactionId }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Referencia: </b></td>
		<td>{{ $pago->reference }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Método de pago: </b></td>
		<td>{{ $pago->paymentMethodDescription }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Fecha: </b></td>
		<td>{{ $pago->paymentDate }}</td>
	</tr>
	<tr>
		<td align="right" style="text-align: right;"><b>Monto: </b></td>
		<td>{{ $pago->amount }} Bs.</td>
	</tr>
</table>

<h4>Documentos solicitados</h4>
<table style="border: 0; margin: 1em" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr>
		<td><b>Modalidad</b></td>
		<td><b>Documento</b></td>
		<td><b>Monto (Petros)</b></td>
		<td><b>Solicitado</b></td>
	</tr>
	@foreach ($tramite->motivos as $motivo)
	<tr>
		<td>{{ Str::ucfirst($motivo['tipo']) }}</td>
		<td>{{ Str::ucfirst($motivo['motivo']) }}</td>
		<td>{{ $motivo['precio'] }}</td>
		<td>{{ $motivo['cantidad'] }}</td>
	</tr>
	@endforeach
</table>
<p>
	Adicionalmente le informamos que el registro de sus datos en el sistema no implica obligatoriedad de recepción, aceptación de sus documentos, trámites y solicitudes,
	ni tampoco conformidad de parte de la Secretaría General con la información suministrada por usted.
</p>
@endsection