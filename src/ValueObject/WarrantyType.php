<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\ValueObject;

class WarrantyType
{
    public const MARKETPLACE = 'Marketplace';
    public const MANUFACTURER_BY_WARRANTY_CARD = 'ManufacturerByWarrantyCard';
    public const MANUFACTURER_BY_SALES_RECEIPT = 'ManufacturerBySalesReceipt';
    public const MANUFACTURER_ON_SITE_VISIT = 'ManufacturerOnSiteVisit';
}
