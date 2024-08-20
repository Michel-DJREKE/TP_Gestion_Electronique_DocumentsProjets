
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <link rel="stylesheet" href="{{ asset('swagger-ui/swagger-ui.css') }}">
</head>
<body>
<div id="swagger-ui"></div>
<script src="{{ asset('swagger-ui/swagger-ui-bundle.js') }}"></script>
<script src="{{ asset('swagger-ui/swagger-ui-standalone-preset.js') }}"></script>
<script>
    const ui = SwaggerUIBundle({
        url: "{{ asset('openapi.json') }}",
        dom_id: '#swagger-ui',
        deepLinking: true,
        presets: [
    SwaggerUIBundle.presets.apis,
    SwaggerUIBundle.presets.downloadUrl
],
        layout: "BaseLayout"
    });
</script>
</body>
</html>
