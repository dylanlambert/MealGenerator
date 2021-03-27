<?php

declare(strict_types=1);

namespace App\Application\User;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="UserDto"),
 * @OA\Property(property="userId", type="string", format="uuid", readOnly="true"),
 * @OA\Property(property="userEmail", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="userName", type="string", maxLength=32, example="Doe"),
 * @OA\Property(property="userFirstName", type="string", maxLength=32, example="John"),
 * )
 *
 * Class UserDto
 *
 */
final class UserDto
{
    public string $userId;
    public string $userEmail;
    public string $userName;
    public string $userFirstName;

    public function __construct(string $userId, string $userEmail, string $userName, string $userFirstName)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->userFirstName = $userFirstName;
    }
}
