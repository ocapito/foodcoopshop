<?php
/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 2.2.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return function (RouteBuilder $builder) {
    $builder->plugin('Admin',
        function (RouteBuilder $builder) {
            $builder->setExtensions(['pdf', 'xlsx']);
            $builder->connect('/', ['plugin' => 'Admin', 'controller' => 'Pages', 'action' => 'home']);
            $builder->redirect('/orders', '/admin/order-details?groupBy=customer');
            $builder->fallbacks(DashedRoute::class);
        }
    );
};
