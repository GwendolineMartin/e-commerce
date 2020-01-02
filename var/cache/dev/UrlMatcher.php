<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/brands' => [
            [['_route' => 'app_brand_getbrands', '_controller' => 'App\\Controller\\BrandController::getBrandsAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_brand_postbrand', '_controller' => 'App\\Controller\\BrandController::postBrandAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/choices' => [
            [['_route' => 'app_choice_getchoices', '_controller' => 'App\\Controller\\ChoiceController::getChoicesAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_choice_postchoice', '_controller' => 'App\\Controller\\ChoiceController::postChoiceAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/products' => [
            [['_route' => 'app_product_getproducts', '_controller' => 'App\\Controller\\ProductController::getProductsAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_product_postproduct', '_controller' => 'App\\Controller\\ProductController::postProductAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/profils' => [
            [['_route' => 'app_profil_getprofils', '_controller' => 'App\\Controller\\ProfilController::getProfilsAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_profil_postprofil', '_controller' => 'App\\Controller\\ProfilController::postProfilAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/skus' => [
            [['_route' => 'app_sku_getskus', '_controller' => 'App\\Controller\\SkuController::getSkusAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_sku_postsku', '_controller' => 'App\\Controller\\SkuController::postSkuAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/types' => [
            [['_route' => 'app_type_gettypes', '_controller' => 'App\\Controller\\TypeController::getTypesAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_type_posttype', '_controller' => 'App\\Controller\\TypeController::postTypeAction'], null, ['POST' => 0], null, false, false, null],
        ],
        '/users' => [
            [['_route' => 'app_user_getusers', '_controller' => 'App\\Controller\\UserController::getUsersAction'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_user_postuser', '_controller' => 'App\\Controller\\UserController::postUserAction'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/brands/([^/]++)(?'
                    .'|(*:61)'
                    .'|(*:68)'
                .')'
                .'|/choices/([^/]++)(?'
                    .'|(*:96)'
                    .'|(*:103)'
                .')'
                .'|/pro(?'
                    .'|ducts/([^/]++)(?'
                        .'|(*:136)'
                        .'|(*:144)'
                    .')'
                    .'|fils/([^/]++)(?'
                        .'|(*:169)'
                        .'|(*:177)'
                    .')'
                .')'
                .'|/skus/([^/]++)(?'
                    .'|(*:204)'
                    .'|(*:212)'
                .')'
                .'|/types/([^/]++)(?'
                    .'|(*:239)'
                    .'|(*:247)'
                .')'
                .'|/users/([^/]++)(?'
                    .'|(*:274)'
                    .'|(*:282)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        61 => [[['_route' => 'app_brand_getbrand', '_controller' => 'App\\Controller\\BrandController::getBrandAction'], ['brandId'], ['GET' => 0], null, false, true, null]],
        68 => [
            [['_route' => 'app_brand_editbrand', '_controller' => 'App\\Controller\\BrandController::editBrandAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_brand_deletebrand', '_controller' => 'App\\Controller\\BrandController::deleteBrandAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        96 => [[['_route' => 'app_choice_getchoice', '_controller' => 'App\\Controller\\ChoiceController::getChoiceAction'], ['choiceId'], ['GET' => 0], null, false, true, null]],
        103 => [
            [['_route' => 'app_choice_editchoice', '_controller' => 'App\\Controller\\ChoiceController::editChoiceAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_choice_deletechoice', '_controller' => 'App\\Controller\\ChoiceController::deleteChoiceAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        136 => [[['_route' => 'app_product_getproduct', '_controller' => 'App\\Controller\\ProductController::getProductAction'], ['productId'], ['GET' => 0], null, false, true, null]],
        144 => [
            [['_route' => 'app_product_editproduct', '_controller' => 'App\\Controller\\ProductController::editProductAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_product_deleteproduct', '_controller' => 'App\\Controller\\ProductController::deleteProductAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        169 => [[['_route' => 'app_profil_getprofil', '_controller' => 'App\\Controller\\ProfilController::getProfilAction'], ['profilId'], ['GET' => 0], null, false, true, null]],
        177 => [
            [['_route' => 'app_profil_editprofil', '_controller' => 'App\\Controller\\ProfilController::editProfilAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_profil_deleteprofil', '_controller' => 'App\\Controller\\ProfilController::deleteProfilAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        204 => [[['_route' => 'app_sku_getsku', '_controller' => 'App\\Controller\\SkuController::getSkuAction'], ['skuId'], ['GET' => 0], null, false, true, null]],
        212 => [
            [['_route' => 'app_sku_editbrand', '_controller' => 'App\\Controller\\SkuController::editBrandAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_sku_deletebrand', '_controller' => 'App\\Controller\\SkuController::deleteBrandAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        239 => [[['_route' => 'app_type_gettype', '_controller' => 'App\\Controller\\TypeController::getTypeAction'], ['typeId'], ['GET' => 0], null, false, true, null]],
        247 => [
            [['_route' => 'app_type_edittype', '_controller' => 'App\\Controller\\TypeController::editTypeAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_type_deletetype', '_controller' => 'App\\Controller\\TypeController::deleteTypeAction'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        274 => [[['_route' => 'app_user_getuser', '_controller' => 'App\\Controller\\UserController::getUserAction'], ['userId'], ['GET' => 0], null, false, true, null]],
        282 => [
            [['_route' => 'app_user_edituser', '_controller' => 'App\\Controller\\UserController::editUserAction'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_user_deleteuser', '_controller' => 'App\\Controller\\UserController::deleteUserAction'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
