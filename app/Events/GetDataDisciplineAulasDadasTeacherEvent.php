<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetDataDisciplineAulasDadasTeacherEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $discipline;

    public $a_p_p_b;

    public $a_d_p_b;

    public $a_p_s_b;

    public $a_d_s_b;

    public $a_p_t_b;

    public $a_d_t_b;

    public $a_p_q_b;

    public $a_d_q_b;

    public $t_a_d_ano;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        $discipline,
        $a_p_p_b,
        $a_d_p_b,
        $a_p_s_b,
        $a_d_s_b,
        $a_p_t_b,
        $a_d_t_b,
        $a_p_q_b,
        $a_d_q_b,
        $t_a_d_ano,
    ) {
        $this->discipline = $discipline;
        $this->a_p_p_b = $a_p_p_b;
        $this->a_d_p_b = $a_d_p_b;
        $this->a_p_s_b = $a_p_s_b;
        $this->a_d_s_b = $a_d_s_b;
        $this->a_p_t_b = $a_p_t_b;
        $this->a_d_t_b = $a_d_t_b;
        $this->a_p_q_b = $a_p_q_b;
        $this->a_d_q_b = $a_d_q_b;
        $this->t_a_d_ano = $t_a_d_ano;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}