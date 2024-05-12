<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Developer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="/p/Template/Convert.php">- <img width="25" height="25"
                src="https://vectorflags.s3.amazonaws.com/flags/tn-circle-01.png">TN Money</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="/p/Template/Convert.php">Currency Converter</a>
                <a class="nav-item nav-link" href="/p/Template/Dashboard.php">Live Board</a>
                <a class="nav-item nav-link" href="/p/Template/Generate.php">API</a>
                <a class="nav-item nav-link" href="/p/Template/Dev.php">Developer</a>

            </div>
        </div>


        <form class="form-inline">
            <a class="nav-item nav-link" href="/p/Template/Login.php">LOGIN</a>
        </form>
    </nav>
    <div class="container">

        <h1 class="code-line" data-line-start=1 data-line-end=2><a id="Currency_Converter_tunisian_dinar_1"></a>Currency
            Converter (tunisian dinar)</h1>
        <p class="has-line-data" data-line-start="3" data-line-end="4">The Currency Converter API project aims to
            provide a web service for converting currencies based on real-time exchange rates. The API allows users to
            retrieve the current exchange rates between different currencies and perform currency conversions using
            these rates.</p>
        <h2 class="code-line" data-line-start=6 data-line-end=7><a id="Features_6"></a>Features</h2>
        <ul>
            <li class="has-line-data" data-line-start="8" data-line-end="9"><strong>Anti-DDoS Protection:</strong>
                Implemented measures to mitigate distributed denial-of-service (DDoS) attacks, ensuring the API remains
                available and responsive under heavy traffic conditions with the same ip@.</li>
            <li class="has-line-data" data-line-start="9" data-line-end="10"><strong>Form Validation:</strong>
                Incorporates comprehensive form validation mechanisms to ensure data integrity and prevent malicious
                input, enhancing the security and reliability of currency conversion requests.</li>
            <li class="has-line-data" data-line-start="10" data-line-end="11"><strong>Database Connectivity:</strong>
                Establishes a secure connection to the database to store and manage exchange rate data, enabling
                efficient retrieval and updating of currency information as needed.</li>
        </ul>
        <h2 class="code-line" data-line-start=13 data-line-end=14><a id="API_Reference_13"></a>API Reference</h2>
        <h4 class="code-line" data-line-start=15 data-line-end=16><a id="Get_New_API_Key_15"></a>Get New API Key</h4>
        <pre><code class="has-line-data" data-line-start="18" data-line-end="20" class="language-http">  GET /API/register.php
</code></pre>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align:left">Parameter</th>
                    <th style="text-align:left">Type</th>
                    <th style="text-align:left">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:left"><code>action</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Specify “register” to generate a new API key.
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>pwd</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. The Secret key.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>name</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. App Name.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>email</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Email.</td>
                </tr>
            </tbody>
        </table>
        <h4 class="code-line" data-line-start=28 data-line-end=29><a id="Get_Supported_Currencies_List_28"></a>Get
            Supported Currencies List</h4>
        <pre><code class="has-line-data" data-line-start="31" data-line-end="33" class="language-http">  GET /API/api.php
</code></pre>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align:left">Parameter</th>
                    <th style="text-align:left">Type</th>
                    <th style="text-align:left">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:left"><code>apiKey</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Your API key.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>action</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Specify “supportedCurrencies” to get a list
                        of supported currencies.</td>
                </tr>
            </tbody>
        </table>
        <h4 class="code-line" data-line-start=40 data-line-end=41><a id="Convert_Currencies_40"></a>Convert Currencies
        </h4>
        <pre><code class="has-line-data" data-line-start="42" data-line-end="44" class="language-http">  GET /API/api.php
</code></pre>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align:left">Parameter</th>
                    <th style="text-align:left">Type</th>
                    <th style="text-align:left">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:left"><code>apiKey</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Your API key.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>action</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Specify “convert” to convert currencies.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>from</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. The source currency.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>to</code></td>
                    <td style="text-align:left"><code>string</code></td>
                    <td style="text-align:left"><strong>Required</strong>. The target currency.</td>
                </tr>
                <tr>
                    <td style="text-align:left"><code>amount</code></td>
                    <td style="text-align:left"><code>int</code></td>
                    <td style="text-align:left"><strong>Required</strong>. Amount of currency to convert.</td>
                </tr>
            </tbody>
        </table>

        <h4 class="code-line" data-line-start=65 data-line-end=66><a id="Params_65"></a>Params</h4>
        <p class="has-line-data" data-line-start="67" data-line-end="70"><strong>“register”</strong><br>
            <strong>“supportedCurrencies”</strong> <br>
            <strong>“convert”</strong>
        </p>

</body>

</html>