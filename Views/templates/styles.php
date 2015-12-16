	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/bootstrap/css/bootstrap-submenu.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/DataTables/media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/Views/libs/adds/css/helpers.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?php echo BASE_URL; ?>/Views/libs/bootstrap/ie8/html5shiv.min.js"></script>
		<script src="<?php echo BASE_URL; ?>/Views/libs/bootstrap/ie8/respond.min.js"></script>
	<![endif]-->

	<?php
		if (isset($styles) && !empty($styles)) {
			foreach ($styles as $stylesheetpath) {
				echo '<link rel="stylesheet" href="' . BASE_URL . '/Views/libs/' . $stylesheetpath . '.css">';
			}
		}
	?>
</head>
<body>