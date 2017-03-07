<?php

namespace Infrastructure\Domain\Services;

use Infrastructure\Domain\Models\Navigation;

trait PaginationService
{
    /**
     * @param $limit
     * @param $page
     * @param $count
     * @return Navigation
     */
    protected function getNavigation($limit, $page, $count)
    {
        $num_pages = $this->getNumPages($count, $limit);

        return new Navigation(
            $count,
            $page,
            $num_pages,
            range(1, $num_pages),
            ($page <= 1) ? false : $page - 1,
            ($page >= $num_pages) ? false : $page + 1
        );
    }

    /**
     * @param $count
     * @param $limit
     * @return int
     */
    private function getNumPages($count, $limit)
    {
        if (!$count || !$limit) {
            return 0;
        }

        return (int)ceil($count / $limit);
    }

    /**
     * @param $limit
     * @param $page
     * @param $count
     * @return bool
     */
    protected function getNextPage($limit, $page, $count)
    {
        if ($count == 0) {
            return false;
        }

        if (ceil($count / $limit) <= $page) {
            return false;
        }

        return $page + 1;
    }

}
