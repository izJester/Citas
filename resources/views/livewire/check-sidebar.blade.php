<div>
<aside class="w-64 p-6" aria-label="Sidebar">
<ol class="relative border-l border-gray-200 dark:border-gray-700">                  
    <li class="mb-10 ml-6">            
        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            @if(!session('firstStep') && $step == 1)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="blue">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>
@elseif(session('firstStep'))
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="green">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
</svg>
@else
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>     
@endif
        </span>
        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Datos Personales</h3>
        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Recolectamos los datos personales de quien solicita el tramite</p>
    </li>
    <li class="mb-10 ml-6">
        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
        @if(!session('secondStep') && $step == 2)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="blue">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>
@elseif(session('secondStep'))
                
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="green">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
</svg>
@else
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>

@endif
        </span>
        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Documentos</h3>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Selecciona todos los documentos que necesitas certificar.</p>
    </li>
    <li class="mb-10 ml-6">
        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>
        </span>
        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pago</h3>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ultimo paso donde tendras que suministrar datos de pago.</p>
    </li>
</ol>
</aside>
</div>
