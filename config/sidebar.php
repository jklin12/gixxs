<?php

return [

	/*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
	'menu' => [
		[
			'icon' => 'fa fa-th-large',
			'title' => 'Dashboard',
			'url' => '/dashboard',
			'route-name' => 'dashboard.index'
		],
		[
			'icon' => 'fa fa-map',
			'title' => 'Geojson ',
			'url' => '/dashboard/geojson',
			'route-name' => 'geojson.index'

		], [
			'icon' => 'fa fa-file-alt',
			'title' => 'Perijinan',
			'url' => 'javascript:;',
			'caret' => true,
			'sub_menu' => [
				[
					'url' => '/dashboard/ijin_lingkungan',
					'title' => 'Ijin Lingkungan',
					'route-name' => 'ijin_lingkungan.index'
				],
				[
					'url' => '/dashboard/kes',
					'title' => 'Kawasan Ekosistem Esnsial',
					'route-name' => 'kes.index'
				],
				[
					'url' => '/dashboard/dkl',
					'title' => 'Dokumen Kajian Lingkungan',
					'route-name' => 'dkl.index'
				],
				[
					'url' => '/dashboard/sppl',
					'title' => 'Sppl',
					'route-name' => 'sppl.index'
				],
			]
		],
		[
			'icon' => 'fa fa-image',
			'title' => 'Galery ',
			'url' => '/dashboard/galery',
			'route-name' => 'galery.index'

		], 
		[
			'icon' => 'fa fa-cog',
			'title' => 'Option ',
			'url' => '/dashboard/option',
			'route-name' => 'option.index'

		], 
	]
];
