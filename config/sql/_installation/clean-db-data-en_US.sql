
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Truncate tables before insertion
TRUNCATE TABLE `fcs_action_logs`;
TRUNCATE TABLE `fcs_address`;
TRUNCATE TABLE `fcs_attribute`;
TRUNCATE TABLE `fcs_barcodes`;
TRUNCATE TABLE `fcs_blog_posts`;
TRUNCATE TABLE `fcs_cart_product_units`;
TRUNCATE TABLE `fcs_cart_products`;
TRUNCATE TABLE `fcs_carts`;
TRUNCATE TABLE `fcs_category`;
TRUNCATE TABLE `fcs_category_product`;
TRUNCATE TABLE `fcs_configuration`;
TRUNCATE TABLE `fcs_cronjob_logs`;
TRUNCATE TABLE `fcs_cronjobs`;
TRUNCATE TABLE `fcs_customer`;
TRUNCATE TABLE `fcs_deposits`;
TRUNCATE TABLE `fcs_images`;
TRUNCATE TABLE `fcs_invoice_taxes`;
TRUNCATE TABLE `fcs_invoices`;
TRUNCATE TABLE `fcs_manufacturer`;
TRUNCATE TABLE `fcs_order_detail`;
TRUNCATE TABLE `fcs_order_detail_feedbacks`;
TRUNCATE TABLE `fcs_order_detail_purchase_prices`;
TRUNCATE TABLE `fcs_order_detail_units`;
TRUNCATE TABLE `fcs_pages`;
TRUNCATE TABLE `fcs_payments`;
TRUNCATE TABLE `fcs_pickup_days`;
TRUNCATE TABLE `fcs_product`;
TRUNCATE TABLE `fcs_product_attribute`;
TRUNCATE TABLE `fcs_product_attribute_combination`;
TRUNCATE TABLE `fcs_purchase_prices`;
TRUNCATE TABLE `fcs_sliders`;
TRUNCATE TABLE `fcs_stock_available`;
TRUNCATE TABLE `fcs_storage_locations`;
TRUNCATE TABLE `fcs_sync_domains`;
TRUNCATE TABLE `fcs_sync_products`;
TRUNCATE TABLE `fcs_tax`;
TRUNCATE TABLE `fcs_timebased_currency_order_detail`;
TRUNCATE TABLE `fcs_timebased_currency_payments`;
TRUNCATE TABLE `fcs_units`;
TRUNCATE TABLE `phinxlog`;
TRUNCATE TABLE `queue_phinxlog`;
TRUNCATE TABLE `queue_processes`;
TRUNCATE TABLE `queued_jobs`;

/*!40000 ALTER TABLE `fcs_action_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_action_logs` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_address` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_attribute` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_barcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_barcodes` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_blog_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_blog_posts` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_cart_product_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_cart_product_units` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_cart_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_cart_products` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_carts` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_category` DISABLE KEYS */;
INSERT INTO `fcs_category` VALUES
(20,2,'All products','',3,4,1,'2016-10-19 21:05:00','2016-10-19 21:05:00');
/*!40000 ALTER TABLE `fcs_category` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_category_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_category_product` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_configuration` DISABLE KEYS */;
INSERT INTO `fcs_configuration` VALUES
(11,1,'FCS_PRODUCT_AVAILABILITY_LOW','Low availability<br /><div class=\"small\">From which amount on there should be an information text visible \"(x available\")?</div>','10','number',600,'en_US','2017-07-26 13:24:47','2014-06-01 01:40:34'),
(31,1,'FCS_DAYS_SHOW_PRODUCT_AS_NEW','How many days products should be \"marked as new\"?','7','number',700,'en_US','2017-07-26 13:24:47','2014-05-14 21:15:45'),
(456,1,'FCS_FOOTER_CMS_TEXT','Additional text for footer',NULL,'textarea_big',920,'en_US','2014-06-11 17:50:55','2016-07-01 21:47:47'),
(508,1,'FCS_FACEBOOK_URL','Facebook url for embedding in footer','https://www.facebook.com/FoodCoopShop/','text',910,'en_US','2015-07-08 13:23:54','2015-07-08 13:23:54'),
(538,1,'FCS_REGISTRATION_EMAIL_TEXT','Additional text that is sent in the registration e-mail after a successful registration. <br /> <a href=\"/admin/configurations/previewEmail/FCS_REGISTRATION_EMAIL_TEXT\" target=\"_blank\"><i class=\"fas fa-info-circle\"></i> E-mail preview</a>','','textarea_big',1700,'en_US','2016-06-26 00:00:00','2016-06-26 00:00:00'),
(543,1,'FCS_RIGHT_INFO_BOX_HTML','Content of the box in the right column below the shopping cart. <br /><div class=\"small\">To make the background of a row green, please format as \"Heading 3\".</div>','<h3>Delivery time</h3><p>You can order every week until Tuesday midnight and pick the products up the following Friday.</p>','textarea_big',1500,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(544,1,'FCS_NO_DELIVERY_DAYS_GLOBAL','Delivery break for all manufacturers?<br /><div class=\"small\">Here you can define delivery-free days for the whole food-coop.</div>','','multiple_dropdown',100,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(545,1,'FCS_ACCOUNTING_EMAIL','E-mail address for the financial manager<br /><div class=\"small\">Who receives the notification that invoices have been sent?</div>','','text',1100,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(546,1,'FCS_REGISTRATION_INFO_TEXT','Info text in registration form<br /><div class=\"small\">This info text is shown in the registration form below the e-mail address.</div>','You need to be a member if you want to order here.','textarea_big',1600,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(547,1,'FCS_SHOW_PRODUCTS_FOR_GUESTS','Products visible for guests?','0','boolean',200,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(548,1,'FCS_DEFAULT_NEW_MEMBER_ACTIVE','Automatically activate new members?','0','boolean',500,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(549,1,'FCS_MINIMAL_CREDIT_BALANCE','Up to which credit amount orders should be possible?','0','number',1250,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(550,1,'FCS_BANK_ACCOUNT_DATA','Bank account for credit uploads.','Credit account Example Bank / IBAN: AT65 5645 4154 8748 8999 / BIC: ABC87878','text',1300,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(552,1,'FCS_DELIVERY_DETAILS_FOR_MANUFACTURERS','Additional deliverey details for manufacturers<br /><div class=\"small\">will be shown in the order lists after the delivery date.</div>',', 3pm to 5pm','text',1200,'en_US','2017-07-26 13:24:47','2017-07-26 13:24:47'),
(553,1,'FCS_BACKUP_EMAIL_ADDRESS_BCC','E-mail adress to which all automatically generated e-mail are sent to as BCC (Backup).<br /><div class=\"small\">Can be left empty.</div>','','text',1900,'en_US','2016-10-06 00:00:00','2016-10-06 00:00:00'),
(554,1,'FCS_SHOW_FOODCOOPSHOP_BACKLINK','Show link to www.foodcoopshop.com?<br /><div class=\"small\">The link is shown in the footer.</div>','1','boolean',930,'en_US','2016-11-27 00:00:00','2016-11-27 00:00:00'),
(556,1,'FCS_APP_NAME','Name of the food-coop','','text',50,'en_US','2017-01-12 00:00:00','2017-01-12 00:00:00'),
(557,1,'FCS_APP_ADDRESS','Adress of the food-coop<br /><div class=\"small\">Used in footer of homepage and e-mails, privacy policy and terms of use.</div>','','textarea',60,'en_US','2017-01-12 00:00:00','2017-01-12 00:00:00'),
(558,1,'FCS_APP_EMAIL','E-mail adress of the food-coop<br /><div class=\"small\"></div>','','text',900,'en_US','2017-01-12 00:00:00','2017-01-12 00:00:00'),
(559,1,'FCS_PLATFORM_OWNER','Operator of the platform<br /><div class=\"small\">For privacy policy and terms of use, please also add adrress. Can be left empty if the food-coop itself is operator.</div>','','textarea',90,'en_US','2017-01-12 00:00:00','2017-01-12 00:00:00'),
(564,1,'FCS_ORDER_COMMENT_ENABLED','Show comment field when placing an order?<br /><div class=\"small\">Shown in admin area under \"Orders\".</div>','1','boolean',130,'en_US','2017-07-09 00:00:00','2017-07-09 00:00:00'),
(565,1,'FCS_USE_VARIABLE_MEMBER_FEE','Use variable member fee?<br /><div class=\"small\">Reduce the variable member fee in the manufacturer\'s invoices? Therefore the prices need to be increased.</div>','0','readonly',400,'en_US','2017-08-02 00:00:00','2017-08-02 00:00:00'),
(566,1,'FCS_DEFAULT_VARIABLE_MEMBER_FEE_PERCENTAGE','Default value for variable member fee<br /><div class=\"small\">The percentage can be changed in the manufacturer\'s settings.</div>','0','readonly',500,'en_US','2017-08-02 00:00:00','2017-08-02 00:00:00'),
(567,1,'FCS_NETWORK_PLUGIN_ENABLED','Network module activated?<br /><div class=\"small\"><a href=\"https://foodcoopshop.github.io/en/network-module\" target=\"_blank\">Infos to the network module</a></div>','0','readonly',500,'en_US','2017-09-14 00:00:00','2017-09-14 00:00:00'),
(568,1,'FCS_TIMEBASED_CURRENCY_ENABLED','Paying-with-time module activated?<br /><div class=\"small\"><a href=\"https://foodcoopshop.github.io/en/paying-with-time-module\" target=\"_blank\">Infos th the paying-with-time module</a></div>','0','boolean',2000,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(569,1,'FCS_TIMEBASED_CURRENCY_NAME','Paying-with-time: Unit name<br /><div class=\"small\">max. 10 characters</div>','hours','text',2100,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(570,1,'FCS_TIMEBASED_CURRENCY_SHORTCODE','Paying-with-time: Abbreviation<br /><div class=\"small\">max. 3 characters</div>','h','text',2200,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(571,1,'FCS_TIMEBASED_CURRENCY_EXCHANGE_RATE','Paying-with-time: Exchange rate<br /><div class=\"small\">in €, 2 decimals</div>','10.00','number',2300,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(572,1,'FCS_TIMEBASED_CURRENCY_MAX_CREDIT_BALANCE_CUSTOMER','Paying-with-time: Overdraft frame for members<br /><div class=\"small\">How many negative hours are allowed maximal for members?</div>','10','number',2400,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(573,1,'FCS_TIMEBASED_CURRENCY_MAX_CREDIT_BALANCE_MANUFACTURER','Paying-with-time: Overdraft frame for manufacturers<br /><div class=\"small\">How many positive hours are allowed maximal for manufacturers?</div>','100','number',2500,'en_US','2018-03-16 15:23:34','2018-03-16 15:23:34'),
(574,1,'FCS_SHOW_PRODUCT_PRICE_FOR_GUESTS','Shop product price for guests?','0','boolean',210,'en_US','2018-05-28 18:05:54','2018-05-28 18:05:54'),
(575,1,'FCS_CURRENCY_SYMBOL','Currency symbol','$','readonly',520,'en_US','2018-06-13 19:53:14','2018-06-13 19:53:14'),
(576,1,'FCS_DEFAULT_LOCALE','Language','en_US','readonly',550,'en_US','2018-06-26 10:18:55','2018-06-26 10:18:55'),
(577,1,'FCS_FOODCOOPS_MAP_ENABLED','Show map with other foodcoops on home?','1','boolean',1280,'en_US','2019-02-11 22:25:36','2019-02-11 22:25:36'),
(578,1,'FCS_WEEKLY_PICKUP_DAY','Weekly pickup day','5','readonly',600,'en_US','2019-02-18 12:38:00','2019-02-18 12:38:00'),
(579,1,'FCS_DEFAULT_SEND_ORDER_LISTS_DAY_DELTA','Sending of order lists: x days before pickup day','2','readonly',650,'en_US','2019-02-18 12:38:00','2019-02-18 12:38:00'),
(580,1,'FCS_ORDER_POSSIBLE_FOR_STOCK_PRODUCTS_IN_ORDERS_WITH_DELIVERY_RHYTHM','Allow weekly orders for stock products?','1','boolean',750,'en_US','2019-02-18 12:38:00','2019-02-18 12:38:00'),
(581,1,'FCS_SHOW_NON_STOCK_PRODUCTS_IN_INSTANT_ORDERS','Only show stock products in instant orders?','0','boolean',760,'en_US','2019-02-18 12:38:00','2019-02-18 12:38:00'),
(582,1,'FCS_INCLUDE_STOCK_PRODUCTS_IN_INVOICES','Include stock products in invoices?','1','readonly',600,'en_US','2019-02-18 12:38:00','2019-02-18 12:38:00'),
(583,1,'FCS_REGISTRATION_NOTIFICATION_EMAILS','Who should be notified on new registrations?<br /><div class=\"small\">Please separate multiple e-mail addresses with , (no space).</div>','','text',550,'en_US','2019-03-05 20:01:59','2019-03-05 20:01:59'),
(584,1,'FCS_SELF_SERVICE_MODE_FOR_STOCK_PRODUCTS_ENABLED','Use self-service mode for stock products?<br /><div class=\"small\"><a href=\"https://foodcoopshop.github.io/en/self-service-mode\" target=\"_blank\">Online documentation</a></div>','0','boolean',3000,'en_US','2019-04-17 20:01:59','2019-04-17 20:01:59'),
(585,1,'FCS_APP_ADDITIONAL_DATA','Additional food-coop infos','','textarea',80,'en_US','2019-08-03 20:07:08','2019-08-03 20:07:08'),
(586,1,'FCS_SELF_SERVICE_MODE_TEST_MODE_ENABLED','Run self-service mode in test mode?<br /><div class=\"small\">Does not add links to main menu and to stock products.</div>','0','boolean',3100,'en_US','2019-12-09 13:46:32','2019-12-09 13:46:32'),
(587,1,'FCS_CASHLESS_PAYMENT_ADD_TYPE','Type of adding the payments<br /><div class=\"small\">How do the payment addings get into FoodCoopShop?</div>','manual','dropdown',1450,'en_US','2020-02-11 10:13:01','2020-02-11 10:13:01'),
(589,1,'FCS_FEEDBACK_TO_PRODUCTS_ENABLED','Are members allowed to write feedback to products?','1','boolean',3200,'en_US','2020-06-19 09:02:50','2020-06-19 09:02:50'),
(590,1,'FCS_CUSTOMER_CAN_SELECT_PICKUP_DAY','Pickup day can be selected by member on order confirmation.','0','readonly',590,'en_US','2020-07-06 10:34:39','2020-07-06 10:34:39'),
(591,1,'FCS_SEND_INVOICES_TO_CUSTOMERS','Retail mode activated?.','0','readonly',580,'en_US','2020-10-29 10:06:39','2020-10-29 10:06:39'),
(592,1,'FCS_DEPOSIT_TAX_RATE','VAT for deposit','20.00','readonly',581,'en_US','2020-11-03 15:24:01','2020-11-03 15:24:01'),
(593,1,'FCS_INVOICE_HEADER_TEXT','Header text for invoices to members','','readonly',582,'en_US','2020-11-03 15:24:01','2020-11-03 15:24:01'),
(594,1,'FCS_MEMBER_FEE_PRODUCTS','Which products are used as member fee product?<div class=\"small\">The selected products are the basis for the column Member Fee in the members adminstration and are not shown in the turnover statistics.</div>','','multiple_dropdown',3300,'en_US','2020-12-20 19:26:16','2020-12-20 19:26:16'),
(595,1,'FCS_CHECK_CREDIT_BALANCE_LIMIT','Height of credit saldo when the reminder email is sent.','50','number',1450,'en_US','2021-01-19 11:23:39','2021-01-19 11:23:39'),
(596,1,'FCS_PURCHASE_PRICE_ENABLED','Enable input of purchase price?<div class=\"small\">The purchase price is the base for profit statistics and bill of delivery to manufacturers.</div>','0','readonly',584,'en_US','2021-05-10 11:27:43','2021-05-10 11:27:43'),
(597,1,'FCS_HELLO_CASH_API_ENABLED','Enable API to hellocash.at?<div class=\"small\">Invoices (cash and cashless) are generated by hellocash.at.</div>','0','readonly',583,'en_US','2021-07-07 10:55:08','2021-07-07 10:55:08'),
(598,1,'FCS_SAVE_STORAGE_LOCATION_FOR_PRODUCTS','Save storage location for products?<div class=\"small\">New button next to \"Orders - show order as pdf\"</div>','0','boolean',3210,'en_US','2021-08-02 11:28:34','2021-08-02 11:28:34'),
(599,1,'FCS_INSTAGRAM_URL','Instagram url for embedding in footer','','text',920,'en_US','2021-09-10 21:23:13','2021-09-10 21:23:13');
/*!40000 ALTER TABLE `fcs_configuration` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_cronjob_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_cronjob_logs` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_cronjobs` DISABLE KEYS */;
INSERT INTO `fcs_cronjobs` VALUES
(1,'BackupDatabase','day',NULL,NULL,'04:00:00',1),
(2,'CheckCreditBalance','week',NULL,'Friday','22:30:00',1),
(3,'EmailOrderReminder','week',NULL,'Monday','18:00:00',1),
(4,'PickupReminder','week',NULL,'Monday','09:00:00',1),
(5,'SendInvoicesToManufacturers','month',11,NULL,'10:30:00',1),
(6,'SendOrderLists','day',NULL,NULL,'04:30:00',1),
(7,'SendInvoicesToCustomers','week',NULL,'Saturday','10:00:00',0);
/*!40000 ALTER TABLE `fcs_cronjobs` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_customer` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_deposits` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_deposits` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_images` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_invoice_taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_invoice_taxes` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_invoices` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_manufacturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_manufacturer` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_order_detail` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_order_detail_feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_order_detail_feedbacks` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_order_detail_purchase_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_order_detail_purchase_prices` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_order_detail_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_order_detail_units` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_pages` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_payments` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_pickup_days` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_pickup_days` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_product` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_product_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_product_attribute` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_product_attribute_combination` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_product_attribute_combination` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_purchase_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_purchase_prices` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_sliders` DISABLE KEYS */;
INSERT INTO `fcs_sliders` VALUES
(1,'demo-slider.jpg',NULL,0,0,1);
/*!40000 ALTER TABLE `fcs_sliders` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_stock_available` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_stock_available` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_storage_locations` DISABLE KEYS */;
INSERT INTO `fcs_storage_locations` VALUES
(1,'No cooling',10),
(2,'Refrigerator',20),
(3,'Freezer',30);
/*!40000 ALTER TABLE `fcs_storage_locations` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_sync_domains` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_sync_domains` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_sync_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_sync_products` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_tax` DISABLE KEYS */;
INSERT INTO `fcs_tax` VALUES
(1,20.000,1,0),
(2,10.000,1,0),
(3,13.000,1,0);
/*!40000 ALTER TABLE `fcs_tax` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_timebased_currency_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_timebased_currency_order_detail` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_timebased_currency_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_timebased_currency_payments` ENABLE KEYS */;

/*!40000 ALTER TABLE `fcs_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `fcs_units` ENABLE KEYS */;

/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
INSERT INTO `phinxlog` VALUES
(20200404145856,'RemoveV2Migrations','2020-04-04 15:01:08','2020-04-04 15:01:08',0),
(20200415073329,'ShowNewProductsOnHome','2020-04-15 07:41:58','2020-04-15 07:41:58',0),
(20200501192722,'EnableCashlessPaymentAddTypeConfiguration','2020-05-01 19:30:13','2020-05-01 19:30:13',0),
(20200618063024,'AddProductFeedback','2020-06-19 07:02:50','2020-06-19 07:02:50',0),
(20200703072605,'CustomerCanSelectPickupDay','2020-07-06 08:34:39','2020-07-06 08:34:39',0),
(20200831142250,'RemoveEmailLogTable','2020-08-31 15:10:25','2020-08-31 15:10:25',0),
(20200910091755,'AddMemberSettingUseCameraForMobileBarcodeScanning','2020-09-10 09:20:55','2020-09-10 09:20:55',0),
(20200925073919,'GermanIbanFix','2020-09-25 08:12:42','2020-09-25 08:12:42',0),
(20201017182431,'AdaptMinimalCreditBalance','2020-10-17 18:38:00','2020-10-17 18:38:00',0),
(20201029084931,'AddRetailMode','2020-10-29 09:06:39','2020-10-29 09:06:39',0),
(20201118084516,'AddRetailMode2','2020-11-18 08:47:37','2020-11-18 08:47:37',0),
(20201213120713,'AddRetailMode3','2020-12-13 12:14:01','2020-12-13 12:14:01',0),
(20201217101514,'SliderWithLink','2020-12-17 10:26:36','2020-12-17 10:26:37',0),
(20201220182015,'ImproveMemberFeeAdministration','2020-12-20 18:26:16','2020-12-20 18:26:16',0),
(20210119101923,'CheckCreditBalanceLimit','2021-01-19 10:23:39','2021-01-19 10:23:39',0),
(20210401071718,'RemoveCustomerGroupSetting','2021-04-01 07:18:49','2021-04-01 07:18:49',0),
(20210401082727,'CustomerActivateEmailCode','2021-04-01 08:29:17','2021-04-01 08:29:18',0),
(20210419084816,'BlogPostShowOnStartPageUntilDate','2021-04-19 09:41:18','2021-04-19 09:41:18',0),
(20210427144234,'RemoveOldMemberFeeSetting','2021-04-27 15:04:58','2021-04-27 15:04:58',0),
(20210504085123,'SaveTaxInOrderDetails','2021-05-04 09:10:09','2021-05-04 09:10:09',0),
(20210510080630,'EnablePurchasePrices','2021-05-10 09:27:43','2021-05-10 09:27:43',0),
(20210707083827,'AddRegistrierkasseApi','2021-07-07 08:55:08','2021-07-07 08:55:08',0),
(20210802090623,'AddStorageLocation','2021-08-02 09:28:34','2021-08-02 09:28:35',0),
(20210910191430,'Instagram','2021-09-10 19:23:13','2021-09-10 19:23:13',0),
(20210914071747,'DifferentPricesForCustomers','2021-09-16 05:50:07','2021-09-16 05:50:07',0),
(20210922154148,'RemoveUnusedQueueTable','2021-09-22 15:43:04','2021-09-22 15:43:04',0),
(20210923073422,'RemoveSettingShowNewProductsOnHome','2021-09-23 07:39:27','2021-09-23 07:39:27',0),
(20210923090820,'AllowNullAsPurchasePrice','2021-09-23 09:09:46','2021-09-23 09:09:46',0),
(20211028083847,'UseExistingBarcode','2021-10-28 08:44:56','2021-10-28 08:44:56',0),
(20211123095227,'DeactivateCheckCreditReminder','2021-11-23 10:01:00','2021-11-23 10:01:00',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;

/*!40000 ALTER TABLE `queue_phinxlog` DISABLE KEYS */;
INSERT INTO `queue_phinxlog` VALUES
(20150425180802,'Init','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20150511062806,'Fixmissing','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20150911132343,'ImprovementsForMysql','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20161319000000,'IncreaseDataSize','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20161319000001,'Priority','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20161319000002,'Rename','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20161319000003,'Processes','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20171013131845,'AlterQueuedJobs','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20171013133145,'Utf8mb4Fix','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20171019083500,'ColumnLength','2020-09-17 07:23:25','2020-09-17 07:23:25',0),
(20171019083501,'MigrationQueueNull','2020-09-17 07:23:25','2020-09-17 07:23:26',0),
(20171019083502,'MigrationQueueStatus','2020-09-17 07:23:26','2020-09-17 07:23:26',0),
(20171019083503,'MigrationQueueProcesses','2020-09-17 07:23:26','2020-09-17 07:23:26',0),
(20171019083505,'MigrationQueueProcessesIndex','2020-09-17 07:23:26','2020-09-17 07:23:26',0),
(20171019083506,'MigrationQueueProcessesKey','2020-09-17 07:23:26','2020-09-17 07:23:26',0),
(20191319000002,'MigrationQueueRename','2021-07-20 11:12:57','2021-07-20 11:12:57',0);
/*!40000 ALTER TABLE `queue_phinxlog` ENABLE KEYS */;

/*!40000 ALTER TABLE `queue_processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `queue_processes` ENABLE KEYS */;

/*!40000 ALTER TABLE `queued_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `queued_jobs` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

