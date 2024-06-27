<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use App\Models\Booking;

class ValidBookingTime implements Rule
{
    protected $errorMessage;
    protected $messages = [
        'time_ahead' => 'The range must be 1 hour more than the current time.',
        'adjacent_booking' => 'The booking time collides with another booking schedule.',
    ];

    protected $date;

    public function __construct($date) {
        $this->date = Carbon::parse($date, 'Asia/Jakarta');
    }

    public function passes($attribute, $value) {
        // Parse the input value to get the time and combine it with the stored date
        $inputTime = Carbon::parse($value, 'Asia/Jakarta')->toTimeString();
        $dateString = $this->date->toDateString() . ' ' . $inputTime;
        $bookingDateTime = Carbon::parse($dateString, 'Asia/Jakarta');
        $currentDateTime = Carbon::now('Asia/Jakarta');


        // Check if the booking time is at least 1 hour ahead of the current time
        if ($bookingDateTime->lt($currentDateTime->addHour())) {
            $this->errorMessage = $this->messages['time_ahead'];
            return false;
        }

        // Check if there is a booking that collides with the desired booking time or is adjacent to it
        $collideBooking = Booking::whereDate('booking_time', '=', $this->date->toDateString())
            ->where(function ($query) use ($bookingDateTime) {
                $query->whereBetween('booking_time', [
                    $bookingDateTime->copy()->subMinutes(59),
                    $bookingDateTime->copy()->addMinutes(59)
                ]);
            })
            ->where('status', '=', 'Reserved')
            ->exists();

        
        if ($collideBooking) {
            $this->errorMessage = $this->messages['adjacent_booking'];
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
