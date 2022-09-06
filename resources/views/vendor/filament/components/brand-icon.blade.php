@if (filled($brand = config('filament.brand')))
    <div @class([
        'filament-brand text-xl font-bold tracking-tight',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
        <img src="/images/escudo.png" alt="Icon" class="h-full w-full object-contain" />
    </div>
@endif
