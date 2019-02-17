<?php
// src/DataFixtures/ORM/AppFixtures.php
namespace App\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class AppFixtures extends DataFixtureLoader
{
    public function auvergneCityName()
    {
        $names = array(
            'Beaumont',
            'Ceyrat',
            'Clermont-Ferrand',
            'Chamalieres',
            'Romagnat'
        );

        return $names[array_rand($names)];
    }
}