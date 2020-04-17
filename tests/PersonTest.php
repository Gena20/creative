<?php
use PHPUnit\Framework\TestCase;
use App\Person;

class PersonTest extends TestCase
{
    public function testGetFirstAndLastName()
    {
        $name = "name";
        $surname = "surname";
        $person = new Person($name, $surname);
        $this->assertEquals($person->getFirstName(), $name);
        $this->assertEquals($person->getLastName(), $surname);
        $this->assertNull($person->getDayOfBirth());
    }

    public function testGetDayOfBirth()
    {
        $date = "20.02.2020";
        $person = new Person("name", "surname", new \DateTime($date));     
        $this->assertEquals($person->getDayOfBirth(), new \DateTime($date));
    }
}