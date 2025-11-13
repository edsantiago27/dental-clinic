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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #fff8dc;
            padding: 30px;
            border: 2px solid #f5576c;
            border-top: none;
        }
        .reminder-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f5576c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⏰ Recordatorio de Cita</h1>
    </div>
    
    <div class="content">
        <h2>¡Hola {{ $appointment->patient->first_name }}!</h2>
        <p><strong>Te recordamos que mañana tienes una cita en nuestra clínica.</strong></p>
        
        <div class="reminder-box">
            <h3>📅 Detalles de tu Cita:</h3>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ $appointment->start_time }}</p>
            <p><strong>Profesional:</strong> {{ $appointment->dentalProfessional->full_name }}</p>
            <p><strong>Tratamiento:</strong> {{ $appointment->treatment->name }}</p>
        </div>
        
        <p>¡Te esperamos! 😊</p>
    </div>
</body>
</html>