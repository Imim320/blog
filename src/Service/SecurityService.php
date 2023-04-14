<?php

namespace Blog\Service;

class SecurityService
{
    private const ADMINS_IN_MEMORY = [
        'admin_YWRtaW4x' // login admin password admin1
    ];

    public function authorizeAdmin(string $login, string $password): bool
    {
        $accountKey = sprintf('%s_%s', $login, base64_encode($password));
        if (in_array($accountKey, self::ADMINS_IN_MEMORY)) {
            $_SESSION['isAdminAuthorized'] = 1;
            return true;
        }

        return false;
    }

    public function isAuthorized(): bool
    {
        session_start();
        return $_SESSION['isAdminAuthorized'] ?? false;
    }
}
