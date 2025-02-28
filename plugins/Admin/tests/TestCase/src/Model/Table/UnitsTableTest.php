<?php

use App\Lib\Error\Exception\InvalidParameterException;
use App\Test\TestCase\AppCakeTestCase;

/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 2.1.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
class UnitsTableTest extends AppCakeTestCase
{

    public $Units;

    public $productId = 346;
    public $productAttributeId = 0;
    public $pricePerUnitEnabled = true;
    public $priceInclPerUnit = 12.44;
    public $name = 'kg';
    public $amount = 2;
    public $quantityInUnits = 9.323;


    public function setUp(): void
    {
        parent::setUp();
        $this->Unit = $this->getTableLocator()->get('Units');
    }

    public function testSaveProductWithInvalidPriceString()
    {
        $this->priceInclPerUnit = 'random-string';
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Der Preis nach Gewicht muss eine Zahl sein. Der Preis nach Gewicht muss größer als 0 sein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidPriceZero()
    {
        $this->priceInclPerUnit = 0;
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Der Preis nach Gewicht muss größer als 0 sein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidNameWrongString()
    {
        $this->name = 'p';
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Der Name ist nicht erlaubt.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidNameEmpty()
    {
        $this->name = '';
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Bitte gib einen Namen ein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidAmountString()
    {
        $this->amount = 'random-string';
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Die Anzahl muss eine Zahl sein. Die Anzahl muss größer als 0 sein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidAmountZero()
    {
        $this->amount = 0;
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Die Anzahl muss größer als 0 sein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidQuantityInUnitsString()
    {
        $this->quantityInUnits = 'random-string';
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Das ungefähre Liefergewicht muss eine Zahl sein.');
        $this->doSave();
    }

    public function testSaveProductWithInvalidQuantityInUnitsNegative()
    {
        $this->quantityInUnits = -1;
        $this->expectException(InvalidParameterException::class);
        $this->expectExceptionMessage('Das ungefähre Liefergewicht muss eine positive Zahl sein.');
        $this->doSave();
    }

    public function testSaveProductNoValidationIfDisabled()
    {
        $this->pricePerUnitEnabled = false;
        $result = $this->doSave();
        $this->assertNotEmpty($result);
    }

    public function testSaveProductOK()
    {
        $result = $this->doSave();
        $this->assertNotEmpty($result);
        $unit = $this->Unit->find('all', [
            'conditions' => [
                'id_product' => $this->productId
            ]
        ])->first();
        $this->assertEquals($this->productId, $unit->id_product, 'id_product not saved correctly');
        $this->assertEquals($this->productAttributeId, $unit->id_product_attribute, 'id_product_attribute not saved correctly');
        $this->assertEquals($this->pricePerUnitEnabled, $unit->price_per_unit_enabled, 'price_per_unit_enabled not saved correctly');
        $this->assertEquals($this->priceInclPerUnit, $unit->price_incl_per_unit, 'price_incl_per_unit not saved correctly');
        $this->assertEquals($this->name, $unit->name, 'name not saved correctly');
        $this->assertEquals($this->amount, $unit->amount, 'amount not saved correctly');
        $this->assertEquals($this->quantityInUnits, $unit->quantity_in_units, 'quantity_in_units not saved correctly');
    }

    private function doSave()
    {
        return $this->Unit->saveUnits(
            $this->productId,
            $this->productAttributeId,
            $this->pricePerUnitEnabled,
            $this->priceInclPerUnit,
            $this->name,
            $this->amount,
            $this->quantityInUnits
        );
    }

}
