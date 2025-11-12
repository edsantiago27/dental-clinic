<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Clínica Dental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .modal { display: none; }
        .modal.active { display: flex; }
        .fade-in { animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="bg-gray-50">

    <!-- ============================================ -->
    <!-- PANTALLA DE LOGIN -->
    <!-- ============================================ -->
    <div id="loginScreen" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-green-400">
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
            <div class="text-center mb-8">
                <i class="fas fa-tooth text-6xl text-blue-500 mb-4"></i>
                <h1 class="text-3xl font-bold text-gray-800">Clínica Dental</h1>
                <p class="text-gray-600 mt-2">Sistema de Gestión</p>
            </div>
            
            <!-- Tabs -->
            <div class="flex mb-6 border-b">
                <button id="loginTab" onclick="showAuthTab('login')" 
                    class="flex-1 py-3 text-center font-semibold border-b-2 border-blue-500 text-blue-600">
                    Iniciar Sesión
                </button>
                <button id="registerTab" onclick="showAuthTab('register')" 
                    class="flex-1 py-3 text-center font-semibold border-b-2 border-transparent text-gray-500 hover:text-blue-600">
                    Registrarse
                </button>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" id="loginEmail" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="admin@dental.com">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Contraseña
                    </label>
                    <input type="password" id="loginPassword" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••">
                </div>
                
                <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-green-500 text-white py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-green-600 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                </button>
            </form>

            <!-- Register Form -->
            <form id="registerForm" class="space-y-4" style="display: none;">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Nombre
                        </label>
                        <input type="text" id="registerFirstName" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Apellido
                        </label>
                        <input type="text" id="registerLastName" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-id-card mr-2"></i>RUT
                    </label>
                    <input type="text" id="registerRut" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="12345678-9">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2"></i>Teléfono
                    </label>
                    <input type="tel" id="registerPhone" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="+56912345678">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <input type="email" id="registerEmail" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="tu@email.com">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Contraseña
                    </label>
                    <input type="password" id="registerPassword" required minlength="6"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Mínimo 6 caracteres">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Confirmar Contraseña
                    </label>
                    <input type="password" id="registerPasswordConfirm" required minlength="6"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Repite tu contraseña">
                </div>
                
                <button type="submit" 
                    class="w-full bg-gradient-to-r from-green-500 to-blue-500 text-white py-3 rounded-lg font-semibold hover:from-green-600 hover:to-blue-600 transition">
                    <i class="fas fa-user-plus mr-2"></i>Crear Cuenta
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-2">Credenciales de Prueba:</p>
                <p class="text-xs text-gray-600"><strong>Admin:</strong> admin@dental.com / admin123</p>
                <p class="text-xs text-gray-600"><strong>Paciente:</strong> paciente@test.com / 123456</p>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- DASHBOARD PRINCIPAL -->
    <!-- ============================================ -->
    <div id="dashboardScreen" style="display: none;">
        
        <!-- Header -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-tooth text-3xl text-blue-500"></i>
                    <h1 class="text-2xl font-bold text-gray-800">Clínica Dental</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-700" id="userName">Admin</span>
                    <button onclick="logout()" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Navigation Tabs -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex space-x-8">
                    <button onclick="showSection('dashboard')" class="nav-tab py-4 px-2 border-b-2 border-blue-500 text-blue-600 font-medium">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </button>
                    <button onclick="showSection('appointments')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-calendar-alt mr-2"></i>Citas
                    </button>
                    <button onclick="showSection('patients')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-users mr-2"></i>Pacientes
                    </button>
                    <button onclick="showSection('professionals')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-user-md mr-2"></i>Profesionales
                    </button>
                    <button onclick="showSection('treatments')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-tooth mr-2"></i>Tratamientos
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 py-8">

            <!-- ============================================ -->
            <!-- SECCIÓN DASHBOARD -->
            <!-- ============================================ -->
            <div id="dashboardSection" class="section">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Panel de Control</h2>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Total Citas</p>
                                <p class="text-3xl font-bold text-gray-800" id="totalAppointments">0</p>
                            </div>
                            <i class="fas fa-calendar-alt text-4xl text-blue-500"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Pacientes</p>
                                <p class="text-3xl font-bold text-gray-800" id="totalPatients">0</p>
                            </div>
                            <i class="fas fa-users text-4xl text-green-500"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Profesionales</p>
                                <p class="text-3xl font-bold text-gray-800" id="totalProfessionals">0</p>
                            </div>
                            <i class="fas fa-user-md text-4xl text-purple-500"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-orange-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Tratamientos</p>
                                <p class="text-3xl font-bold text-gray-800" id="totalTreatments">0</p>
                            </div>
                            <i class="fas fa-tooth text-4xl text-orange-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Próximas Citas</h3>
                    <div id="recentAppointments" class="space-y-3">
                        <!-- Se llena dinámicamente -->
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN CITAS -->
            <!-- ============================================ -->
            <div id="appointmentsSection" class="section" style="display: none;">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Gestión de Citas</h2>
                    <button onclick="openAppointmentModal()" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-plus mr-2"></i>Nueva Cita
                    </button>
                </div>

                <!-- Filters -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <input type="date" id="filterDate" class="px-4 py-2 border rounded-lg">
                        <select id="filterStatus" class="px-4 py-2 border rounded-lg">
                            <option value="">Todos los estados</option>
                            <option value="Pending">Pendiente</option>
                            <option value="Confirmed">Confirmada</option>
                            <option value="Completed">Completada</option>
                            <option value="Cancelled">Cancelada</option>
                        </select>
                        <select id="filterProfessional" class="px-4 py-2 border rounded-lg">
                            <option value="">Todos los profesionales</option>
                        </select>
                        <button onclick="filterAppointments()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-search mr-2"></i>Filtrar
                        </button>
                    </div>
                </div>

                <!-- Appointments Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Paciente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Profesional</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tratamiento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="appointmentsTable">
                            <!-- Se llena dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN PACIENTES -->
            <!-- ============================================ -->
            <div id="patientsSection" class="section" style="display: none;">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Gestión de Pacientes</h2>
                    <button onclick="openPatientModal()" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                        <i class="fas fa-plus mr-2"></i>Nuevo Paciente
                    </button>
                </div>

                <!-- Search -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <input type="text" id="searchPatient" placeholder="Buscar paciente por nombre o RUT..." 
                        class="w-full px-4 py-2 border rounded-lg" onkeyup="searchPatients()">
                </div>

                <!-- Patients Grid -->
                <div id="patientsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Se llena dinámicamente -->
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN PROFESIONALES -->
            <!-- ============================================ -->
            <div id="professionalsSection" class="section" style="display: none;">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Gestión de Profesionales</h2>
                    <button onclick="openProfessionalModal()" class="bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition">
                        <i class="fas fa-plus mr-2"></i>Nuevo Profesional
                    </button>
                </div>

                <!-- Professionals Grid -->
                <div id="professionalsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Se llena dinámicamente -->
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN TRATAMIENTOS -->
            <!-- ============================================ -->
            <div id="treatmentsSection" class="section" style="display: none;">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Gestión de Tratamientos</h2>
                    <button onclick="openTreatmentModal()" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition">
                        <i class="fas fa-plus mr-2"></i>Nuevo Tratamiento
                    </button>
                </div>

                <!-- Treatments Grid -->
                <div id="treatmentsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Se llena dinámicamente -->
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN MIS CITAS (PACIENTES) -->
            <!-- ============================================ -->
            <div id="myAppointmentsSection" class="section" style="display: none;">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Mis Citas</h2>

                <!-- Mis Citas Cards -->
                <div id="myAppointmentsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Se llena dinámicamente -->
                </div>
            </div>

            <!-- ============================================ -->
            <!-- SECCIÓN AGENDAR CITA (PACIENTES) -->
            <!-- ============================================ -->
            <div id="bookAppointmentSection" class="section" style="display: none;">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Agendar Nueva Cita</h2>

                <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto">
                    <!-- Botón de prueba para recargar -->
                    <button onclick="loadBookAppointmentForm()" class="mb-4 bg-gray-500 text-white px-4 py-2 rounded text-sm">
                        🔄 Recargar Formulario
                    </button>
                    
                    <form id="patientAppointmentForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user-md mr-2"></i>Profesional
                            </label>
                            <select id="patientAppointmentProfessional" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Cargando profesionales...</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Si no aparecen opciones, presiona "Recargar Formulario"</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tooth mr-2"></i>Tratamiento
                            </label>
                            <select id="patientAppointmentTreatment" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Cargando tratamientos...</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-2"></i>Fecha
                                </label>
                                <input type="date" id="patientAppointmentDate" required 
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock mr-2"></i>Hora
                                </label>
                                <input type="time" id="patientAppointmentTime" required 
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-comment mr-2"></i>Notas (opcional)
                            </label>
                            <textarea id="patientAppointmentNotes" rows="3" 
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                placeholder="Indique el motivo de su consulta o alguna información relevante..."></textarea>
                        </div>

                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-green-500 text-white py-4 rounded-lg font-semibold hover:from-blue-600 hover:to-green-600 transition text-lg">
                            <i class="fas fa-check-circle mr-2"></i>Confirmar Cita
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- ============================================ -->
    <!-- MODALES -->
    <!-- ============================================ -->

    <!-- Modal Cita -->
    <div id="appointmentModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <span id="appointmentModalTitle">Nueva Cita</span>
                </h3>
                <button onclick="closeAppointmentModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="appointmentForm" class="space-y-4">
                <input type="hidden" id="appointmentId">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Paciente</label>
                        <select id="appointmentPatient" required class="w-full px-4 py-2 border rounded-lg">
                            <option value="">Seleccionar...</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profesional</label>
                        <select id="appointmentProfessional" required class="w-full px-4 py-2 border rounded-lg">
                            <option value="">Seleccionar...</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tratamiento</label>
                        <select id="appointmentTreatment" required class="w-full px-4 py-2 border rounded-lg">
                            <option value="">Seleccionar...</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                        <select id="appointmentStatus" class="w-full px-4 py-2 border rounded-lg">
                            <option value="Pending">Pendiente</option>
                            <option value="Confirmed">Confirmada</option>
                            <option value="Completed">Completada</option>
                            <option value="Cancelled">Cancelada</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                        <input type="date" id="appointmentDate" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hora</label>
                        <input type="time" id="appointmentTime" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                    <textarea id="appointmentNotes" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                    <button type="button" onclick="closeAppointmentModal()" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Paciente -->
    <div id="patientModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <span id="patientModalTitle">Nuevo Paciente</span>
                </h3>
                <button onclick="closePatientModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="patientForm" class="space-y-4">
                <input type="hidden" id="patientId">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input type="text" id="patientFirstName" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                        <input type="text" id="patientLastName" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">RUT</label>
                        <input type="text" id="patientRut" required class="w-full px-4 py-2 border rounded-lg" placeholder="12345678-9">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                        <input type="tel" id="patientPhone" required class="w-full px-4 py-2 border rounded-lg" placeholder="+56912345678">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="patientEmail" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Nacimiento</label>
                        <input type="date" id="patientBirthdate" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                    <input type="text" id="patientAddress" class="w-full px-4 py-2 border rounded-lg">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alergias</label>
                    <textarea id="patientAllergies" rows="2" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                    <button type="button" onclick="closePatientModal()" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Profesional -->
    <div id="professionalModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <span id="professionalModalTitle">Nuevo Profesional</span>
                </h3>
                <button onclick="closeProfessionalModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="professionalForm" class="space-y-4">
                <input type="hidden" id="professionalId">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input type="text" id="professionalFirstName" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                        <input type="text" id="professionalLastName" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Especialidad</label>
                        <input type="text" id="professionalSpecialty" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nº Licencia</label>
                        <input type="text" id="professionalLicense" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                        <input type="tel" id="professionalPhone" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="professionalEmail" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select id="professionalStatus" class="w-full px-4 py-2 border rounded-lg">
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-purple-500 text-white py-3 rounded-lg hover:bg-purple-600">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                    <button type="button" onclick="closeProfessionalModal()" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tratamiento -->
    <div id="treatmentModal" class="modal fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <span id="treatmentModalTitle">Nuevo Tratamiento</span>
                </h3>
                <button onclick="closeTreatmentModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <form id="treatmentForm" class="space-y-4">
                <input type="hidden" id="treatmentId">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Tratamiento</label>
                    <input type="text" id="treatmentName" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea id="treatmentDescription" rows="3" required class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duración (minutos)</label>
                        <input type="number" id="treatmentDuration" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio (CLP)</label>
                        <input type="number" id="treatmentPrice" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                    <button type="button" onclick="closeTreatmentModal()" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- JAVASCRIPT -->
    <!-- ============================================ -->
    <script>
        // ========================================
        // CONFIGURACIÓN
        // ========================================
        const API_URL = 'http://127.0.0.1:8001/api';
        let authToken = localStorage.getItem('authToken') || null;
        let currentUser = JSON.parse(localStorage.getItem('currentUser')) || null;
        let allAppointments = [];
        let allPatients = [];
        let allProfessionals = [];
        let allTreatments = [];

        // Verificar si hay sesión activa al cargar la página
        window.addEventListener('DOMContentLoaded', () => {
            if (authToken && currentUser) {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('dashboardScreen').style.display = 'block';
                document.getElementById('userName').textContent = currentUser.full_name || currentUser.username;
                loadDashboardData();
                setupNavigation();
            }
        });

        // ========================================
        // FUNCIONES DE AUTENTICACIÓN
        // ========================================
        
        // Cambiar entre tabs de Login y Registro
        function showAuthTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            if (tab === 'login') {
                loginTab.classList.add('border-blue-500', 'text-blue-600');
                loginTab.classList.remove('border-transparent', 'text-gray-500');
                registerTab.classList.remove('border-blue-500', 'text-blue-600');
                registerTab.classList.add('border-transparent', 'text-gray-500');
                
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                registerTab.classList.add('border-blue-500', 'text-blue-600');
                registerTab.classList.remove('border-transparent', 'text-gray-500');
                loginTab.classList.remove('border-blue-500', 'text-blue-600');
                loginTab.classList.add('border-transparent', 'text-gray-500');
                
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }

        // Login
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            try {
                const response = await fetch(`${API_URL}/auth/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    authToken = data.data.token;
                    currentUser = data.data.user;
                    
                    // Guardar en localStorage para persistencia
                    localStorage.setItem('authToken', authToken);
                    localStorage.setItem('currentUser', JSON.stringify(currentUser));
                    
                    document.getElementById('loginScreen').style.display = 'none';
                    document.getElementById('dashboardScreen').style.display = 'block';
                    document.getElementById('userName').textContent = currentUser.full_name || currentUser.username;
                    
                    await loadDashboardData();
                    setupNavigation();
                } else {
                    alert('Error: ' + (data.message || 'Credenciales inválidas'));
                }
            } catch (error) {
                console.error('Error en login:', error);
                alert('Error al conectar con el servidor');
            }
        });

        // Registro
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const password = document.getElementById('registerPassword').value;
            const passwordConfirm = document.getElementById('registerPasswordConfirm').value;
            
            // Validar que las contraseñas coincidan
            if (password !== passwordConfirm) {
                alert('Las contraseñas no coinciden');
                return;
            }
            
            const data = {
                first_name: document.getElementById('registerFirstName').value,
                last_name: document.getElementById('registerLastName').value,
                rut: document.getElementById('registerRut').value,
                phone: document.getElementById('registerPhone').value,
                email: document.getElementById('registerEmail').value,
                password: password,
                password_confirmation: passwordConfirm
            };
            
            try {
                const response = await fetch(`${API_URL}/auth/register`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    let message = result.message || '¡Registro exitoso! Ahora puedes iniciar sesión.';
                    
                    if (result.data?.existing_patient_linked) {
                        message += '\n\n✅ Se encontró tu historial previo como paciente y ha sido vinculado a tu cuenta. Podrás ver todas tus citas anteriores.';
                    }
                    
                    alert(message);
                    document.getElementById('registerForm').reset();
                    showAuthTab('login');
                    
                    // Prellenar el email en el formulario de login
                    document.getElementById('loginEmail').value = data.email;
                } else {
                    const errorMsg = result.message || 'Error al registrar usuario';
                    const errors = result.errors;
                    
                    if (errors) {
                        let errorText = errorMsg + '\n\n';
                        for (let field in errors) {
                            errorText += errors[field].join('\n') + '\n';
                        }
                        alert(errorText);
                    } else {
                        alert(errorMsg);
                    }
                }
            } catch (error) {
                console.error('Error en registro:', error);
                alert('Error al conectar con el servidor');
            }
        });

        function logout() {
            authToken = null;
            currentUser = null;
            localStorage.removeItem('authToken');
            localStorage.removeItem('currentUser');
            document.getElementById('loginScreen').style.display = 'flex';
            document.getElementById('dashboardScreen').style.display = 'none';
            document.getElementById('loginForm').reset();
            document.getElementById('registerForm').reset();
        }

        // ========================================
        // CONFIGURAR NAVEGACIÓN SEGÚN ROL
        // ========================================
        function setupNavigation() {
            const navTabs = document.querySelector('.max-w-7xl.mx-auto.px-4 .flex.space-x-8');
            
            if (currentUser.role === 'patient') {
                // Vista para pacientes
                navTabs.innerHTML = `
                    <button onclick="showSection('dashboard')" class="nav-tab py-4 px-2 border-b-2 border-blue-500 text-blue-600 font-medium">
                        <i class="fas fa-home mr-2"></i>Inicio
                    </button>
                    <button onclick="showSection('myAppointments')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-calendar-alt mr-2"></i>Mis Citas
                    </button>
                    <button onclick="showSection('bookAppointment')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-plus-circle mr-2"></i>Agendar Cita
                    </button>
                `;
            } else {
                // Vista para admin (ya existe)
                navTabs.innerHTML = `
                    <button onclick="showSection('dashboard')" class="nav-tab py-4 px-2 border-b-2 border-blue-500 text-blue-600 font-medium">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </button>
                    <button onclick="showSection('appointments')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-calendar-alt mr-2"></i>Citas
                    </button>
                    <button onclick="showSection('patients')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-users mr-2"></i>Pacientes
                    </button>
                    <button onclick="showSection('professionals')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-user-md mr-2"></i>Profesionales
                    </button>
                    <button onclick="showSection('treatments')" class="nav-tab py-4 px-2 border-b-2 border-transparent text-gray-600 hover:text-blue-600">
                        <i class="fas fa-tooth mr-2"></i>Tratamientos
                    </button>
                `;
            }
        }

        // ========================================
        // NAVEGACIÓN
        // ========================================
        function showSection(section) {
            console.log('🎯 Navegando a sección:', section);
            
            // Ocultar todas las secciones
            document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
            
            // Remover clase activa de todos los tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('border-transparent', 'text-gray-600');
            });
            
            // Mostrar sección seleccionada
            const sectionElement = document.getElementById(section + 'Section');
            if (sectionElement) {
                sectionElement.style.display = 'block';
                console.log('✅ Sección mostrada:', section + 'Section');
            } else {
                console.error('❌ No se encontró la sección:', section + 'Section');
            }
            
            // Activar tab correspondiente
            if (event && event.target) {
                event.target.classList.remove('border-transparent', 'text-gray-600');
                event.target.classList.add('border-blue-500', 'text-blue-600');
            }
            
            // Cargar datos según sección
            console.log('📊 Cargando datos para:', section);
            
            // Usar async/await apropiadamente
            if (section === 'dashboard') {
                loadDashboardData();
            } else if (section === 'appointments') {
                loadAppointments();
            } else if (section === 'patients') {
                loadPatients();
            } else if (section === 'professionals') {
                loadProfessionals();
            } else if (section === 'treatments') {
                loadTreatments();
            } else if (section === 'myAppointments') {
                loadMyAppointments();
            } else if (section === 'bookAppointment') {
                console.log('🚀 Llamando a loadBookAppointmentForm directamente...');
                // Llamar directamente sin setTimeout
                loadBookAppointmentForm().then(() => {
                    console.log('✅ loadBookAppointmentForm completado');
                }).catch(err => {
                    console.error('❌ Error en loadBookAppointmentForm:', err);
                });
            }
        }

        // ========================================
        // FUNCIONES PARA PACIENTES
        // ========================================
        async function loadMyAppointments() {
            try {
                const response = await apiRequest(`/appointments?patient_id=${currentUser.patient_id || currentUser.id}`);
                
                // Normalizar datos
                const appointmentsData = response?.data?.data || response?.data || (Array.isArray(response) ? response : []);
                
                const grid = document.getElementById('myAppointmentsGrid');
                
                if (!appointmentsData || appointmentsData.length === 0) {
                    grid.innerHTML = '<p class="text-gray-500 text-center col-span-3 py-8">No tienes citas agendadas</p>';
                    return;
                }
                
                grid.innerHTML = appointmentsData.map(apt => `
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">${apt.treatment?.name || 'Sin tratamiento'}</h3>
                                <p class="text-sm text-purple-600 font-medium">${apt.dentalProfessional?.first_name || ''} ${apt.dentalProfessional?.last_name || ''}</p>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full ${getStatusClass(apt.status)}">
                                ${getStatusText(apt.status)}
                            </span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar mr-2 text-blue-500"></i>
                                <strong>${apt.appointment_date}</strong>
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-clock mr-2 text-green-500"></i>
                                <strong>${apt.start_time || ''}</strong>
                            </p>
                            ${apt.notes ? `
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-comment mr-2 text-gray-400"></i>
                                    ${apt.notes}
                                </p>
                            ` : ''}
                        </div>
                        
                        ${apt.status === 'Pending' || apt.status === 'Confirmed' ? `
                            <button onclick="cancelMyAppointment(${apt.id})" 
                                class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 text-sm">
                                <i class="fas fa-times-circle mr-1"></i>Cancelar Cita
                            </button>
                        ` : ''}
                    </div>
                `).join('');
                
            } catch (error) {
                console.error('Error cargando mis citas:', error);
            }
        }

        async function loadBookAppointmentForm() {
            try {
                const [professionals, treatments] = await Promise.all([
                    apiRequest('/professionals'),
                    apiRequest('/treatments')
                ]);
                
                const professionalsData = professionals?.data?.data || professionals?.data || (Array.isArray(professionals) ? professionals : []);
                const treatmentsData = treatments?.data?.data || treatments?.data || (Array.isArray(treatments) ? treatments : []);
                
                document.getElementById('patientAppointmentProfessional').innerHTML = 
                    '<option value="">Seleccionar profesional...</option>' +
                    (Array.isArray(professionalsData) ? professionalsData.map(p => 
                        `<option value="${p.id}">${p.first_name} ${p.last_name} - ${p.specialty}</option>`
                    ).join('') : '');
                
                document.getElementById('patientAppointmentTreatment').innerHTML = 
                    '<option value="">Seleccionar tratamiento...</option>' +
                    (Array.isArray(treatmentsData) ? treatmentsData.map(t => 
                        `<option value="${t.id}">${t.name} - ${Number(t.price).toLocaleString('es-CL')} (${t.duration} min)</option>`
                    ).join('') : '');
                
                // Establecer fecha mínima como hoy
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('patientAppointmentDate').setAttribute('min', today);
                
            } catch (error) {
                console.error('Error cargando formulario:', error);
            }
        }

        document.getElementById('patientAppointmentForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Obtener el patient_id del usuario actual
            let patientId = currentUser.patient_id;
            
            // Si no tiene patient_id en el user, buscar en la tabla patients
            if (!patientId) {
                try {
                    const patientsResponse = await apiRequest('/patients');
                    const patientsData = patientsResponse?.data?.data || patientsResponse?.data || [];
                    const patient = patientsData.find(p => p.user_id === currentUser.id);
                    patientId = patient?.id;
                } catch (error) {
                    console.error('Error buscando paciente:', error);
                }
            }
            
            if (!patientId) {
                alert('Error: No se pudo encontrar el registro de paciente. Por favor contacte al administrador.');
                return;
            }
            
            const data = {
                patient_id: patientId,
                dental_professional_id: document.getElementById('patientAppointmentProfessional').value,
                treatment_id: document.getElementById('patientAppointmentTreatment').value,
                appointment_date: document.getElementById('patientAppointmentDate').value,
                start_time: document.getElementById('patientAppointmentTime').value,
                status: 'Pending',
                notes: document.getElementById('patientAppointmentNotes').value
            };
            
            try {
                const response = await apiRequest('/appointments', 'POST', data);
                
                if (response.success) {
                    alert('¡Cita agendada exitosamente! Recibirás una confirmación pronto.');
                    document.getElementById('patientAppointmentForm').reset();
                    showSection('myAppointments');
                } else {
                    alert('Error: ' + (response.message || 'No se pudo agendar la cita'));
                }
            } catch (error) {
                console.error('Error agendando cita:', error);
                alert('Error al agendar la cita: ' + error.message);
            }
        });

        async function cancelMyAppointment(id) {
            if (!confirm('¿Está seguro de cancelar esta cita?')) return;
            
            try {
                const response = await apiRequest(`/appointments/${id}/cancel`, 'PUT', { 
                    reason: 'Cancelada por el paciente' 
                });
                
                if (response.success) {
                    alert('Cita cancelada correctamente');
                    loadMyAppointments();
                } else {
                    alert('Error al cancelar la cita');
                }
            } catch (error) {
                console.error('Error cancelando cita:', error);
                alert('Error al cancelar la cita');
            }
        }

        // ========================================
        // FUNCIONES API GENERALES
        // ========================================
        async function apiRequest(endpoint, method = 'GET', body = null) {
            const options = {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${authToken}`
                }
            };
            
            if (body) {
                options.body = JSON.stringify(body);
            }
            
            try {
                const response = await fetch(`${API_URL}${endpoint}`, options);
                
                // Verificar si la respuesta es JSON
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    console.error('Error: El servidor no devolvió JSON');
                    throw new Error('El servidor devolvió HTML en lugar de JSON. Verifica la ruta del API.');
                }
                
                return await response.json();
            } catch (error) {
                console.error('Error en apiRequest:', error);
                throw error;
            }
        }

        // ========================================
        // DASHBOARD
        // ========================================
        async function loadDashboardData() {
            try {
                if (currentUser.role === 'patient') {
                    // Dashboard para pacientes
                    await loadPatientDashboard();
                } else {
                    // Dashboard para admin
                    await loadAdminDashboard();
                }
            } catch (error) {
                console.error('Error cargando dashboard:', error);
            }
        }

        async function loadPatientDashboard() {
            // Cargar solo las citas del paciente
            const response = await apiRequest(`/appointments?patient_id=${currentUser.patient_id || currentUser.id}`);
            const appointmentsData = response?.data?.data || response?.data || (Array.isArray(response) ? response : []);
            
            const dashboardSection = document.getElementById('dashboardSection');
            
            // Dashboard simplificado para pacientes
            dashboardSection.innerHTML = `
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Bienvenido, ${currentUser.full_name || currentUser.username}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Total Citas</p>
                                <p class="text-3xl font-bold text-gray-800">${appointmentsData.length}</p>
                            </div>
                            <i class="fas fa-calendar-alt text-4xl text-blue-500"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Próximas</p>
                                <p class="text-3xl font-bold text-gray-800">${appointmentsData.filter(a => new Date(a.appointment_date) >= new Date() && a.status !== 'Cancelled').length}</p>
                            </div>
                            <i class="fas fa-clock text-4xl text-green-500"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600 text-sm">Completadas</p>
                                <p class="text-3xl font-bold text-gray-800">${appointmentsData.filter(a => a.status === 'Completed').length}</p>
                            </div>
                            <i class="fas fa-check-circle text-4xl text-purple-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mis Próximas Citas</h3>
                    <div id="patientUpcomingAppointments" class="space-y-3">
                        ${appointmentsData.filter(a => new Date(a.appointment_date) >= new Date() && a.status !== 'Cancelled')
                            .slice(0, 5)
                            .map(apt => `
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold">${apt.treatment?.name || 'Sin tratamiento'}</p>
                                        <p class="text-sm text-gray-600">${apt.dentalProfessional?.first_name || ''} ${apt.dentalProfessional?.last_name || ''}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold">${apt.appointment_date}</p>
                                        <p class="text-sm text-gray-600">${apt.start_time || ''}</p>
                                    </div>
                                </div>
                            `).join('') || '<p class="text-gray-500 text-center py-4">No hay citas próximas</p>'}
                    </div>
                </div>
            `;
        }

        async function loadAdminDashboard() {
            // Cargar estadísticas
            const [appointments, patients, professionals, treatments] = await Promise.all([
                apiRequest('/appointments'),
                apiRequest('/patients'),
                apiRequest('/professionals'),
                apiRequest('/treatments')
            ]);
            
            // Normalizar las respuestas (manejando paginación de Laravel)
            const appointmentsData = appointments?.data?.data || appointments?.data || (Array.isArray(appointments) ? appointments : []);
            const patientsData = patients?.data?.data || patients?.data || (Array.isArray(patients) ? patients : []);
            const professionalsData = professionals?.data?.data || professionals?.data || (Array.isArray(professionals) ? professionals : []);
            const treatmentsData = treatments?.data?.data || treatments?.data || (Array.isArray(treatments) ? treatments : []);
            
            document.getElementById('totalAppointments').textContent = Array.isArray(appointmentsData) ? appointmentsData.length : 0;
            document.getElementById('totalPatients').textContent = Array.isArray(patientsData) ? patientsData.length : 0;
            document.getElementById('totalProfessionals').textContent = Array.isArray(professionalsData) ? professionalsData.length : 0;
            document.getElementById('totalTreatments').textContent = Array.isArray(treatmentsData) ? treatmentsData.length : 0;
            
            // Mostrar próximas citas
            const upcomingAppointments = Array.isArray(appointmentsData) ? appointmentsData.filter(apt => {
                const aptDate = new Date(apt.appointment_date);
                return aptDate >= new Date() && apt.status !== 'cancelled' && apt.status !== 'Cancelled';
            }).slice(0, 5) : [];
            
            const recentHtml = upcomingAppointments.length > 0 
                ? upcomingAppointments.map(apt => `
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold">${apt.patient?.first_name || ''} ${apt.patient?.last_name || ''}</p>
                            <p class="text-sm text-gray-600">${apt.treatment?.name || 'Sin tratamiento'}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">${apt.appointment_date}</p>
                            <p class="text-sm text-gray-600">${apt.start_time || ''}</p>
                        </div>
                    </div>
                `).join('')
                : '<p class="text-gray-500 text-center py-4">No hay citas próximas</p>';
            
            document.getElementById('recentAppointments').innerHTML = recentHtml;
        }

        // ========================================
        // CITAS - CRUD COMPLETO
        // ========================================
        async function loadAppointments() {
            try {
                const response = await apiRequest('/appointments');
                
                // Manejar paginación de Laravel: response.data.data
                if (response && response.data) {
                    if (Array.isArray(response.data.data)) {
                        // Paginación de Laravel
                        allAppointments = response.data.data;
                    } else if (Array.isArray(response.data)) {
                        // Array directo
                        allAppointments = response.data;
                    } else {
                        allAppointments = [];
                    }
                } else if (Array.isArray(response)) {
                    allAppointments = response;
                } else {
                    console.error('Formato de respuesta incorrecto:', response);
                    allAppointments = [];
                }
                
                renderAppointmentsTable(allAppointments);
                
                // Cargar opciones para filtros
                await loadFilterOptions();
            } catch (error) {
                console.error('Error cargando citas:', error);
                alert('Error al cargar citas. Verifica la consola.');
            }
        }

        function renderAppointmentsTable(appointments) {
            const tbody = document.getElementById('appointmentsTable');
            
            if (!appointments || appointments.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay citas registradas</td></tr>';
                return;
            }
            
            tbody.innerHTML = appointments.map(apt => `
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">${apt.patient?.first_name} ${apt.patient?.last_name}</td>
                    <td class="px-6 py-4">${apt.appointment_date}</td>
                    <td class="px-6 py-4">${apt.start_time}</td>
                    <td class="px-6 py-4">${apt.dental_professional?.first_name} ${apt.dental_professional?.last_name}</td>
                    <td class="px-6 py-4">${apt.treatment?.name}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full ${getStatusClass(apt.status)}">
                            ${getStatusText(apt.status)}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="editAppointment(${apt.id})" class="text-blue-500 hover:text-blue-700 mr-2" title="Editar cita">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteAppointment(${apt.id})" class="text-red-500 hover:text-red-700" title="Eliminar cita">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function getStatusClass(status) {
            const classes = {
                'scheduled': 'bg-blue-100 text-blue-800',
                'Pending': 'bg-blue-100 text-blue-800',
                'confirmed': 'bg-green-100 text-green-800',
                'Confirmed': 'bg-green-100 text-green-800',
                'completed': 'bg-gray-100 text-gray-800',
                'Completed': 'bg-gray-100 text-gray-800',
                'cancelled': 'bg-red-100 text-red-800',
                'Cancelled': 'bg-red-100 text-red-800'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        }

        function getStatusText(status) {
            const texts = {
                'scheduled': 'Programada',
                'Pending': 'Pendiente',
                'confirmed': 'Confirmada',
                'Confirmed': 'Confirmada',
                'completed': 'Completada',
                'Completed': 'Completada',
                'cancelled': 'Cancelada',
                'Cancelled': 'Cancelada'
            };
            return texts[status] || status;
        }

        async function loadFilterOptions() {
            try {
                const response = await apiRequest('/professionals');
                const professionals = response.data || [];
                
                const select = document.getElementById('filterProfessional');
                select.innerHTML = '<option value="">Todos los profesionales</option>' +
                    professionals.map(prof => `
                        <option value="${prof.id}">${prof.first_name} ${prof.last_name}</option>
                    `).join('');
            } catch (error) {
                console.error('Error cargando profesionales para filtro:', error);
            }
        }

        function filterAppointments() {
            const date = document.getElementById('filterDate').value;
            const status = document.getElementById('filterStatus').value;
            const professional = document.getElementById('filterProfessional').value;
            
            let filtered = allAppointments;
            
            if (date) {
                filtered = filtered.filter(apt => apt.appointment_date === date);
            }
            
            if (status) {
                filtered = filtered.filter(apt => apt.status === status);
            }
            
            if (professional) {
                filtered = filtered.filter(apt => apt.dental_professional_id == professional);
            }
            
            renderAppointmentsTable(filtered);
        }

        async function openAppointmentModal(id = null) {
            document.getElementById('appointmentModalTitle').textContent = id ? 'Editar Cita' : 'Nueva Cita';
            document.getElementById('appointmentId').value = id || '';
            
            // Cargar opciones
            try {
                const [patients, professionals, treatments] = await Promise.all([
                    apiRequest('/patients'),
                    apiRequest('/professionals'),
                    apiRequest('/treatments')
                ]);
                
                // Normalizar datos (manejar paginación)
                const patientsData = patients?.data?.data || patients?.data || (Array.isArray(patients) ? patients : []);
                const professionalsData = professionals?.data?.data || professionals?.data || (Array.isArray(professionals) ? professionals : []);
                const treatmentsData = treatments?.data?.data || treatments?.data || (Array.isArray(treatments) ? treatments : []);
                
                document.getElementById('appointmentPatient').innerHTML = 
                    '<option value="">Seleccionar...</option>' +
                    (Array.isArray(patientsData) ? patientsData.map(p => `<option value="${p.id}">${p.first_name} ${p.last_name}</option>`).join('') : '');
                
                document.getElementById('appointmentProfessional').innerHTML = 
                    '<option value="">Seleccionar...</option>' +
                    (Array.isArray(professionalsData) ? professionalsData.map(p => `<option value="${p.id}">${p.first_name} ${p.last_name}</option>`).join('') : '');
                
                document.getElementById('appointmentTreatment').innerHTML = 
                    '<option value="">Seleccionar...</option>' +
                    (Array.isArray(treatmentsData) ? treatmentsData.map(t => `<option value="${t.id}">${t.name}</option>`).join('') : '');
                
                // Si es edición, cargar datos
                if (id) {
                    const appointment = allAppointments.find(a => a.id == id);
                    if (appointment) {
                        document.getElementById('appointmentPatient').value = appointment.patient_id;
                        document.getElementById('appointmentProfessional').value = appointment.dental_professional_id;
                        document.getElementById('appointmentTreatment').value = appointment.treatment_id;
                        document.getElementById('appointmentDate').value = appointment.appointment_date;
                        document.getElementById('appointmentTime').value = appointment.start_time;
                        document.getElementById('appointmentStatus').value = appointment.status;
                        document.getElementById('appointmentNotes').value = appointment.notes || '';
                    }
                } else {
                    document.getElementById('appointmentForm').reset();
                }
                
                document.getElementById('appointmentModal').classList.add('active');
            } catch (error) {
                console.error('Error cargando datos para modal:', error);
                alert('Error al cargar datos del formulario');
            }
        }

        function closeAppointmentModal() {
            document.getElementById('appointmentModal').classList.remove('active');
            document.getElementById('appointmentForm').reset();
        }

        document.getElementById('appointmentForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('appointmentId').value;
            const data = {
                patient_id: document.getElementById('appointmentPatient').value,
                dental_professional_id: document.getElementById('appointmentProfessional').value,
                treatment_id: document.getElementById('appointmentTreatment').value,
                appointment_date: document.getElementById('appointmentDate').value,
                start_time: document.getElementById('appointmentTime').value,
                status: document.getElementById('appointmentStatus').value,
                notes: document.getElementById('appointmentNotes').value
            };
            
            try {
                let response;
                if (id) {
                    // Editar cita existente
                    response = await apiRequest(`/appointments/${id}`, 'PUT', data);
                } else {
                    // Crear nueva cita
                    response = await apiRequest('/appointments', 'POST', data);
                }
                
                if (response.success) {
                    alert(id ? 'Cita actualizada correctamente' : 'Cita creada correctamente');
                    closeAppointmentModal();
                    loadAppointments();
                    loadDashboardData(); // Actualizar dashboard
                } else {
                    alert('Error: ' + (response.message || 'No se pudo guardar la cita'));
                }
            } catch (error) {
                console.error('Error guardando cita:', error);
                alert('Error al guardar la cita: ' + error.message);
            }
        });

        function editAppointment(id) {
            openAppointmentModal(id);
        }

        async function deleteAppointment(id) {
            if (!confirm('¿Está seguro de eliminar esta cita?')) return;
            
            try {
                const response = await apiRequest(`/appointments/${id}`, 'DELETE');
                
                if (response.success) {
                    alert('Cita eliminada correctamente');
                    loadAppointments();
                } else {
                    alert('Error al eliminar la cita');
                }
            } catch (error) {
                console.error('Error eliminando cita:', error);
                alert('Error al eliminar la cita');
            }
        }

        // ========================================
        // PACIENTES - CRUD COMPLETO
        // ========================================
        async function loadPatients() {
            try {
                const response = await apiRequest('/patients');
                
                // Validar que la respuesta tenga el formato correcto
                if (response && response.data && Array.isArray(response.data)) {
                    allPatients = response.data;
                } else if (Array.isArray(response)) {
                    allPatients = response;
                } else {
                    console.error('Formato de respuesta incorrecto:', response);
                    allPatients = [];
                }
                
                renderPatientsGrid(allPatients);
            } catch (error) {
                console.error('Error cargando pacientes:', error);
                alert('Error al cargar pacientes. Verifica la consola.');
            }
        }

        function renderPatientsGrid(patients) {
            const grid = document.getElementById('patientsGrid');
            
            if (!patients || patients.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 text-center col-span-3 py-8">No hay pacientes registrados</p>';
                return;
            }
            
            grid.innerHTML = patients.map(patient => `
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">${patient.first_name} ${patient.last_name}</h3>
                            <p class="text-sm text-gray-600">RUT: ${patient.rut}</p>
                        </div>
                        <i class="fas fa-user-circle text-3xl text-green-500"></i>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-phone mr-2"></i>${patient.phone}
                        </p>
                        ${patient.email ? `
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-envelope mr-2"></i>${patient.email}
                            </p>
                        ` : ''}
                        ${patient.address ? `
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2"></i>${patient.address}
                            </p>
                        ` : ''}
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="editPatient(${patient.id})" 
                            class="flex-1 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 text-sm">
                            <i class="fas fa-edit mr-1"></i>Editar
                        </button>
                        <button onclick="deletePatient(${patient.id})" 
                            class="flex-1 bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 text-sm">
                            <i class="fas fa-trash mr-1"></i>Eliminar
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function searchPatients() {
            const search = document.getElementById('searchPatient').value.toLowerCase();
            
            const filtered = allPatients.filter(patient => {
                const fullName = `${patient.first_name} ${patient.last_name}`.toLowerCase();
                const rut = patient.rut.toLowerCase();
                return fullName.includes(search) || rut.includes(search);
            });
            
            renderPatientsGrid(filtered);
        }

        function openPatientModal(id = null) {
            document.getElementById('patientModalTitle').textContent = id ? 'Editar Paciente' : 'Nuevo Paciente';
            document.getElementById('patientId').value = id || '';
            
            if (id) {
                const patient = allPatients.find(p => p.id == id);
                if (patient) {
                    document.getElementById('patientFirstName').value = patient.first_name;
                    document.getElementById('patientLastName').value = patient.last_name;
                    document.getElementById('patientRut').value = patient.rut;
                    document.getElementById('patientPhone').value = patient.phone;
                    document.getElementById('patientEmail').value = patient.email || '';
                    document.getElementById('patientBirthdate').value = patient.birthdate || '';
                    document.getElementById('patientAddress').value = patient.address || '';
                    document.getElementById('patientAllergies').value = patient.allergies || '';
                }
            } else {
                document.getElementById('patientForm').reset();
            }
            
            document.getElementById('patientModal').classList.add('active');
        }

        function closePatientModal() {
            document.getElementById('patientModal').classList.remove('active');
            document.getElementById('patientForm').reset();
        }

        document.getElementById('patientForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('patientId').value;
            const data = {
                first_name: document.getElementById('patientFirstName').value,
                last_name: document.getElementById('patientLastName').value,
                rut: document.getElementById('patientRut').value,
                phone: document.getElementById('patientPhone').value,
                email: document.getElementById('patientEmail').value,
                birthdate: document.getElementById('patientBirthdate').value,
                address: document.getElementById('patientAddress').value,
                allergies: document.getElementById('patientAllergies').value
            };
            
            try {
                const endpoint = id ? `/patients/${id}` : `/patients`;
                const method = id ? 'PUT' : 'POST';
                
                const response = await apiRequest(endpoint, method, data);
                
                if (response.success) {
                    alert(id ? 'Paciente actualizado correctamente' : 'Paciente creado correctamente');
                    closePatientModal();
                    loadPatients();
                } else {
                    alert('Error: ' + (response.message || 'No se pudo guardar el paciente'));
                }
            } catch (error) {
                console.error('Error guardando paciente:', error);
                alert('Error al guardar el paciente');
            }
        });

        function editPatient(id) {
            openPatientModal(id);
        }

        async function deletePatient(id) {
            if (!confirm('¿Está seguro de eliminar este paciente?')) return;
            
            try {
                const response = await apiRequest(`/patients/${id}`, 'DELETE');
                
                if (response.success) {
                    alert('Paciente eliminado correctamente');
                    loadPatients();
                } else {
                    alert('Error al eliminar el paciente');
                }
            } catch (error) {
                console.error('Error eliminando paciente:', error);
                alert('Error al eliminar el paciente');
            }
        }

        // ========================================
        // PROFESIONALES - CRUD COMPLETO
        // ========================================
        async function loadProfessionals() {
            try {
                const response = await apiRequest('/professionals');
                
                // Validar que la respuesta tenga el formato correcto
                if (response && response.data && Array.isArray(response.data)) {
                    allProfessionals = response.data;
                } else if (Array.isArray(response)) {
                    allProfessionals = response;
                } else {
                    console.error('Formato de respuesta incorrecto:', response);
                    allProfessionals = [];
                }
                
                renderProfessionalsGrid(allProfessionals);
            } catch (error) {
                console.error('Error cargando profesionales:', error);
                alert('Error al cargar profesionales. Verifica la consola.');
            }
        }

        function renderProfessionalsGrid(professionals) {
            const grid = document.getElementById('professionalsGrid');
            
            if (!professionals || professionals.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 text-center col-span-3 py-8">No hay profesionales registrados</p>';
                return;
            }
            
            grid.innerHTML = professionals.map(prof => `
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">${prof.first_name} ${prof.last_name}</h3>
                            <p class="text-sm text-purple-600 font-medium">${prof.specialty}</p>
                            <p class="text-xs text-gray-500">Lic: ${prof.license_number}</p>
                        </div>
                        <i class="fas fa-user-md text-3xl text-purple-500"></i>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-phone mr-2"></i>${prof.phone}
                        </p>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-envelope mr-2"></i>${prof.email}
                        </p>
                        <span class="inline-block px-2 py-1 text-xs rounded-full ${prof.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                            ${prof.status === 'active' ? 'Activo' : 'Inactivo'}
                        </span>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="editProfessional(${prof.id})" 
                            class="flex-1 bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 text-sm">
                            <i class="fas fa-edit mr-1"></i>Editar
                        </button>
                        <button onclick="deleteProfessional(${prof.id})" 
                            class="flex-1 bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 text-sm">
                            <i class="fas fa-trash mr-1"></i>Eliminar
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function openProfessionalModal(id = null) {
            document.getElementById('professionalModalTitle').textContent = id ? 'Editar Profesional' : 'Nuevo Profesional';
            document.getElementById('professionalId').value = id || '';
            
            if (id) {
                const prof = allProfessionals.find(p => p.id == id);
                if (prof) {
                    document.getElementById('professionalFirstName').value = prof.first_name;
                    document.getElementById('professionalLastName').value = prof.last_name;
                    document.getElementById('professionalSpecialty').value = prof.specialty;
                    document.getElementById('professionalLicense').value = prof.license_number;
                    document.getElementById('professionalPhone').value = prof.phone;
                    document.getElementById('professionalEmail').value = prof.email;
                    document.getElementById('professionalStatus').value = prof.status;
                }
            } else {
                document.getElementById('professionalForm').reset();
            }
            
            document.getElementById('professionalModal').classList.add('active');
        }

        function closeProfessionalModal() {
            document.getElementById('professionalModal').classList.remove('active');
            document.getElementById('professionalForm').reset();
        }

        document.getElementById('professionalForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('professionalId').value;
            const data = {
                first_name: document.getElementById('professionalFirstName').value,
                last_name: document.getElementById('professionalLastName').value,
                specialty: document.getElementById('professionalSpecialty').value,
                license_number: document.getElementById('professionalLicense').value,
                phone: document.getElementById('professionalPhone').value,
                email: document.getElementById('professionalEmail').value,
                status: document.getElementById('professionalStatus').value
            };
            
            try {
                const endpoint = id ? `/professionals/${id}` : `/professionals`;
                const method = id ? 'PUT' : 'POST';
                
                const response = await apiRequest(endpoint, method, data);
                
                if (response.success) {
                    alert(id ? 'Profesional actualizado correctamente' : 'Profesional creado correctamente');
                    closeProfessionalModal();
                    loadProfessionals();
                } else {
                    alert('Error: ' + (response.message || 'No se pudo guardar el profesional'));
                }
            } catch (error) {
                console.error('Error guardando profesional:', error);
                alert('Error al guardar el profesional');
            }
        });

        function editProfessional(id) {
            openProfessionalModal(id);
        }

        async function deleteProfessional(id) {
            if (!confirm('¿Está seguro de eliminar este profesional?')) return;
            
            try {
                const response = await apiRequest(`/professionals/${id}`, 'DELETE');
                
                if (response.success) {
                    alert('Profesional eliminado correctamente');
                    loadProfessionals();
                } else {
                    alert('Error al eliminar el profesional');
                }
            } catch (error) {
                console.error('Error eliminando profesional:', error);
                alert('Error al eliminar el profesional');
            }
        }

        // ========================================
        // TRATAMIENTOS - CRUD COMPLETO
        // ========================================
        async function loadTreatments() {
            try {
                const response = await apiRequest('/treatments');
                
                // Validar que la respuesta tenga el formato correcto
                if (response && response.data && Array.isArray(response.data)) {
                    allTreatments = response.data;
                } else if (Array.isArray(response)) {
                    allTreatments = response;
                } else {
                    console.error('Formato de respuesta incorrecto:', response);
                    allTreatments = [];
                }
                
                renderTreatmentsGrid(allTreatments);
            } catch (error) {
                console.error('Error cargando tratamientos:', error);
                alert('Error al cargar tratamientos. Verifica la consola.');
            }
        }

        function renderTreatmentsGrid(treatments) {
            const grid = document.getElementById('treatmentsGrid');
            
            if (!treatments || treatments.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 text-center col-span-3 py-8">No hay tratamientos registrados</p>';
                return;
            }
            
            grid.innerHTML = treatments.map(treatment => `
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">${treatment.name}</h3>
                            <p class="text-sm text-gray-600 mt-1">${treatment.description}</p>
                        </div>
                        <i class="fas fa-tooth text-3xl text-orange-500"></i>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-2"></i>${treatment.duration} minutos
                        </p>
                        <p class="text-lg font-bold text-orange-600">
                            <i class="fas fa-dollar-sign mr-2"></i>${Number(treatment.price).toLocaleString('es-CL')}
                        </p>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="editTreatment(${treatment.id})" 
                            class="flex-1 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 text-sm">
                            <i class="fas fa-edit mr-1"></i>Editar
                        </button>
                        <button onclick="deleteTreatment(${treatment.id})" 
                            class="flex-1 bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 text-sm">
                            <i class="fas fa-trash mr-1"></i>Eliminar
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function openTreatmentModal(id = null) {
            document.getElementById('treatmentModalTitle').textContent = id ? 'Editar Tratamiento' : 'Nuevo Tratamiento';
            document.getElementById('treatmentId').value = id || '';
            
            if (id) {
                const treatment = allTreatments.find(t => t.id == id);
                if (treatment) {
                    document.getElementById('treatmentName').value = treatment.name;
                    document.getElementById('treatmentDescription').value = treatment.description;
                    document.getElementById('treatmentDuration').value = treatment.duration;
                    document.getElementById('treatmentPrice').value = treatment.price;
                }
            } else {
                document.getElementById('treatmentForm').reset();
            }
            
            document.getElementById('treatmentModal').classList.add('active');
        }

        function closeTreatmentModal() {
            document.getElementById('treatmentModal').classList.remove('active');
            document.getElementById('treatmentForm').reset();
        }

        document.getElementById('treatmentForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('treatmentId').value;
            const data = {
                name: document.getElementById('treatmentName').value,
                description: document.getElementById('treatmentDescription').value,
                duration: document.getElementById('treatmentDuration').value,
                price: document.getElementById('treatmentPrice').value
            };
            
            try {
                const endpoint = id ? `/treatments/${id}` : `/treatments`;
                const method = id ? 'PUT' : 'POST';
                
                const response = await apiRequest(endpoint, method, data);
                
                if (response.success) {
                    alert(id ? 'Tratamiento actualizado correctamente' : 'Tratamiento creado correctamente');
                    closeTreatmentModal();
                    loadTreatments();
                } else {
                    alert('Error: ' + (response.message || 'No se pudo guardar el tratamiento'));
                }
            } catch (error) {
                console.error('Error guardando tratamiento:', error);
                alert('Error al guardar el tratamiento');
            }
        });

        function editTreatment(id) {
            openTreatmentModal(id);
        }

        async function deleteTreatment(id) {
            if (!confirm('¿Está seguro de eliminar este tratamiento?')) return;
            
            try {
                const response = await apiRequest(`/treatments/${id}`, 'DELETE');
                
                if (response.success) {
                    alert('Tratamiento eliminado correctamente');
                    loadTreatments();
                } else {
                    alert('Error al eliminar el tratamiento');
                }
            } catch (error) {
                console.error('Error eliminando tratamiento:', error);
                alert('Error al eliminar el tratamiento');
            }
        }
    </script>

</body>
</html>