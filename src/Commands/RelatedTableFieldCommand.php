<?php

namespace Momenoor\RelatedTableField\Commands;

use Illuminate\Console\Command;

class RelatedTableFieldCommand extends Command
{
    public $signature = 'relatedtablefield';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
