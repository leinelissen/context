<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * The names of the channels that will be created in this seeder
     *
     * @var array
     */
    public $names;

    /**
     * The names of some of the possible extensions of the channel names
     *
     * @var array
     */
    public $extensions;

    /**
     * Announcements that will be selected randomly on channel creation
     *
     * @var array
     */
    public $announcements;

    /**
     * Initialise class variables
     *
     * @return void
     */
    public function __construct()
    {
        $this->names = [
            "Frans 🇫🇷",
            "Duits 🇩🇪",
            "Engels 🇬🇧",
            "Nederlands 🇳🇱",
            "Maatschappijleer",
            "Wiskunde",
            "Scheikunde",
            "Natuurkunde",
            "Economie",
            "Geschiedenis"
        ];

        $this->extensions = collect([
            "VW4A",
            "VW4B",
            "VW4C",
            "VW4D",
            "VW4E"
        ]);

        $this->announcements = collect([
            "Het huiswerk is opdracht 1 t/m 12 van hoofdstuk vier.",
            "Voor donderdag: 3.1, 3.2 en 3.4",
            "As dinsdag: opdrachten 1, 2 en 3a",
            "Aankomende maandag so van hoofdstuk 11",
            "Woensdag proefwerk over Hoofdstuk 1, 2, 3, 4 & 5",
            "Jullie eerste schoolexamen staat voor de deur. Oefen alvast met de opdrachten uit de reader.",
            "Fijne vakantie, ik zie jullie op woensdag weer.",
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $name) {
            Channel::create([
                "name" => $name,
                "name_extension" => $this->extensions->random(),
                "group" => true,
                "announcement" => $this->announcements->random(),
            ]);
        }
    }
}
