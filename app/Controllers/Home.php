<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $role = session('user')['role'] ?? 'guest';
        $db   = \Config\Database::connect();
        
        // Basic metrics for dashboards
        $totalUsers = $db->table('users')->countAllResults();
        $studentCount = $db->table('users u')
            ->join('roles r', 'r.id = u.role_id')
            ->where('r.name', 'student')
            ->countAllResults();

        $data = array_merge($this->data, [
            'title'        => 'Dashboard',
            'totalUsers'   => $totalUsers,
            'studentCount' => $studentCount,
        ]);

        if ($role === 'teacher') {
            // Teacher-specific: get some 'recent' students
            $data['recentStudents'] = $db->table('users u')
                ->select('u.fullname, u.created_at, u.profile_image')
                ->join('roles r', 'r.id = u.role_id')
                ->where('r.name', 'student')
                ->orderBy('u.created_at', 'DESC')
                ->limit(5)
                ->get()->getResultArray();

            return view('teacher/dashboard', $data);
        }

        return view('pages/commons/dashboard', $data);
    }

    public function dashboardV2(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v2 Page'
        ]);
        return view('pages/commons/dashboard_v2', $data);
    }

    public function dashboardV3(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v3 Page'
        ]);
        return view('pages/commons/dashboard_v3', $data);
    }
}
