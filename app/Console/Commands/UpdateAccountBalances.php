<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\MonthlyFee;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;


class UpdateAccountBalances extends Command
{
    protected $signature = 'update:account-balances';
    protected $description = 'Update member account balances based on monthly fees.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $members = Member::all();

        foreach ($members as $member) {
            $monthlyFee = MonthlyFee::where('member_id', $member->id)
                ->whereMonth('due_date', Carbon::now()->month)
                ->whereYear('due_date', Carbon::now()->year)
                ->first();

            if ($monthlyFee && !$monthlyFee->paid) {
                $member->account_balance -= $monthlyFee->amount;
                $member->save();
                $monthlyFee->update(['paid' => true]);
            }
        }



        $this->info('Account balances updated successfully.');
    }
}
