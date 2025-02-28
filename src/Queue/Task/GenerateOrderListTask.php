<?php
namespace App\Queue\Task;

use App\Lib\PdfWriter\OrderListByCustomerPdfWriter;
use App\Lib\PdfWriter\OrderListByProductPdfWriter;
use Cake\Core\Configure;
use Queue\Queue\Task;

/**
 * FoodCoopShop - The open source software for your foodcoop
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since         FoodCoopShop 3.2.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @author        Mario Rothauer <office@foodcoopshop.com>
 * @copyright     Copyright (c) Mario Rothauer, https://www.rothauer-it.com
 * @link          https://www.foodcoopshop.com
 */

class GenerateOrderListTask extends Task {

    use UpdateActionLogTrait;

    public $Manufacturer;

    public $QueuedJobs;

    public $timeout = 30;

    public $retries = 2;

    public function run(array $data, $jobId) : void
    {

        $pickupDayDbFormat = $data['pickupDayDbFormat'];
        $pickupDayFormated = $data['pickupDayFormated'];
        $manufacturerId = $data['manufacturerId'];
        $orderDetailIds = $data['orderDetailIds'];
        $actionLogId = $data['actionLogId'];

        $this->Manufacturer = $this->loadModel('Manufacturers');
        $manufacturer = $this->Manufacturer->getManufacturerByIdForSendingOrderListsOrInvoice($manufacturerId);

        $currentDateForOrderLists = Configure::read('app.timeHelper')->getCurrentDateTimeForFilename();

        // START generate PDF grouped by PRODUCT
        $pdfWriter = new OrderListByProductPdfWriter();
        $productPdfFile = Configure::read('app.htmlHelper')->getOrderListLink(
            $manufacturer->name, $manufacturer->id_manufacturer, $pickupDayDbFormat, __('product'), $currentDateForOrderLists
        );
        $pdfWriter->setFilename($productPdfFile);
        $pdfWriter->prepareAndSetData($manufacturer->id_manufacturer, $pickupDayDbFormat, [], $orderDetailIds);
        $pdfWriter->writeFile();
        // END generate PDF grouped by PRODUCT

        // START generate PDF grouped by CUSTOMER
        $pdfWriter = new OrderListByCustomerPdfWriter();
        $customerPdfFile = Configure::read('app.htmlHelper')->getOrderListLink(
            $manufacturer->name, $manufacturer->id_manufacturer, $pickupDayDbFormat, __('member'), $currentDateForOrderLists
        );
        $pdfWriter->setFilename($customerPdfFile);
        $pdfWriter->prepareAndSetData($manufacturer->id_manufacturer, $pickupDayDbFormat, [], $orderDetailIds);
        $pdfWriter->writeFile();
        // END generate PDF grouped by CUSTOMER

        $sendEmail = $this->Manufacturer->getOptionSendOrderList($manufacturer->send_order_list);

        if ($sendEmail) {

            $this->QueuedJobs = $this->loadModel('Queue.QueuedJobs');
            $this->QueuedJobs->createJob('SendOrderList', [
                'productPdfFile' => $productPdfFile,
                'customerPdfFile' => $customerPdfFile,
                'pickupDayFormated' => $pickupDayFormated,
                'orderDetailIds' => $orderDetailIds,
                'manufacturerId' => $manufacturer->id_manufacturer,
                'manufactuerName' => $manufacturer->name,
                'actionLogId' => $actionLogId,
            ]);

        }

        $identifier = 'generate-order-list-' . $manufacturer->id_manufacturer . '-' . $pickupDayFormated;
        $this->updateActionLog($actionLogId, $identifier, $jobId);

    }

}
?>