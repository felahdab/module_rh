<?php

namespace Modules\RH\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use Modules\RH\DataObjects\NewMarinDescriptionData;

use Illuminate\Support\Arr;

class UnMarinDoitEtreCreeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public NewMarinDescriptionData $description;
    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        $this->description = NewMarinDescriptionData::from($data);
        $this->description->display_name = $this->description->nom . ' ' . $this->description->prenom ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
