<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
	<style type="text/css">
		body {font-family: 'Rubik', sans-serif;}
		.background {
			display: block;
			width: 100%;
			padding: 5em 0em;
			background-color: #E7E8EB;}

		.container{display: block; width: 80%; max-width: 800px; background-color: white; margin: 0 auto;}
		.box {box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);}
		.image{width: 100%}
		.image-center{margin: 0 auto; display: block;}
		.white{padding: 0 3em 3em 3em;}
		.titulo{text-align: center;}
		.texto{text-align: justify;}
		.pie{display: block; width: 70%; max-width: 600px; margin: 0 auto; font-size: 0.8em; text-align: center; padding: 2em}
		ul {margin-left: 1em; text}

		.enlace{text-decoration: none; color: blue !important; font-weight: bold; float: right;}
		.enlace-texto{text-decoration: none; color: black}
		.enlace-texto:hover{text-decoration: none;}

		.boton{background-color: #045496; border: #045496; margin: 0.4em 1em; color: #fff; font-weight: bold;    transition: all 0.3s ease-in-out; padding: 1rem 3rem; border-radius: 3px; display: inline-flex; align-items: center; justify-content: center; word-break: break-word; text-decoration: none}
		.boton:hover, .boton:focus {color: #ffffff; background-color: #0d6786; border-color: #0d6786; text-decoration: none}
	</style>

	@yield('css')

</head>
<body>
	<div class="background" style="display: block; width: 100%; padding: 5em 0em; background-color: #E7E8EB;">
		<div class="container box" style="display: block; width: 80%; max-width: 800px; background-color: white; margin: 0 auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			<img src="{{ asset('images/correo-top.jpg') }}" class="image" style="width: 100%">
				<div class="white" style="padding: 3em;">
					@yield('content')

					<hr style="margin-top:3em">
					<p style="font-size: 0.8em">
						<b>CONFIDENCIALIDAD DEL CORREO ELECTRÓNICO</b> <br> &nbsp;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						La información contenida en este correo electrónico es confidencial y sólo puede ser utilizada por la persona natural o jurídica a la cual está dirigido y/o por el emisor. Si no es el receptor autorizado, cualquier retención, difusión, distribución o copia de este mensaje es prohibido y será sancionada por la ley. 
						<br> &nbsp;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Si usted recibió este correo por error, destrúyalo y elimine cualquier copia guardada en su sistema notificando inmediatamente al remitente y/o a sistemas@maxwell.com.ve. Usted no debe utilizar esta información para ningún propósito ajeno al dispuesto por el remitente.</p>
				</div>
		</div>

		<hr style="width: 80%; max-width: 800px; margin: auto; margin-top: 2em">
		<p class="pie" style="display: block; width: 80%; max-width: 700px; margin: 0 auto; font-size: 0.8em; text-align: center; padding: 2em">
			A fin de visualizar e imprimir los archivos adjuntos a este correo electrónico 
			o descargados a traves de los enlaces proporcionados es necesario tener en su sistema un lector 
			de archivos PDF, de no tener uno, puede descargar de manera gratuita el lector oficial "Adobe Reader"
			en el siguiente enlace <a href="http://get.adobe.com/es/reader/">get.adobe.com/es/reader</a>
		</p>
	</div>
</body>
</html>
