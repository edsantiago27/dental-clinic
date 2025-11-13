<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Clínico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 5px;
        }
        .section h2 {
            color: #1f2937;
            font-size: 16px;
            margin-top: 0;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            width: 30%;
            padding: 5px;
        }
        .info-value {
            display: table-cell;
            padding: 5px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historial Clínico</h1>
        <p>Clínica Dental</p>
    </div>

    <!-- Información del Paciente -->
    <div class="section">
        <h2>Información del Paciente</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nombre:</div>
                <div class="info-value">{{ $history->patient->first_name }} {{ $history->patient->last_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">RUT:</div>
                <div class="info-value">{{ $history->patient->rut }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Teléfono:</div>
                <div class="info-value">{{ $history->patient->phone }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $history->patient->email ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Información de la Consulta -->
    <div class="section">
        <h2>Información de la Consulta</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Fecha:</div>
                <div class="info-value">{{ $history->consultation_date }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Profesional:</div>
                <div class="info-value">Dr(a). {{ $history->dentalProfessional->first_name }} {{ $history->dentalProfessional->last_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Especialidad:</div>
                <div class="info-value">{{ $history->dentalProfessional->specialty }}</div>
            </div>
        </div>
    </div>

    <!-- Motivo y Síntomas -->
    @if($history->reason_for_visit || $history->symptoms)
    <div class="section">
        <h2>Motivo de Consulta y Síntomas</h2>
        @if($history->reason_for_visit)
        <p><strong>Motivo:</strong> {{ $history->reason_for_visit }}</p>
        @endif
        @if($history->symptoms)
        <p><strong>Síntomas:</strong> {{ $history->symptoms }}</p>
        @endif
    </div>
    @endif

    <!-- Diagnóstico y Tratamiento -->
    <div class="section">
        <h2>Diagnóstico y Tratamiento</h2>
        @if($history->diagnosis)
        <p><strong>Diagnóstico:</strong> {{ $history->diagnosis }}</p>
        @endif
        @if($history->treatment_performed)
        <p><strong>Tratamiento Realizado:</strong> {{ $history->treatment_performed }}</p>
        @endif
        @if($history->prescriptions)
        <p><strong>Prescripciones:</strong> {{ $history->prescriptions }}</p>
        @endif
    </div>

    <!-- Detalles Dentales -->
    @if($history->tooth_number || $history->anesthesia_used || $history->procedure_notes)
    <div class="section">
        <h2>Detalles Dentales</h2>
        @if($history->tooth_number)
        <p><strong>Diente Tratado:</strong> Número {{ $history->tooth_number }}</p>
        @endif
        @if($history->anesthesia_used)
        <p><strong>Anestesia:</strong> {{ $history->anesthesia_type ?? 'Sí' }}</p>
        @endif
        @if($history->procedure_notes)
        <p><strong>Notas del Procedimiento:</strong> {{ $history->procedure_notes }}</p>
        @endif
        @if($history->xray_notes)
        <p><strong>Notas de Rayos X:</strong> {{ $history->xray_notes }}</p>
        @endif
    </div>
    @endif

    <!-- Seguimiento -->
    @if($history->recommendations || $history->observations || $history->next_visit_date)
    <div class="section">
        <h2>Seguimiento</h2>
        @if($history->recommendations)
        <p><strong>Recomendaciones:</strong> {{ $history->recommendations }}</p>
        @endif
        @if($history->observations)
        <p><strong>Observaciones:</strong> {{ $history->observations }}</p>
        @endif
        @if($history->next_visit_date)
        <p><strong>Próxima Visita:</strong> {{ $history->next_visit_date }}</p>
        @endif
    </div>
    @endif

    <!-- Costo -->
    @if($history->total_cost)
    <div class="section">
        <h2>Costo Total</h2>
        <p style="font-size: 18px; font-weight: bold; color: #2563eb;">
            ${{ number_format($history->total_cost, 0, ',', '.') }}
        </p>
    </div>
    @endif

    <!-- Archivos Adjuntos -->
    @if($history->files && count($history->files) > 0)
    <div class="section">
        <h2>Archivos Adjuntos ({{ count($history->files) }})</h2>
        <ul>
            @foreach($history->files as $file)
            <li>{{ $file->file_name }} - {{ $file->description ?? 'Sin descripción' }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="footer">
        <p>Generado el {{ date('d/m/Y H:i') }} | Clínica Dental - Sistema de Gestión</p>
    </div>
</body>
</html>