<?php
return [
	'sizes' => [
		'logo'  => [
			'tiny'     => [
				'postfix' => '_tiny',
				'width'   => 48,
				'height'  => 48
			],
			'small'    => [
				'postfix' => '_x-small',
				'width'   => 72,
				'height'  => 72
			],
			'medium'   => [
				'postfix' => '_small',
				'width'   => 96,
				'height'  => 96
			],
			'large'    => [
				'postfix' => '_medium',
				'width'   => 144,
				'height'  => 144
			],
			'big'      => [
				'postfix' => '_large',
				'width'   => 192,
				'height'  => 192
			],
			'standard' => [
				'postfix' => '_standard',
				'width'   => 768,
				'height'  => ""
			]
		],
		'image' => [
			'tiny'     => [
				'postfix' => '_tiny',
				'width'   => 48,
				'height'  => 48
			],
			'x-small'  => [
				'postfix' => '_x-small',
				'width'   => 72,
				'height'  => 72
			],
			'small'    => [
				'postfix' => '_small',
				'width'   => 96,
				'height'  => 96
			],
			'medium'   => [
				'postfix' => '_medium',
				'width'   => 144,
				'height'  => 144
			],
			'large'    => [
				'postfix' => '_large',
				'width'   => 192,
				'height'  => 192
			],
			'standard' => [
				'postfix' => '_standard',
				'width'   => 768,
				'height'  => ""
			]
		],
	],

	'validTypes' => [
		'logo',
		'image',
		'video'
	],

	'validModels' => [

		'userAvatar',
		'homeBackgroundImage',
		'workplaceLogo',
		'workplaceContent',
		'mallLogo',
		'productLogo',
		'productContent',
		'shopContent',
		'shopLogo',
		'postImage',
		'postVideo'
	],

	'ModelsToType' => [

		'postContent'      => "image",
		'postContentVideo' => "video",
		'userAvatar'       => "image",
		'workplaceContent' => "image",
		'workplaceLogo'    => "image",
		'mallLogo'         => "image",
		'productLogo'      => "image",
		'productContent'   => "image",
		'postImage'        => "image",
		'postVideo'        => "video",

	],

	'storage' => [
		'global' => 'assetsStorage'
	],
];
