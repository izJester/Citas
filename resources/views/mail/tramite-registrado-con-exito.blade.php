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
		A fin de proveer un mejor control y calidad de servicio en la gestión de sus solicitudes se adjunta el resumen de los documentos solicitados
	</p>
    <table style="border: 0; margin: 1em" border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td align="right" style="text-align: right;"><b>Comprobante de Pago: </b></td>
			<td><a href="{{ $url }}">Enlace</a></td>
		</tr>
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
        <tr>
			<td align="right" style="text-align: right;"><b>Documentos solicitados: </b></td>
			<td>
                <ul style="margin-left: 0 !important">
                    @foreach ($tramite->motivos as $documento)
                    <li>{{ json_decode($documento)->nombre }}</li>
                    @endforeach
                </ul>
            </td>
		</tr>
	</table>
	<p>
		Adicionalmente le informamos que el registro de sus datos en el sistema no implica obligatoriedad de recepción, aceptación de sus documentos, trámites y solicitudes, 
        ni tampoco conformidad de parte de la Secretaría General con la información suministrada por usted.
	</p>
@endsection