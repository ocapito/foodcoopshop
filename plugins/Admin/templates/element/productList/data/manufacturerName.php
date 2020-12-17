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


if ($manufacturerId == 'all') {
    echo '<td>';
    if (! empty($product->product_attributes) || isset($product->product_attributes)) {
        echo $this->Html->link(
            $product->manufacturer->name,
            $this->Slug->getProductAdmin($product->id_manufacturer),
            [
                'escape' => false,
            ]
        );
    }
    echo '</td>';
}

?>