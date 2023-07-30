<?php

namespace App\Console\Commands;
use function Laravel\Prompts\text;
use function Laravel\Prompts\password;

use App\Models\Note;
use Illuminate\Console\Command;

class TodoCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:notes';

    /**
     * The console Make your Notes.
     *
     * @var string
     */
    protected $description = 'Make your Notes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->mapTable();
    }

    public function mapTable()
    {
        $notes = Note::get(['id', 'message'])->toArray();

        // dd($notes);

        $this->table(
            ['#', 'Note'],
            $notes
        );

        $this->askForNote();
    }


    public function askForNote()
    {
        $message = text(
            label: 'Enter your Note?',
            required: 'This field is required.'
        );

        Note::create(
            ['message' => $message]
        );

        $this->mapTable();
    }
}
