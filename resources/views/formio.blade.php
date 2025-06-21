<!DOCTYPE html>
<html>
<head>
    <title>Form.io Schema Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Form.io Form Schema</h2>
    <pre class="bg-light p-3 border rounded">
{{ json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
    </pre>
</body>
</html>
