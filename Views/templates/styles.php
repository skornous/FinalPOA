<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/css/foundation.css">
<!--<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">-->

<?php
	if (isset($styles) && !empty($styles)) {
		foreach ($styles as $stylesheetpath) {
			echo '<link rel="stylesheet" href="' . BASE_URL . '/Views/libs/' . $stylesheetpath . '.css">';
		}
	}
?>
</head>
<body>