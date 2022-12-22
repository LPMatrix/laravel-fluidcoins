<?php

/*
 * This file is part of the Laravel Fluidcoins package.
 *
 * (c) Sanusi Mubaraq <mubaraqsanusi908@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key From Fluidcoins Dashboard
     *
     */
    'publicKey' => getenv('FLUIDCOINS_PUBLIC_KEY'),

    /**
     * Secret Key From Fluidcoins Dashboard
     *
     */
    'secretKey' => getenv('FLUIDCOINS_SECRET_KEY'),

    /**
     * Fluidcoins URL
     *
     */
    'baseUrl' => getenv('FLUIDCOINS_URL'),
];
