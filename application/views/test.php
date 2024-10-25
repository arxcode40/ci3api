<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html data-bs-theme="dark" lang="id">
<head>
	<meta charset="utf-8" />
	<meta content="initial-scale=1.0, width=device-width" name="viewport" />
	<meta content="ie=edge" http-equiv="X-UA-Compatible" />
	<meta content="dark" name="color-scheme" />
	<meta content="#0d6efd" name="theme-color" />

	<link href="<?= base_url('favicon.ico') ?>" rel="apple-touch-icon" />
	<link href="<?= base_url('favicon.ico') ?>" rel="icon shortcut" type="image/x-icon" />
	<title>API Tester</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release/build/styles/dark.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release/build/highlight.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release/build/languages/json.min.js"></script>
</head>
<body>
	<div class="container py-3">
		<h1>API Tester</h1>
		<form action="" id="request">
			<label class="form-label" for="endpoint">Request</label>
			<div class="input-group mb-3">
				<select class="form-select" id="method" required="required" style="max-width: max-content;">
					<option value="get">GET</option>
					<option value="post">POST</option>
					<option value="put">PUT</option>
					<option value="patch">PATCH</option>
					<option value="delete">DELETE</option>
					<option value="head">HEAD</option>
					<option value="options">OPTIONS</option>
				</select>
				<input class="form-control" id="endpoint" placeholder="Enter URL or paste text" required="required" type="url" />
				<button class="btn btn-primary" type="submit">Send</button>
			</div>			
		</form>
		<div class="accordion" id="accordion">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" data-bs-target="#accordionRequest" data-bs-toggle="collapse" type="button">Body</button>
				</h2>
				<div class="accordion-collapse collapse" data-bs-parent="#accordion" id="accordionRequest">
					<div class="accordion-body">
						<textarea class="form-control" id="body" placeholder="Raw JSON" rows="5"></textarea>
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button" data-bs-target="#accordionResponse" data-bs-toggle="collapse" type="button">Response</button>
				</h2>
				<div class="accordion-collapse collapse show" data-bs-parent="#accordion" id="accordionResponse">
					<div class="accordion-body">
						<pre class="mb-0"><code id="response">Enter the URL and click <strong class="text-body-emphasis">Send</strong> to get a response</code></pre>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$("#request").on("submit", function() {
			event.preventDefault();
			$.ajax({
				data: JSON.parse($("#body").val() || "{}"),
				complete: function(data) {
					const response = hljs.highlight(JSON.stringify(data.responseJSON, null, "\t"), { language: "json" }).value;

					$("#response").html(response);
				},
				method: $("#method").val(),
				url: $("#endpoint").val()
			});
		});
	</script>
</body>
</html>
