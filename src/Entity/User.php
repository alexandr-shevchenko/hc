<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Ramsey\Uuid\UuidInterface;

class User
{
    /**
     * @var UuidInterface
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @todo: should to use DateTimeImmutable
     * @var DateTime
     */
    public $dateOfBirth;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $avatar;
}