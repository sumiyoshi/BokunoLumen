<?php

if (!function_exists('asset')) {

    function asset($path)
    {
        $public_path = base_path() . '/public';

        if (file_exists($public_path . $path)) {
            return $path . '?' . filemtime($public_path . $path);
        }

        return $path;
    }
}

if (!function_exists('generate_id')) {

    /**
     * @return string
     */
    function generate_id()
    {
        return sha1(uniqid(rand()));
    }
}

if (!function_exists('resources')) {

    /**
     * @param \Laravel\Lumen\Application $app
     * @param $prefix
     * @param array $except
     */
    function resources(\Laravel\Lumen\Application $app, $prefix, array $except = [])
    {
        $app->group(["prefix" => "{$prefix}"], function () use ($app, $prefix, $except) {
            $controller = ucfirst($prefix) . 'Controller';

            // index
            if (array_search('index', $except) === false) {
                $app->get("", ["as" => "{$prefix}", "uses" => "{$controller}@indexAction"]);
            }

            // show
            if (array_search('show', $except) === false) {
                $app->get("{id:[0-9]+}", ["as" => "{$prefix}_show", "uses" => "{$controller}@showAction"]);
            }

            // new
            if (array_search('new', $except) === false) {
                $app->get("new", ["as" => "{$prefix}_new", "uses" => "{$controller}@newAction"]);
            }

            // create
            if (array_search('create', $except) === false) {
                $app->post("/create", ["as" => "{$prefix}_create", "uses" => "{$controller}@createAction"]);
            }

            // edit
            if (array_search('edit', $except) === false) {
                $app->get("{id:[0-9]+}/edit", ["as" => "{$prefix}_edit", "uses" => "{$controller}@editAction"]);
            }

            // update
            if (array_search('update', $except) === false) {
                $app->post("{id:[0-9]+}/update", ["as" => "{$prefix}_update", "uses" => "{$controller}@updateAction"]);
            }

            // delete
            if (array_search('delete', $except) === false) {
                $app->post("{id:[0-9]+}/delete", ["as" => "{$prefix}_delete", "uses" => "{$controller}@deleteAction"]);
            }
        });
    }
}
