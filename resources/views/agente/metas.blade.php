@extends('layouts.layout')
@section('content')
    <div>
        <div class="main-asesor-container">
            <div class="table-container">
                <div class="table-header">Mis Metas</div>
                <div class="table-grid">
                    <!-- Column Headers -->
                    <div class="table-cell header"></div>
                    <div class="table-cell header">COBERTURA</div>
                    <div class="table-cell header">VOLUMEN</div>
                    <div class="table-cell header">VISIBILIDAD</div>
                    <div class="table-cell header">FRECUENCIA</div>
                    <div class="table-cell header">PRECIO</div>
    
                    <!-- Row: Meta -->
                    <div class="table-cell row-header">Meta</div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
    
                    <!-- Row: Ejecución -->
                    <div class="table-cell row-header">Ejecución</div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
    
                    <!-- Row: Porcentaje Ejecución -->
                    <div class="table-cell row-header">Porcentaje Ejecución</div>
                    <div class="table-cell">
                        <div class="progress-bar">
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="progress-bar">
                            
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="progress-bar">
                            
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="progress-bar">
                            
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="progress-bar">
                            
                        </div>
                    </div>
    
                    <div class="table-cell row-header"></div>
                    <div class="table-cell">%</div>
                    <div class="table-cell">%</div>
                    <div class="table-cell">%</div>
                    <div class="table-cell">%</div>
                    <div class="table-cell">%</div>
                </div>
            </div>
        </div>
    </div>
@endsection
