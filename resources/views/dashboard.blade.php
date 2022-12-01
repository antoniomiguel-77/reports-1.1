<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex col-md-12 justify-content-between">
            <span>Gerencie Suas Tarefas</span>
            <div class="">
                <a href="{{route('report.task')}}" target="_blank" class="btn btn-md btn-primary">
                    <i class="fa fa-print"></i>
                    Relatório
                </a>
                @php
                $control = \App\Models\Control::find(1);
                    $today  = abs(date('d'));
                    $time  = date('H:i');
                @endphp
                @if ($today === $control->day && $control->time === $time)
                <a href="{{route('new_weekend')}}" target="_blank" class="btn btn-md btn-primary">
                    <i class="fa fa-refresh"></i>
                    Nova Semana
                </a>
                @endif
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show setTime" role="alert">
                    <strong>Sucesso!</strong> {{session('msg')}}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                  </div>
            @elseif(session('error')) 
                <div class="alert alert-danger alert-dismissible fade show setTime" role="alert">
                    <strong>Erro!</strong> {{session('error')}}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            @endif
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>
