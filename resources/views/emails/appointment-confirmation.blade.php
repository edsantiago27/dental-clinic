<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #667eea;
        }
        .info-value {
            flex: 1;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🦷 Clínica Dental</h1>
        <p>Confirmación de Cita</p>
    </div>
    
    <div class="content">
        <h2>¡Hola {{ $appointment->patient->first_name }}!</h2>
        <p>Tu cita ha sido <strong>confirmada</strong> exitosamente.</p>
        
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">📅 Fecha:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">⏰ Hora:</span>
                <span class="info-value">{{ $appointment->start_time }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">👨‍⚕️ Profesional:</span>
                <span class="info-value">{{ $appointment->dentalProfessional->first_name }} {{ $appointment->dentalProfessional->last_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">🦷 Tratamiento:</span>
                <span class="info-value">{{ $appointment->treatment->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">⏱️ Duración:</span>
                <span class="info-value">{{ $appointment->treatment->duration_minutes }} minutos</span>
            </div>
            @if($appointment->notes)
            <div class="info-row">
                <span class="info-label">📝 Notas:</span>
                <span class="info-value">{{ $appointment->notes }}</span>
            </div>
            @endif
        </div>
        
        <p><strong>Recomendaciones:</strong></p>
        <ul>
            <li>Por favor llega 10 minutos antes de tu cita</li>
            <li>Si necesitas cancelar, hazlo con al menos 24 horas de anticipación</li>
            <li>Trae tu documento de identidad</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
        <p>© {{ date('Y') }} Clínica Dental. Todos los derechos reservados.</p>
    </div>
</body>
</html>