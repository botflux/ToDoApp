<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */

namespace Silex\Application;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Twig trait.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
trait TwigTrait
{
    /**
     * Renders a views and returns a Response.
     *
     * To stream a views, pass an instance of StreamedResponse as a third argument.
     *
     * @param string   $view       The views name
     * @param array    $parameters An array of parameters to pass to the views
     * @param Response $response   A Response instance
     *
     * @return Response A Response instance
     */
    public function render($view, array $parameters = array(), Response $response = null)
    {
        $twig = $this['twig'];

        if ($response instanceof StreamedResponse) {
            $response->setCallback(function () use ($twig, $view, $parameters) {
                $twig->display($view, $parameters);
            });
        } else {
            if (null === $response) {
                $response = new Response();
            }
            $response->setContent($twig->render($view, $parameters));
        }

        return $response;
    }

    /**
     * Renders a views.
     *
     * @param string $view       The views name
     * @param array  $parameters An array of parameters to pass to the views
     *
     * @return string The rendered views
     */
    public function renderView($view, array $parameters = array())
    {
        return $this['twig']->render($view, $parameters);
    }
}
