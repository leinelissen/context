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
    public $channelNames;

    /**
     * Initialise class variables
     *
     * @return void
     */
    public function __construct()
    {
        $this->channelNames = [
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
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->channelNames as $name) {
            Channel::create([
                "name" => $name,
                "group" => true
            ]);
        }
    }
}
