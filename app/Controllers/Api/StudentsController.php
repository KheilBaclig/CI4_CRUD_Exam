<?php

namespace App\Controllers\Api;

class StudentsController extends BaseApiController
{
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can list students.');
        }

        $students = db_connect()
            ->table('users u')
            ->select('u.id, u.fullname, u.username, u.student_id, u.course,
                      u.year_level, u.section, u.phone, u.address, u.profile_image, u.created_at')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('r.name', 'student')
            ->orderBy('u.fullname', 'ASC')
            ->get()->getResultArray();

        return $this->ok($students);
    }

    public function show(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can view student profiles.');
        }

        $row = db_connect()
            ->table('users u')
            ->select('u.id, u.fullname, u.username, u.student_id, u.course,
                      u.year_level, u.section, u.phone, u.address, u.profile_image,
                      u.created_at, r.name AS role_name')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('u.id', $id)
            ->get()->getRowArray();

        if (! $row || $row['role_name'] !== 'student') {
            return $this->notFound("Student #{$id} not found.");
        }

        return $this->ok($row);
    }

    private function hasTeacherAccess(): bool
    {
        return $this->apiUser && in_array($this->apiUser['role_name'], ['teacher', 'admin'], true);
    }
}
