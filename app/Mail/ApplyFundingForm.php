<?php

namespace App\Mail;

use App\Models\Governorate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyFundingForm extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $governorate;

    /**
     * Create a new message instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->governorate = Governorate::find($request->governorate);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.apply-funding')
            ->subject(__('Installment request'));
    }
}
