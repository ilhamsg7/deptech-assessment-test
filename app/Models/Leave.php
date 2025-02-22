<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($leave) {
            $year = Carbon::parse($leave->start_date)->year;

            $startDate = Carbon::parse($leave->start_date);
            $endDate   = Carbon::parse($leave->end_date);
            $newDays   = $startDate->diffInDays($endDate) + 1;

            $usedDays = self::where('employee_id', $leave->employee_id)
                ->whereYear('start_date', $year)
                ->sum(DB::raw("DATEDIFF(end_date, start_date) + 1"));

            $totalDays = $usedDays + $newDays;
            if ($totalDays > 5) {
                $excess = $totalDays - 5;
                throw new \Exception("Employees can only take a maximum of 5 leave days per year. You've exceeded the limit by {$excess} day(s).");
            }
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
