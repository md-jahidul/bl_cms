<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertUtcTimeTolocalByTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert created_at UTC time to BT Time by Table name and Column name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function checkValidDateFormat($format)
    {
        return (bool)strtotime($format);
    }

    public function handle()
    {
        $table_name  = $this->ask('Please enter table name');
        if (!Schema::hasTable($table_name)) {
            $this->error('There is such table found');
            return;
        }
        $column_name = $this->ask('Please enter column name');

        if (!Schema::hasColumn($table_name, $column_name)) {
            $this->error('No such column for this table');
            return;
        }



        $count = DB::table($table_name)->count();
        $this->output->progressStart($count);

        $updated_count = 0;
        $no_update_count = 0;

        DB::table($table_name)->orderBy($column_name)
            ->chunk(20000, function ($rows) use ($table_name, $column_name, &$no_update_count, &$updated_count) {
                foreach ($rows as $row) {
                    $before = $row->created_at;
                    if (!$this->checkValidDateFormat($before)) {
                        $no_update_count++;
                        $this->output->progressAdvance();
                    } else {
                        $after = Carbon::parse($before, 'UTC')->addHours(6)->toDateTimeString();

                        if ($after < now('Asia/Dhaka')) {
                            DB::table($table_name)->where('id', $row->id)->limit(1)->update([ $column_name => $after ]);
                            $updated_count++;
                        } else {
                            $no_update_count++;
                        }
                        $this->output->progressAdvance();
                    }
                }
                sleep(1);
            });

        $this->output->progressFinish();

        $this->info(' Updated : ' . $updated_count . ' ---- No Update : ' . $no_update_count);
    }
}
