<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\PushUpNotification;
use Carbon\Carbon;
use App\Events\AppointmentReminderSent;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Trimite notificări cu o zi înainte de programare';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $appointments = Appointment::whereDate('appointment_date', $tomorrow)
            ->where('status', 'approved')
            ->get();

        foreach ($appointments as $appointment) {
            $user = User::find($appointment->user_id);

            $user->notify(new PushUpNotification(
                "Ai o programare mâine ({$appointment->appointment_date})!",
                url('/appointments')
            ));

            event(new AppointmentReminderSent(
                $user->id,
                "Ai o programare mâine ({$appointment->appointment_date})!",
                url('/appointments')
            ));

            $this->info('Notificări de reminder trimise.');
        }
    }
}

