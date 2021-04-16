<?php

declare(strict_types=1);

namespace App\Application\User;

use JsonSerializable;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="UserDto"),
 * @OA\Property(property="userId", type="string", format="uuid", readOnly="true"),
 * @OA\Property(
 *     property="userEmail",
 *     type="string",
 *     readOnly="true",
 *     format="email",
 *     description="User unique email address",
 *     example="user@gmail.com"
 * ),
 * @OA\Property(property="userName", type="string", maxLength=32, example="Doe"),
 * @OA\Property(property="userFirstName", type="string", maxLength=32, example="John"),
 * )
 *
 * Class UserDto
 *
 */
final class UserDto implements JsonSerializable
{
    private string $userId;
    private string $userEmail;
    private string $userName;
    private string $userFirstName;

    public function __construct(string $userId, string $userEmail, string $userName, string $userFirstName)
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->userFirstName = $userFirstName;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function userEmail(): string
    {
        return $this->userEmail;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function userFirstName(): string
    {
        return $this->userFirstName;
    }

    /**
     * @return array<string,string>
     */
    public function jsonSerialize(): array
    {
        return [
            'userId' => $this->userId,
            'userEmail' => $this->userEmail,
            'userName' => $this->userName,
            'userFirstName' => $this->userFirstName,
        ];
    }
}
