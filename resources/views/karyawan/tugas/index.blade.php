@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tasks mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-header d-flex flex-warp justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-1">
            </div>
            <div>
                <a href="{{ route('tugasPdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-excel mr-2"></i>
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            
            <h1>
                INI HALAMAN
            </h1>
        </div>
    </div>
@endsection