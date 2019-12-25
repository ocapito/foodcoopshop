<?php
/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 2.5.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
namespace App\Model\Table;

class CartProductUnitsTable extends AppTable
{

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setPrimaryKey('id_cart_product');
        $this->hasOne('CartProducts', [
            'foreignKey' => 'id_cart_product'
        ]);
    }

}
