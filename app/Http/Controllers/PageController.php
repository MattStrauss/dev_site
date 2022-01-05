<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PageController extends Controller
{

    public function home()
    {
        return Inertia::render('Home', ['skills' => $this->getSkills()]);
    }

    public function projects()
    {
        return Inertia::render('Projects', ['projects' => $this->getProjects()]);
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function contactFormSubmit(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'start' => 'required',
            'type' => 'required',
            'remote' => 'required',
            'description' => 'required',
        ]);

        Mail::to(config('mail.to.address'))->send(new ContactFormSubmitted($request));

        return response()->json(null, 200);

    }


    private function getProjects()
    {
        return
            [

                [
                    'name' => 'MenuCrunch',
                    'skills' => ['laravel', 'alpineJS', 'tailwindCss'],
                    'link' => 'https://menucrunch.com',
                    'img' => '/images/menucrunch.png',
                    'demo'  => 'https://screencast-o-matic.com/watch/crf0X6VelBg',
                    'description' => "Allows restaurants to quickly and easily get their menu online. This app also helps restaurants accept and streamline online orders and has powerful analysis tools."
                ],
                [
                    'name' => 'Tic-Tac-Toe',
                    'skills' => ['assembly'],
                    'link' => 'https://github.com/MattStrauss/tictactoe',
                    'img' => '/images/tic_tac_toe.png',
                    'demo'  => 'https://screencast-o-matic.com/watch/crfUlvVea9L',
                    'description' => "An assembly version of Tic-Tac-Toe whereas you compete against the machine. The machine is semi-intelligent, which considering this program was written in assembly, was not easy to pull off."
                ],
                [
                    'name' => 'Polls',
                    'skills' => ['django', 'python', 'tailwindCss'],
                    'link' => 'https://github.com/MattStrauss/polls',
                    'img' => '/images/polls.png',
                    'description' => "This is an enhanced version of the Polls app from the Django tutorial docs. It was built for polls at my undergrad college, so students could vote for their favorite prof, class etc."

                ],
                [
                    'name' => 'SWENG Scheduler',
                    'skills' => ['laravel', 'reactJS', 'd3js', 'tailwindCss'],
                    'link' => 'https://psuswengscheduler.com/',
                    'img' => '/images/sweng.png',
                    'demo'  => 'https://screencast-o-matic.com/watch/crjQbsVjDJT',
                    'description' => "A tool to help students find course information and get course recommendations for the Software Engineering curriculum at the Pennsylvania State University."
                ],
                [
                    'name' => 'Tetris',
                    'skills' => ['java'],
                    'link' => 'https://github.com/MattStrauss/tetris',
                    'img' => '/images/tetris.png',
                    'demo'  => 'https://screencast-o-matic.com/watch/crjDIXVj4DV',
                    'description' => "A java version of the classic game of Tetris. Includes a preview of the upcoming piece and a score keeper."
                ],
                [
                    'name' => 'My Dev Site',
                    'skills' => ['laravel', 'inertiaJS', 'vueJS', 'tailwindCss'],
                    'link' => 'https://mattstrauss.dev',
                    'img' => '/images/devsite.png',
                    'demo'  => null,
                    'description' => "The site you are looking at right now! It was built with the amazing Inertia.js framework, which I highly recommend checking out."
                ],
                [
                    'name' => 'Swift Grocery List',
                    'skills' => ['laravel', 'vueJS', 'bootstrap4'],
                    'link' => 'https://swiftgrocerylist.com',
                    'img' => '/images/sgl.png',
                    'demo'  => null,
                    'description' => "A web application that helps you create a grocery shopping list fast. Built with Laravel and Vue.js. Includes recipes, drag-and-drop aisle sorting and much more."
                ],
                [
                    'name' => 'Dresser',
                    'skills' => ['laravel', 'larevel livewire', 'tailwindCss'],
                    'link' => 'https://github.com/MattStrauss/dresser',
                    'img' => '/images/dresser.png',
                    'demo'  => null,
                    'description' => "A quick and (relatively) dirty mock project to try out Laravel Livewire. The idea was to create a UI that would typically require a decent amount of JS, but to only use Livewire and write zero JS. " .
                        "This is heavily inspired by Caleb Porzio's Guest Spotlight episode on Laracasts where he built an interactive table. It's open source on github, so check it out!"
                ],
            ];
    }


    private function getSkills()
    {
        $backend = ['PHP', 'SQL', 'MySQL', 'Laravel', 'Python', 'Django', 'C', 'C++', 'C#', 'Java', 'Spring Boot', 'Swift', 'Mips/Assembly', 'VHDL', 'Livewire'];
        $frontEnd = ['HTML', 'Javascript', 'CSS', 'Tailwind', 'Bootstrap', 'Alpine.js', 'React.js', 'Vue.js', 'Inertia.js', 'Angular.js', 'Laravel Blade'];
        $testing = ['PHPUnit', 'JUnit', 'Laravel Dusk', 'Codeception', 'Jest', 'Selenium'];
        $misc = ['WordPress', 'Laravel Cashier', 'Laravel Nova', 'Laravel Forge', 'PHP Storm', 'Laravel Spark'];


        function sortAndReturn($array) {
            sort($array);
            return $array;
        }

       return
           [
                'backend' => sortAndReturn($backend),
                'frontend' => sortAndReturn($frontEnd),
                'testing' => sortAndReturn($testing),
                'misc' => sortAndReturn($misc),
           ];
    }

}
