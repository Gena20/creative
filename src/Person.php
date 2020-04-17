<?php

declare(strict_types=1);

namespace App;

/**
 * Immutable Person representation.
 */
final class Person
{
    private string $firstName;
    private string $lastName;
    private ?\DateTime $dayOfBirth;

    /**
     * Make a Person.
     *
     * @param string $firstName
     * @param string $lastName
     * @param \DateTime|null $dayOfBirth
     */
    public function __construct(string $firstName, string $lastName, ?\DateTime $dayOfBirth = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dayOfBirth = $dayOfBirth;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return \DateTime|null
     */
    public function getDayOfBirth(): ?\DateTime
    {
        return $this->dayOfBirth;
    }
}