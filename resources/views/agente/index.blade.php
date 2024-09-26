@extends('layouts.layout')
@section('content')
    <div class="main-agente-container">
        @if (Auth::user()->empresa_id == 1)
            {{-- RYR --}}
            <iframe title="RyR"
                src="https://app.powerbi.com/view?r=eyJrIjoiZTQ2M2M5M2QtODA4My00NDhhLTg0YWItYjNmZWJlNTcwZmIwIiwidCI6Ijk2OWUxYWZhLTM2YWItNGQ5ZS1iYmM2LWU5Y2U3ZWE0N2U5OSIsImMiOjR9"
                frameborder="0" allowFullScreen="true"></iframe>
        @elseif (Auth::user()->empresa_id == 2)
            {{-- Cia Lubricantes --}}
            <iframe title="Cia Lubricantes"
                src="https://app.powerbi.com/view?r=eyJrIjoiZjNjNWRjOGItMjcwZi00NTU1LWE4MzEtZWVlMjhmMWQxOGJmIiwidCI6Ijk2OWUxYWZhLTM2YWItNGQ5ZS1iYmM2LWU5Y2U3ZWE0N2U5OSIsImMiOjR9"
                frameborder="0" allowFullScreen="true"></iframe>
        @else
            {{-- OT --}}
            <iframe title="Visionarios"
                src="https://app.powerbi.com/view?r=eyJrIjoiMWQ0ZTRjYjctMTJkMi00MGJjLTk1NGQtOGZkNmU0NmFkMjgzIiwidCI6Ijk2OWUxYWZhLTM2YWItNGQ5ZS1iYmM2LWU5Y2U3ZWE0N2U5OSIsImMiOjR9"
                frameborder="0" allowFullScreen="true"></iframe>
        @endif
    </div>
@endsection
