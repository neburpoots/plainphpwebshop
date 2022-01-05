<?php
spl_autoload_register(function($className) {
	
	switch(true) {
		case stristr($className, 'Controller'):
			$file = __DIR__ . '/' . 'controllers' . '/' . $className . '.php';
			break;
		case stristr($className, 'Validation'):
			$file = __DIR__ . '/' . 'validation' . '/' . $className . '.php';
			break;
		case stristr($className, 'Repository'):
			$file = __DIR__ . '/' . 'repositories' . '/' . $className . '.php';
			break;		
		case stristr($className, 'Service'):
			$file = __DIR__ . '/' . 'services' . '/' . $className . '.php';
			break;
		case stristr($className, 'User'):
				$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
				break;
		case stristr($className, 'Role'):
				$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
				break;
		case stristr($className, 'ShoppingCart'):
			$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
			break;
		case stristr($className, 'CartProduct'):
			$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
			break;
		case stristr($className, 'Product'):
			$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
			break;
		case stristr($className, 'Order_Line'):
			$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
			break;
		case stristr($className, 'Order'):
			$file = __DIR__ . '/' . 'models' . '/' . $className . '.php';
			break;
		default: 
			$file = __DIR__ . '\\' . $className . '.php';
	}

	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		include $file;
	}
});