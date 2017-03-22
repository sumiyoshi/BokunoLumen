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
    public $currentPage;

    /**
     * @var int
     */
    public $numPages;

    /**
     * @var array
     */
    public $pageRange;

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
        $currentPage,
        $numPages,
        $pageRange,
        $prev,
        $next
    )
    {
        $this->count = $count;
        $this->currentPage = $currentPage;
        $this->numPages = $numPages;
        $this->pageRange = $pageRange;
        $this->prev = $prev;
        $this->next = $next;
    }

}
