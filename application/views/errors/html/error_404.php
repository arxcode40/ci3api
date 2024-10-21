<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html data-bs-theme="dark" lang="id">
<head>
	<meta charset="utf-8" />
	<meta content="initial-scale=1.0, width=device-width" name="viewport" />
	<meta content="ie=edge" http-equiv="X-UA-Compatible" />
	<meta content="dark" name="color-scheme" />
	<meta content="#0d6efd" name="theme-color" />

	<title><?= $status_code ?> | Not Found</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
	<style>
		.min-dvh-100 {
		  min-height: 100dvh;
		}
	</style>
</head>
<body class="container-fluid d-flex flex-column min-dvh-100 py-3">
	<div class="hstack gap-3 m-auto">		
		<h1 class="mb-0"><?= $status_code ?></h1>
		<div class="vr"></div>
		<h1 class="mb-0">Not Found</h1>
	</div>
</body>
</html>
