<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon"/>

    @if(App::environment('production'))
        <script src="https://cdn.usefathom.com/script.js" data-spa="auto" data-site="WTREBFEJ" defer></script>
    @endif

    <script src="https://www.google.com/recaptcha/api.js?render=6Ld2bfYdAAAAAL6yv0Oa-lRgw9y93KtIaXDdo20T"></script>
    <style id="captchaStyle"> .grecaptcha-badge { visibility: hidden !important; } </style>
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/agate.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"></script>
    <script>

        document.addEventListener('inertia:finish', (event) => {
            document.querySelectorAll('pre').forEach((el) => {
                hljs.highlightElement(el);
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre').forEach((el) => {
                hljs.highlightElement(el);
            });
        });

    </script>

</head>
<body class="bg-gray-700">
@inertia
</body>
</html>
