<?php
/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 1.4.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */
use App\Test\TestCase\AppCakeTestCase;
use App\Test\TestCase\Traits\AppIntegrationTestTrait;
use App\Test\TestCase\Traits\LoginTrait;
use Cake\Core\Configure;
use Cake\TestSuite\EmailTrait;

class ProductsControllerTest extends AppCakeTestCase
{

    use AppIntegrationTestTrait;
    use EmailTrait;
    use LoginTrait;

    public $Product;

    public function setUp(): void
    {
        parent::setUp();
        $this->Product = $this->getTableLocator()->get('Products');
    }

    public function testChangeProductStatus()
    {
        $this->loginAsSuperadmin();
        $productId = 60;
        $status = APP_OFF;
        $this->get('/admin/products/changeStatus/' . $productId . '/' . $status);
        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $productId
            ]
        ])->first();
        $this->assertEquals($product->active, $status, 'changing product status did not work');
    }

    public function testEditSellingPriceWithInvalidPriceAsSuperadmin()
    {
        $this->loginAsSuperadmin();
        $price = 'invalid-price';
        $this->changeProductPrice(346, $price);
        $response = $this->getJsonDecodedContent();
        $this->assertRegExpWithUnquotedString('input format not correct: ' . $price, $response->msg);
        $this->assertJsonError();
    }

    public function testEditSellingPriceOfNonExistingProductAsSuperadmin()
    {
        $this->loginAsSuperadmin();
        $productId = 1000;
        $this->changeProductPrice($productId, '0,15');
        $this->assertAccessDeniedFlashMessage();
    }

    public function testEditSellingPriceOfMeatManufactuerProductAsVegatableManufacturer()
    {
        $this->loginAsVegetableManufacturer();
        $productId = 102;
        $this->changeProductPrice($productId, '0,15');
        $this->assertAccessDeniedFlashMessage();
    }

    public function testEditSellingPriceOfMeatManufactuerWithPurchasePriceEnabled()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsMeatManufacturer();
        $productId = 102;
        $this->changeProductPrice($productId, '0,15');
        $this->assertAccessDeniedFlashMessage();
    }

    public function testEditSellingPriceOfProductAsSuperadminToZero()
    {
        $this->loginAsSuperadmin();
        $this->assertSellingPriceChange(346, '0', '0,00', '10');
    }

    public function testEditSellingPriceOfProductAsSuperadmin()
    {
        $this->loginAsSuperadmin();
        $this->assertSellingPriceChange(346, '2,20', '2,00', '10');
    }

    public function testEditSellingPricePerUnitOfProductAsSuperadmin()
    {
        $this->loginAsSuperadmin();
        $productId = 346;
        $this->assertSellingPriceChange($productId, 0, 0, 10, true, 15, 'g', 100, 50);
        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $productId
            ],
            'contain' => [
                'UnitProducts'
            ]
        ])->first();
        $this->assertRegExpWithUnquotedString($this->PricePerUnit->getPricePerUnitBaseInfo($product->unit_product->price_incl_per_unit, $product->unit_product->name, $product->unit_product->amount), '`15,00 € / 100 g');
    }

    public function testEditSellingPriceOfAttributeAsSuperadmin()
    {
        $this->loginAsSuperadmin();
        $this->assertSellingPriceChange('60-10', '1,25', '1,106195', '13');
    }

    public function testEditSellingPriceWith0PercentTax()
    {
        $this->loginAsSuperadmin();
        $this->assertSellingPriceChange('163', '1,60', '1,60', '0');
    }

    public function testEditPurchasePriceOfProductAsSuperadminNonExistingProduct()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $this->doPurchasePriceChange(4, '20');
        $this->assertJsonError();
        $this->assertRegExpWithUnquotedString('product not existing: id 4', $this->getJsonDecodedContent()->msg);
    }

    public function testEditPurchasePriceOfProductAsSuperadminInvalid()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $this->doPurchasePriceChange(346, '-1');
        $this->assertJsonError();
        $this->assertRegExpWithUnquotedString('Der Preis muss eine positive Zahl sein.', $this->getJsonDecodedContent()->msg);
    }

    public function testEditPurchasePriceOfProductAsSuperadmin()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->doPurchasePriceChange(346, '2,20');
        $this->assertJsonOk();
        $this->assertEquals(1.833333, $product->purchase_price_product->price);
    }

    public function testEditPurchasePriceOfProductAsMeatManufacturer()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsMeatManufacturer();
        $this->doPurchasePriceChange(342, '2,20');
        $this->assertAccessDeniedFlashMessage();
    }

    public function testEditPurchasePricePerUnitOfProductAsSuperadmin()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->doPurchasePriceChange(347, '1,00');
        $this->assertJsonOk();
        $this->assertEquals(1.00, $product->unit_product->purchase_price_incl_per_unit);
    }

    public function testEditPurchasePriceOfAttributeAsSuperadmin()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->doPurchasePriceChange('60-10', '2,20');
        $this->assertJsonOk();
        $this->assertEquals(2, $product->product_attributes[0]->purchase_price_product_attribute->price);
    }

    public function testEditPurchasePricePerUnitOfAttributeAsSuperadmin()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->doPurchasePriceChange('348-11', '13,30');
        $this->assertJsonOk();
        $this->assertEquals(13.30, $product->product_attributes[0]->unit_product_attribute->purchase_price_incl_per_unit);
    }

    public function testEditTaxSellingPriceAsManufacturerWithPurchasePriceEnabled()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsVegetableManufacturer();
        $this->assertTaxChange(346, 1, 2);
        $this->assertAccessDeniedFlashMessage();
    }

    public function testEditTaxSellingPriceInvalid()
    {
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(346, 5, 2);
        $this->assertEquals($product->price, 1.652893);
    }

    public function testEditTaxSellingPriceValidA()
    {
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(346, 1, 1);
        $this->assertEquals($product->price, 1.515152);
    }

    public function testEditTaxSellingPriceValidZero()
    {
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(346, 0, 0);
        $this->assertEquals($product->price, 1.818182);
    }

    public function testEditTaxSellingPriceWithAttributesValidZero()
    {
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(60, 0, 0);
        $this->assertEquals($product->product_attributes[0]->price, 0.616364);
    }

    public function testEditTaxSellingPriceWithAttributesValidA()
    {
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(60, 2, 2);
        $this->assertEquals($product->product_attributes[0]->price, 0.560331);
    }

    public function testEditTaxPurchasePriceInvalid()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $this->assertTaxChange(344, 0, 0, 5, 'empty');
    }

    public function testEditTaxPurchasePriceValidA()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(346, 0, 0, 3, 3);
        $this->assertEquals($product->purchase_price_product->price, 1.274336);
    }

    public function testEditTaxPurchasePriceWithAttributeValidA()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(350, 0, 0, 3, 3);
        $this->assertEquals($product->product_attributes[0]->purchase_price_product_attribute->price, 1.238938);
    }

    public function testEditTaxPurchasePriceValidZero()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $product = $this->assertTaxChange(346, 0, 0, 0, 0);
        $this->assertEquals($product->purchase_price_product->price, 1.44);
    }

    public function testEditDeliveryRhythmInvalidDeliveryRhythmA()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '3-week');
        $this->assertRegExpWithUnquotedString('Der Lieferrhythmus ist nicht gültig.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmInvalidDeliveryRhythmB()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-week', '31.08.2018');
        $this->assertRegExpWithUnquotedString('Der Lieferrhythmus ist nicht gültig.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmInvalidFirstDeliveryDay()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '1-week', '30.08.2018');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein Freitag sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOk1Week()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '1-week');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalid2WeekWithoutDate()
    {
        $productId = 346;
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm($productId, '2-week');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein Freitag sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkFirstOfMonth()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '1-month', '03.08.2018');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalidFirstOfMonth()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '1-month', '10.08.2018');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein erster Freitag im Monat sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkSecondOfMonth()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '2-month', '08.01.2021');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalidSecondOfMonth()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '2-month', '19.03.2021');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein zweiter Freitag im Monat sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkThirdOfMonth()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '3-month', '15.01.2021');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalidThirdOfMonth()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '3-month', '08.01.2021');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein dritter Freitag im Monat sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkFourthOfMonth()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '4-month', '22.01.2021');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalidFourthOfMonth()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '4-month', '15.01.2021');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein vierter Freitag im Monat sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkLastOfMonth()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '0-month', '31.08.2018');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmInvalidLastOfMonth()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-month', '10.08.2018');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag muss ein letzter Freitag im Monat sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmInvalidIndividualWithoutDeliveryDay()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-individual');
        $this->assertRegExpWithUnquotedString('Der erste Liefertag ist nicht gültig.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmInvalidIndividualWithEmptyOrderPossibleUntil()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-individual', '2018-08-31', '');
        $this->assertRegExpWithUnquotedString('Das Bestellbar-bis-Datum ist nicht gültig.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmInvalidIndividualWithWrongOrderPossibleUntil()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-individual', '2018-08-31', '2018-09-30');
        $this->assertRegExpWithUnquotedString('Das Bestellbar-bis-Datum muss kleiner als der Liefertag sein.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkIndividual()
    {
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm(346, '0-individual', '2018-08-31', '2018-08-28');
        $this->assertJsonOk();
    }

    public function testEditDeliveryRhythmIndividualInvalidSendOrderListDay()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '0-individual', '2018-08-31', '2018-08-28', 2, '2019-01-01');
        $this->assertRegExpWithUnquotedString('Das Datum für den Bestellisten-Versand muss zwischen Bestellbar-bis-Datum und dem Liefertag liegen.', $response->msg);
        $this->assertJsonError();
    }

    public function testEditDeliveryRhythmOkWithDatabaseAsserts()
    {
        $productId = 346;
        $this->loginAsSuperadmin();
        $this->changeProductDeliveryRhythm($productId, '1-month', '03.08.2018');
        $this->assertJsonOk();
        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $productId
            ]
        ])->first();
        $this->assertEquals($product->delivery_rhythm_type, 'month');
        $this->assertEquals($product->delivery_rhythm_count, 1);
        $this->assertEquals($product->delivery_rhythm_first_delivery_day->i18nFormat(Configure::read('app.timeHelper')->getI18Format('DateLong2')), '03.08.2018');
    }

    public function testEditDeliveryRhythmWeeklyInvalidSendOrderListsWeekday()
    {
        $this->loginAsSuperadmin();
        $response = $this->changeProductDeliveryRhythm(346, '1-week', '', '', 15);
        $this->assertRegExpWithUnquotedString('Bitte gib eine Zahl zwischen 0 und 6 an.', $response->msg);
        $this->assertJsonError();
    }

    public function testDeleteProductOk()
    {
        $this->loginAsSuperadmin();
        $productId = 102;
        $product = $this->deleteProduct($productId);
        $this->assertJsonOk();
        $this->assertEquals($product->active, APP_DEL);
    }

    public function testDeleteProductWithOpenOrder()
    {
        $this->loginAsSuperadmin();
        $productId = 346;
        $product = $this->deleteProduct($productId);
        $this->assertEquals($product->active, APP_ON);
    }

    public function testDeleteProductAccessLoggedOut()
    {
        $this->deleteProduct(364);
        $this->assertResponseCode(403);
    }

    public function testDeleteProductAccessLoggedInAsWrongManufacturer()
    {
        $productId = 346;
        $this->loginAsMeatManufacturer();
        $product = $this->deleteProduct($productId);
        // active must not be changed!
        $this->assertEquals($product->active, APP_ON);
    }

    public function testProductAdminPricesAsManufacturerWithPurchasePriceEnabled()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsMeatManufacturer();
        $this->get($this->Slug->getProductAdmin());
        $this->assertResponseNotContains('product-price-edit-button');
        $this->assertResponseNotContains('product-deposit-edit-button');
        $this->assertResponseNotContains('product-purchase-price-edit-button');
        $this->assertResponseNotContains('purchase-price-tax-for-dialog');
        $this->assertResponseNotContains('tax-for-dialog');
    }

    public function testProductAdminPricesAsManufacturerWithPurchasePriceDisabled()
    {
        $this->loginAsMeatManufacturer();
        $this->get($this->Slug->getProductAdmin());
        $this->assertResponseContains('product-price-edit-button');
        $this->assertResponseContains('product-deposit-edit-button');
        $this->assertResponseNotContains('product-purchase-price-edit-button');
        $this->assertResponseNotContains('purchase-price-tax-for-dialog');
        $this->assertResponseContains('tax-for-dialog');
    }

    public function testProductAdminPricesAsSuperadminWithPurchasePriceEnabled()
    {
        $this->changeConfiguration('FCS_PURCHASE_PRICE_ENABLED', 1);
        $this->loginAsSuperadmin();
        $this->get($this->Slug->getProductAdmin(5));
        $this->assertResponseContains('product-deposit-edit-button');
        $this->assertResponseContains('product-price-edit-button');
        $this->assertResponseContains('product-purchase-price-edit-button');
        $this->assertResponseContains('purchase-price-tax-for-dialog');
        $this->assertResponseContains('tax-for-dialog');
    }


    private function deleteProduct($productId)
    {
        $this->ajaxPost('/admin/products/delete', [
            'productIds' => [$productId]
        ]);
        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $productId
            ]
        ])->first();
        return $product;
    }

    private function doPurchasePriceChange($productId, $price)
    {

        $ids = $this->Product->getProductIdAndAttributeId($productId);

        $this->ajaxPost('/admin/products/editPurchasePrice', [
            'productId' => $productId,
            'purchasePrice' => $price,
        ]);

        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $ids['productId'],
            ],
            'contain' => [
                'ProductAttributes.PurchasePriceProductAttributes',
                'ProductAttributes.UnitProductAttributes',
                'PurchasePriceProducts',
                'UnitProducts',
            ],
        ])->first();

        return $product;

    }

    private function assertSellingPriceChange($productId, $price, $expectedNetPrice, $taxRate, $pricePerUnitEnabled = false, $priceInclPerUnit = 0, $priceUnitName = '', $priceUnitAmount = 0, $priceQuantityInUnits = 0)
    {
        $price = Configure::read('app.numberHelper')->parseFloatRespectingLocale($price);
        $expectedNetPrice = Configure::read('app.numberHelper')->parseFloatRespectingLocale($expectedNetPrice);
        $this->changeProductPrice($productId, $price, $pricePerUnitEnabled, $priceInclPerUnit, $priceUnitName, $priceUnitAmount, $priceQuantityInUnits);
        $this->assertJsonOk();
        $netPrice = $this->Product->getNetPrice($price, $taxRate);
        $this->assertEquals(floatval($expectedNetPrice), $netPrice);
    }

    private function assertTaxChange($productId, $newSellingPriceTaxId, $expectedSellingPriceTaxId, $newPurchasePriceTaxId = null, $expectedPurchasePriceTaxId = null)
    {
        $data = [
            'productId' => $productId,
            'taxId' => $newSellingPriceTaxId,
        ];
        if ($newPurchasePriceTaxId !== null) {
            $data['purchasePriceTaxId'] = $newPurchasePriceTaxId;
        }

        $this->ajaxPost('/admin/products/editTax', $data);

        $product = $this->Product->find('all', [
            'conditions' => [
                'Products.id_product' => $productId,
            ],
            'contain' => [
                'Taxes',
                'ProductAttributes.PurchasePriceProductAttributes',
                'Manufacturers',
                'PurchasePriceProducts',
            ],
        ])->first();
        $this->assertEquals($product->id_tax, $expectedSellingPriceTaxId);

        if ($expectedPurchasePriceTaxId === 'empty') {
            $this->assertEmpty($product->purchase_price_product);
        } else {
            if ($expectedPurchasePriceTaxId !== null) {
                $this->assertEquals($product->purchase_price_product->tax_id, $expectedPurchasePriceTaxId);
            }
        }

        return $product;

    }

}
