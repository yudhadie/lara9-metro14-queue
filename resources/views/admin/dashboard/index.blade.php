@extends('admin.templates.default')

@section('content')

    <div class="content flex-column-fluid" id="kt_content">

    </div>

@endsection

@push('scripts')

    <script>
        var element = document.getElementById('menu-dashboard');
            element.classList.add('active');
    </script>

@endpush
