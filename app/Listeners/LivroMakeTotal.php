<?php

namespace App\Listeners;

use CodeEduBook\Events\LivroPreIndexEvent;
use CodeEduStore\Repositories\OrderRepository;

class LivroMakeTotal
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository)
    {
        //
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the event.
     *
     * @param  LivroPreIndexEvent  $event
     * @return void
     */
    public function handle(LivroPreIndexEvent $event)
    {
        //
        $livro = $event->getLivro();
        $ranking = $this->orderRepository->scopeQuery(function ($query) use($livro){
            return $query
              ->select(\DB::raw('count(orders.id) as total'))
              ->where('orderable_id',$livro->id);
        })->all()->first()->total;

        $event->setRanking($ranking);
    }
}
