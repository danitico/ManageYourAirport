<?php

namespace App\DataFixtures;

use App\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SettingsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $settigs=new Settings();

        $settigs->setWebhookURL("https://hooks.slack.com/services/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");
        $settigs->setSlackChannel("#general");
        $settigs->setFlightsWindowsTime(3600);

        $manager->persist($settigs);
        $manager->flush();
    }
}
