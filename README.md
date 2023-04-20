# OrderDetails

### Features
*   It displays all order details information on the success page.
*   Show Thank you message.
*	Improve content of your Magento 2 thank you page.
*   Make your store more friendly with customers.

## Installation

1. Please run the following command
```shell
composer require arslanfarrukh/order-details
```

2. Update the composer if required
```shell
composer update
```

3. Enable module
```shell
php bin/magento module:enable ArslanFarrukh_Core
php bin/magento module:enable ArslanFarrukh_OrderDetails
php bin/magento setup:upgrade
php bin/magento cache:clean
php bin/magento cache:flush
```
4.If your website is running in product mode the you need to deploy static content and
then clear the cache
```shell
php bin/magento setup:static-content:deploy
php bin/magento setup:di:compile
```



#####This extension is compatible with all the versions of Magento 2.3.* and 2.4.*.
###Tested on following instances:
#####multiple instances i.e. 2.3.7-p3 and 2.4.5-p1
