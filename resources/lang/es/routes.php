<?php
/**
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 * 	@author : Wanekeya Sam
 *  Title   : Full-stack Developer
 * 	created	: 02 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */

$lcRoutes = [
    /*
    |--------------------------------------------------------------------------
    | Routes Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the global website.
    |
    */
    
    'countries' => 'paises',
    
    'login' => 'login',
    'logout' => 'cerrar-sesion',
    'signup' => 'registrate',
    'create' => 'crear-anuncio',

    'page' => 'pagina/{slug}.html',
    't-page' => 'pagina',
    'v-page' => 'pagina/:slug.html',

    'contact' => 'contacto.html',

];

if (config('larapen.core.multi_countries_website'))
{
    // Sitemap
    $lcRoutes['sitemap'] = '{countryCode}/mapa-del-sitio.html';
    $lcRoutes['v-sitemap'] = ':countryCode/mapa-del-sitio.html';

    // Latest Ads
    $lcRoutes['search'] = '{countryCode}/busqueda';
    $lcRoutes['t-search'] = 'busqueda';
    $lcRoutes['v-search'] = ':countryCode/busqueda';

    // Search by Sub-Category
    $lcRoutes['search-subCat'] = '{countryCode}/trabajo-categoria/{catSlug}/{subCatSlug}';
    $lcRoutes['t-search-subCat'] = 'trabajo-categoria';
    $lcRoutes['v-search-subCat'] = ':countryCode/trabajo-categoria/:catSlug/:subCatSlug';

    // Search by Category
    $lcRoutes['search-cat'] = '{countryCode}/trabajo-categoria/{catSlug}';
    $lcRoutes['t-search-cat'] = 'trabajo-categoria';
    $lcRoutes['v-search-cat'] = ':countryCode/trabajo-categoria/:catSlug';

    // Search by Location
    $lcRoutes['search-location'] = '{countryCode}/trabajos/{city}/{id}';
    $lcRoutes['t-search-location'] = 'trabajos';
    $lcRoutes['v-search-location'] = ':countryCode/trabajos/:city/:id';

    // Search by User
    $lcRoutes['search-user'] = '{countryCode}/busqueda/vendedor/{id}';
    $lcRoutes['t-search-user'] = 'busqueda/vendedor';
    $lcRoutes['v-search-user'] = ':countryCode/busqueda/vendedor/:id';

    // Search by Company name
    $lcRoutes['search-company'] = '{countryCode}/jobs-at/{companyName}';
    $lcRoutes['t-search-company'] = 'jobs-at';
    $lcRoutes['v-search-company'] = ':countryCode/jobs-at/:companyName';
}
else
{
    // Sitemap
    $lcRoutes['sitemap'] = 'mapa-del-sitio.html';
    $lcRoutes['v-sitemap'] = 'mapa-del-sitio.html';

    // Latest Ads
    $lcRoutes['search'] = 'busqueda';
    $lcRoutes['t-search'] = 'busqueda';
    $lcRoutes['v-search'] = 'busqueda';

    // Search by Sub-Category
    $lcRoutes['search-subCat'] = 'trabajo-categoria/{catSlug}/{subCatSlug}';
    $lcRoutes['t-search-subCat'] = 'trabajo-categoria';
    $lcRoutes['v-search-subCat'] = 'trabajo-categoria/:catSlug/:subCatSlug';

    // Search by Category
    $lcRoutes['search-cat'] = 'trabajo-categoria/{catSlug}';
    $lcRoutes['t-search-cat'] = 'trabajo-categoria';
    $lcRoutes['v-search-cat'] = 'trabajo-categoria/:catSlug';

    // Search by Location
    $lcRoutes['search-location'] = 'trabajos/{city}/{id}';
    $lcRoutes['t-search-location'] = 'trabajos';
    $lcRoutes['v-search-location'] = 'trabajos/:city/:id';

    // Search by User
    $lcRoutes['search-user'] = 'busqueda/vendedor/{id}';
    $lcRoutes['t-search-user'] = 'busqueda/vendedor';
    $lcRoutes['v-search-user'] = 'busqueda/vendedor/:id';

    // Search by Company name
    $lcRoutes['search-company'] = 'jobs-at/{companyName}';
    $lcRoutes['t-search-company'] = 'jobs-at';
    $lcRoutes['v-search-company'] = 'jobs-at/:companyName';
}

return $lcRoutes;