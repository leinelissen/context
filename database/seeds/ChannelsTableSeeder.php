<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * The names of the channels that will be created in this seeder.
     *
     * @var array
     */
    public $names;

    /**
     * The names of some of the possible extensions of the channel names.
     *
     * @var array
     */
    public $extensions;

    /**
     * Announcements that will be selected randomly on channel creation.
     *
     * @var array
     */
    public $announcements;

    /**
     * Initialise class variables.
     *
     * @return void
     */
    public function __construct()
    {
        $this->names = [
            'French 🇫🇷',
            'German 🇩🇪',
            'English 🇬🇧',
            'Dutch 🇳🇱',
            'Social Science',
            'Mathematics',
            'Chemistry',
            'Physics',
            'Economy',
            'History',
        ];

        $this->extensions = collect([
            'VW4A',
            'VW4B',
            'VW4C',
            'VW4D',
            'VW4E',
        ]);

        $this->announcements = collect([
            'Your homework is assignments 1 to 12 from chapter three.',
            'For Thursday: 3.1, 3.2 en 3.4',
            'Next tuesday: assignments 1, 2 en 3a',
            'Next monday you will have a test on chapter 11',
            'Wednesday: test of chapters 1 to 5',
            'Your first school exam is right around the corner. Try practicing with the assignments from the reader.',
            'Have a nice holiday! I will see you in two weeks.',
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
                'name'           => $name,
                'name_extension' => $this->extensions->random(),
                'group'          => true,
                'announcement'   => $this->announcements->random(),
            ]);
        }
    }
}
