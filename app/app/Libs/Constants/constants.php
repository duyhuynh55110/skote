<?php

// Status code
// https://connect.ebsco.com/s/article/I-received-an-error-code-when-I-tried-to-log-in-to-EBSCOhost-What-do-these-error-messages-mean?language=en_US
defined('STATUS_CODE_LOGIN_FAILED') or define('STATUS_CODE_LOGIN_FAILED', 'LOGIN_FAILED');

// Created by system (set when creating/updating on a model without admin role)
defined('CREATED_BY_SYSTEM') or define('CREATED_BY_SYSTEM', 0);

// Storage
defined('STORAGE_IMAGE_QUANTITY') or define('STORAGE_IMAGE_QUANTITY', 90);
defined('STORAGE_IMAGE_ALLOW_EXTENSION') or define('STORAGE_IMAGE_ALLOW_EXTENSION', '/\.([^.]*)(jpg|jpeg|png)$/i');
defined('STORAGE_SUFFIX_ORIGINAL_RESIZE') or define('STORAGE_SUFFIX_ORIGINAL_RESIZE', '_original$0');

defined('STORAGE_PATH_TO_CATEGORIES') or define('STORAGE_PATH_TO_CATEGORIES', 'categories/');
defined('STORAGE_PATH_TO_BRANDS') or define('STORAGE_PATH_TO_BRANDS', 'brands/');
defined('STORAGE_PATH_TO_PRODUCTS') or define('STORAGE_PATH_TO_PRODUCTS', 'products/');

// Resize width & height
defined('RESIZE_CATEGORY_WIDTH') or define('RESIZE_CATEGORY_WIDTH', 70);
defined('RESIZE_CATEGORY_HEIGHT') or define('RESIZE_CATEGORY_HEIGHT', 70);
defined('RESIZE_BRAND_WIDTH') or define('RESIZE_BRAND_WIDTH', 150);
defined('RESIZE_BRAND_HEIGHT') or define('RESIZE_BRAND_HEIGHT', 150);
defined('RESIZE_PRODUCT_WIDTH') or define('RESIZE_PRODUCT_WIDTH', 388);
defined('RESIZE_PRODUCT_HEIGHT') or define('RESIZE_PRODUCT_HEIGHT', 442);

// Request header name
defined('REQUEST_HEADER_ACCEPT_LOCALE') or define('REQUEST_HEADER_ACCEPT_LOCALE', 'Accept-Locale');

// System default values
defined('DEFAULT_LOCALE') or define('DEFAULT_LOCALE', 'en');

// order products list
defined('ORDER_BY_NEWEST') or define('ORDER_BY_NEWEST', 'newest');
defined('ORDER_BY_TOP_SELLING') or define('ORDER_BY_TOP_SELLING', 'top_selling');
defined('ORDER_BY_POPULAR') or define('ORDER_BY_POPULAR', 'popular');
defined('ORDER_BY_LOW_TO_HEIGHT') or define('ORDER_BY_LOW_TO_HEIGHT', 'low_to_height');
defined('ORDER_BY_HEIGHT_TO_LOW') or define('ORDER_BY_HEIGHT_TO_LOW', 'height_to_low');

// Default limit union records
defined('DEFAULT_LIMIT_UNION_TABLE_RECORDS') or define('DEFAULT_LIMIT_UNION_TABLE_RECORDS', 20);

// Types in union table
defined('UNION_TABLE_TYPE_PRODUCT') or define('UNION_TABLE_TYPE_PRODUCT', 'product');
defined('UNION_TABLE_TYPE_BRAND') or define('UNION_TABLE_TYPE_BRAND', 'brand');
