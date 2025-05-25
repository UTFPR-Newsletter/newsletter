<div class="flex w-full max-w-3xl mx-auto">
    <div class="flex-shrink-0">
        <span class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700/40 border border-gray-300 border-r-0 rounded-l-md h-full">
            <i class="fad fa-envelope text-xl"></i>
        </span>
    </div>
    <input
        type="email"
        wire:model.defer="subscriberEmail"
        placeholder="Digite seu e-mail"
        class="flex-1 px-4 py-3 text-lg bg-white border border-gray-300 focus:ring-1 focus:ring-gray-400"
    />
    <button
        wire:click="subscribe"
        wire:loading.attr="disabled"
        class="px-6 py-3 bg-white text-lg rounded-r-md border border-gray-300 border-l-0 text-gray-800
        hover:bg-gray-800 hover:text-white transition-colors duration-200"
    >
        {{ $loading ? 'Assinando...' : 'Assinar' }}
    </button>
</div>
