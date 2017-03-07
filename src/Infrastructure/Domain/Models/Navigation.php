<?php

namespace Infrastructure\Domain\Models;

class Navigation
{

    /**
     * @var int
     */
    public $count;

    /**
     * @var int
     */
    public $current_page;

    /**
     * @var int
     */
    public $num_pages;

    /**
     * @var array
     */
    public $page_range;

    /**
     * @var int|bool
     */
    public $prev;

    /**
     * @var int|bool
     */
    public $next;

    public function __construct(
        $count,
        $current_page,
        $num_pages,
        $page_range,
        $prev,
        $next
    )
    {
        $this->count = $count;
        $this->current_page = $current_page;
        $this->num_pages = $num_pages;
        $this->page_range = $page_range;
        $this->prev = $prev;
        $this->next = $next;
    }

}
