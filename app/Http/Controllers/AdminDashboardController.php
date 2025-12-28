<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\StaffMember;
use App\Models\Appointment;
use App\Models\ClinicalRecord;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Métricas principales
        $stats = [
            'total_users'        => User::count(),
            'total_patients'     => Patient::count(),
            'total_staff'        => StaffMember::count(),
            'total_appointments' => Appointment::count(),
            'today_appointments' => Appointment::whereDate('scheduled_start', today())->count(),
            'total_records'      => ClinicalRecord::count(),
        ];

        // Usuarios por rol (admin, paciente, etc.)
        $usersByRole = DB::table('user_roles')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->select('roles.name', DB::raw('count(user_roles.user_id) as total'))
            ->groupBy('roles.name')
            ->orderBy('roles.name')
            ->get();

        // Pacientes nuevos en los últimos 7 días
        $newPatientsLast7Days = Patient::where('created_at', '>=', now()->subDays(7))->count();

        // Últimos pacientes registrados
        $latestPatients = Patient::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Citas de hoy por estado
        $appointmentsTodayByStatus = Appointment::whereDate('scheduled_start', today())
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Próximas citas (desde ahora hacia adelante)
        $upcomingAppointments = Appointment::where('scheduled_start', '>=', now())
            ->orderBy('scheduled_start', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'usersByRole',
            'newPatientsLast7Days',
            'latestPatients',
            'appointmentsTodayByStatus',
            'upcomingAppointments'
        ));
    }
}
