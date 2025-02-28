<?php

namespace App\Model\Table;

/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 3.3.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
class StorageLocationsTable extends AppTable
{

    public function getForDropdown()
    {
        $storageLocations = $this->find('all', [
            'order' => [
                'StorageLocations.rank' => 'ASC',
            ]
        ]);
        $preparedStorageLocations = [];
        foreach ($storageLocations as $storageLocation) {
            $preparedStorageLocations[$storageLocation->id] = $storageLocation->name;
        }
        return $preparedStorageLocations;
    }

}
