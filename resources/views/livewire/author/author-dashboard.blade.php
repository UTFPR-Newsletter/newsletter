@section('page-title', 'Dashboard')

<div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
    <!-- Construction Image -->
    <img src="{{ asset('images/spider_going_down.png') }}" alt="Em Construção" class="w-32 h-32 mb-8" />
    
    <!-- Title -->
    <h2 class="text-3xl font-bold text-gray-800 mb-4">
        Dashboard do Autor
    </h2>
    
    <!-- Message -->
    <p class="text-lg text-gray-600 mb-8 max-w-2xl">
        Estamos trabalhando para trazer a melhor experiência possível para você gerenciar suas newsletters. 
        Em breve você terá acesso a todas as funcionalidades!
    </p>
    
    <!-- Progress Bar -->
    <div class="w-full max-w-md bg-gray-200 rounded-full h-2.5 mb-6">
        <div class="bg-gray-800 h-2.5 rounded-full w-[45%]"></div>
    </div>
    
    <!-- Status -->
    <p class="text-sm text-gray-500">
        Status: Em desenvolvimento (45% concluído)
    </p>
</div> 