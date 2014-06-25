<?php
namespace Services;

use Repositories\UserRepository;


class UserService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $rfid
     * @return array
     */
    public function getUserInfoByCardNumber($rfid)
    {
        $user = $this->userRepository->getUserByCardNumber($rfid);
        if ($user === null) {
            $user = $this->userRepository->getUserByCardNumber(UserRepository::USER_UNKNOWN_CARD_NUMBER);
        }

        return [
            "id"        => $user->getUserId(),
            "img"       => $user->getUserId() . '.png',
            "firstName" => $user->getFirstName(),
            "lastName"  => $user->getLastName()
        ];
    }
}
