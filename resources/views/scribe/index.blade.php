<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-campaigns" class="tocify-header">
                <li class="tocify-item level-1" data-unique="campaigns">
                    <a href="#campaigns">Campaigns</a>
                </li>
                                    <ul id="tocify-subheader-campaigns" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="campaigns-GETapi-campaings">
                                <a href="#campaigns-GETapi-campaings">Display a listing of campaigns.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="campaigns-POSTapi-campaings">
                                <a href="#campaigns-POSTapi-campaings">Store a newly created campaign in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="campaigns-GETapi-campaings--id-">
                                <a href="#campaigns-GETapi-campaings--id-">Display the specified campaign.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="campaigns-PUTapi-campaings--id-">
                                <a href="#campaigns-PUTapi-campaings--id-">Update the specified campaign in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="campaigns-DELETEapi-campaings--id-">
                                <a href="#campaigns-DELETEapi-campaings--id-">Remove the specified campaign from storage.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-equipments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="equipments">
                    <a href="#equipments">Equipments</a>
                </li>
                                    <ul id="tocify-subheader-equipments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="equipments-GETapi-hunters">
                                <a href="#equipments-GETapi-hunters">Display a listing of the hunters.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-POSTapi-hunters">
                                <a href="#equipments-POSTapi-hunters">Store a newly created hunter in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-GETapi-hunters--id-">
                                <a href="#equipments-GETapi-hunters--id-">Display the specified hunter.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-PUTapi-hunters--id-">
                                <a href="#equipments-PUTapi-hunters--id-">Update the specified hunter in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-DELETEapi-hunters--id-">
                                <a href="#equipments-DELETEapi-hunters--id-">Remove the specified hunter from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-GETapi-equipment">
                                <a href="#equipments-GETapi-equipment">Display a listing of the equipments.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-POSTapi-equipment">
                                <a href="#equipments-POSTapi-equipment">Store a newly created equipment in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-GETapi-equipment--id-">
                                <a href="#equipments-GETapi-equipment--id-">Display the specified equipment.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-PUTapi-equipment--id-">
                                <a href="#equipments-PUTapi-equipment--id-">Update the specified equipment in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="equipments-DELETEapi-equipment--id-">
                                <a href="#equipments-DELETEapi-equipment--id-">Remove the specified equipment from storage.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-maps" class="tocify-header">
                <li class="tocify-item level-1" data-unique="maps">
                    <a href="#maps">Maps</a>
                </li>
                                    <ul id="tocify-subheader-maps" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="maps-GETapi-maps">
                                <a href="#maps-GETapi-maps">Display a listing of maps.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="maps-POSTapi-maps">
                                <a href="#maps-POSTapi-maps">Store a newly created map in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="maps-GETapi-maps--id-">
                                <a href="#maps-GETapi-maps--id-">Display the specified map.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="maps-PUTapi-maps--id-">
                                <a href="#maps-PUTapi-maps--id-">Update the specified map in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="maps-DELETEapi-maps--id-">
                                <a href="#maps-DELETEapi-maps--id-">Remove the specified map from storage.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: October 1, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="campaigns">Campaigns</h1>

    <p>Endpoints for managing campaigns</p>

                                <h2 id="campaigns-GETapi-campaings">Display a listing of campaigns.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-campaings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/campaings?sort=consequatur&amp;direction=consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/campaings"
);

const params = {
    "sort": "consequatur",
    "direction": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-campaings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;metadata&quot;: [],
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Feil-Hansen&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Proactive executive data-warehouse&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Azerbaijan&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Ernser and Sons&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Re-engineered asynchronous service-desk&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Azerbaijan&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Weber-Johns&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Secured homogeneous knowledgeuser&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Azerbaijan&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Wyman-Walker&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Exclusive uniform toolset&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Azerbaijan&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Auer, Beier and Hermiston&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Programmable radical throughput&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Azerbaijan&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Emard-Stoltenberg&quot;,
            &quot;mapId&quot;: 2,
            &quot;teamName&quot;: &quot;Public-key static artificialintelligence&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Israel&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Jast Inc&quot;,
            &quot;mapId&quot;: 2,
            &quot;teamName&quot;: &quot;Extended holistic leverage&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Israel&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Braun, Simonis and Paucek&quot;,
            &quot;mapId&quot;: 2,
            &quot;teamName&quot;: &quot;Operative disintermediate adapter&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Israel&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Becker, Olson and Fadel&quot;,
            &quot;mapId&quot;: 2,
            &quot;teamName&quot;: &quot;Persevering bottom-line product&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Israel&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Prosacco and Sons&quot;,
            &quot;mapId&quot;: 2,
            &quot;teamName&quot;: &quot;Managed optimizing pricingstructure&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Israel&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Kozey-Little&quot;,
            &quot;mapId&quot;: 3,
            &quot;teamName&quot;: &quot;Reverse-engineered mobile strategy&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Germany&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;Fritsch, Schulist and Bode&quot;,
            &quot;mapId&quot;: 3,
            &quot;teamName&quot;: &quot;Expanded zerodefect installation&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Germany&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 13,
            &quot;name&quot;: &quot;Flatley, Johnson and Bogan&quot;,
            &quot;mapId&quot;: 3,
            &quot;teamName&quot;: &quot;Re-contextualized context-sensitive software&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Germany&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Mayer-Mann&quot;,
            &quot;mapId&quot;: 3,
            &quot;teamName&quot;: &quot;Centralized web-enabled GraphicInterface&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Germany&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Nicolas-Witting&quot;,
            &quot;mapId&quot;: 3,
            &quot;teamName&quot;: &quot;Operative asynchronous functionalities&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Germany&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 16,
            &quot;name&quot;: &quot;Graham, Runolfsdottir and Hodkiewicz&quot;,
            &quot;mapId&quot;: 4,
            &quot;teamName&quot;: &quot;Centralized systemic archive&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Zimbabwe&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 17,
            &quot;name&quot;: &quot;McKenzie-Pacocha&quot;,
            &quot;mapId&quot;: 4,
            &quot;teamName&quot;: &quot;Exclusive 4thgeneration data-warehouse&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Zimbabwe&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 18,
            &quot;name&quot;: &quot;Marquardt LLC&quot;,
            &quot;mapId&quot;: 4,
            &quot;teamName&quot;: &quot;Public-key multimedia success&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Zimbabwe&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 19,
            &quot;name&quot;: &quot;Hand, McCullough and Carter&quot;,
            &quot;mapId&quot;: 4,
            &quot;teamName&quot;: &quot;Down-sized multi-state encryption&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Zimbabwe&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 20,
            &quot;name&quot;: &quot;Bashirian-Mosciski&quot;,
            &quot;mapId&quot;: 4,
            &quot;teamName&quot;: &quot;Centralized analyzing alliance&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Zimbabwe&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 21,
            &quot;name&quot;: &quot;Schuppe Ltd&quot;,
            &quot;mapId&quot;: 5,
            &quot;teamName&quot;: &quot;Seamless asynchronous frame&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Bolivia&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 22,
            &quot;name&quot;: &quot;Labadie, Block and Parker&quot;,
            &quot;mapId&quot;: 5,
            &quot;teamName&quot;: &quot;Visionary hybrid emulation&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Bolivia&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 23,
            &quot;name&quot;: &quot;Emard Group&quot;,
            &quot;mapId&quot;: 5,
            &quot;teamName&quot;: &quot;Vision-oriented heuristic knowledgebase&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Bolivia&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 24,
            &quot;name&quot;: &quot;Schuppe, Schaefer and Hettinger&quot;,
            &quot;mapId&quot;: 5,
            &quot;teamName&quot;: &quot;Cross-platform human-resource contingency&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Bolivia&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 25,
            &quot;name&quot;: &quot;Willms, Ledner and Torphy&quot;,
            &quot;mapId&quot;: 5,
            &quot;teamName&quot;: &quot;Operative impactful help-desk&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Bolivia&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 26,
            &quot;name&quot;: &quot;Hansen, Osinski and Glover&quot;,
            &quot;mapId&quot;: 6,
            &quot;teamName&quot;: &quot;Switchable radical openarchitecture&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Mauritius&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 27,
            &quot;name&quot;: &quot;Daugherty-Stoltenberg&quot;,
            &quot;mapId&quot;: 6,
            &quot;teamName&quot;: &quot;Switchable static help-desk&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Mauritius&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 28,
            &quot;name&quot;: &quot;Marquardt, Keebler and Schowalter&quot;,
            &quot;mapId&quot;: 6,
            &quot;teamName&quot;: &quot;Balanced real-time GraphicInterface&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Mauritius&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 29,
            &quot;name&quot;: &quot;Wiza, Schuppe and Murphy&quot;,
            &quot;mapId&quot;: 6,
            &quot;teamName&quot;: &quot;Re-engineered context-sensitive core&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Mauritius&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 30,
            &quot;name&quot;: &quot;Oberbrunner-Mayert&quot;,
            &quot;mapId&quot;: 6,
            &quot;teamName&quot;: &quot;Facetoface transitional array&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Mauritius&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 31,
            &quot;name&quot;: &quot;Casper LLC&quot;,
            &quot;mapId&quot;: 7,
            &quot;teamName&quot;: &quot;Virtual real-time throughput&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Angola&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 32,
            &quot;name&quot;: &quot;Denesik, Reinger and Ledner&quot;,
            &quot;mapId&quot;: 7,
            &quot;teamName&quot;: &quot;Business-focused background access&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Angola&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 33,
            &quot;name&quot;: &quot;Koch-Funk&quot;,
            &quot;mapId&quot;: 7,
            &quot;teamName&quot;: &quot;Polarised foreground hierarchy&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Angola&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 34,
            &quot;name&quot;: &quot;Gottlieb and Sons&quot;,
            &quot;mapId&quot;: 7,
            &quot;teamName&quot;: &quot;Multi-lateral cohesive migration&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Angola&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 35,
            &quot;name&quot;: &quot;Ledner-Hegmann&quot;,
            &quot;mapId&quot;: 7,
            &quot;teamName&quot;: &quot;Extended stable capacity&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Angola&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 36,
            &quot;name&quot;: &quot;Becker-Monahan&quot;,
            &quot;mapId&quot;: 8,
            &quot;teamName&quot;: &quot;Focused cohesive protocol&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Morocco&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Yost-Braun&quot;,
            &quot;mapId&quot;: 8,
            &quot;teamName&quot;: &quot;Expanded solution-oriented encoding&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Morocco&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 38,
            &quot;name&quot;: &quot;Wilkinson-Blanda&quot;,
            &quot;mapId&quot;: 8,
            &quot;teamName&quot;: &quot;Organic modular firmware&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Morocco&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 39,
            &quot;name&quot;: &quot;Witting, Spencer and Ortiz&quot;,
            &quot;mapId&quot;: 8,
            &quot;teamName&quot;: &quot;Programmable systematic methodology&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Morocco&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 40,
            &quot;name&quot;: &quot;Konopelski, Mueller and Carter&quot;,
            &quot;mapId&quot;: 8,
            &quot;teamName&quot;: &quot;Organized optimizing leverage&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Morocco&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 41,
            &quot;name&quot;: &quot;Daugherty, Marquardt and Spinka&quot;,
            &quot;mapId&quot;: 9,
            &quot;teamName&quot;: &quot;Pre-emptive leadingedge algorithm&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Iraq&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 42,
            &quot;name&quot;: &quot;Beatty, Little and Wisozk&quot;,
            &quot;mapId&quot;: 9,
            &quot;teamName&quot;: &quot;Enterprise-wide composite product&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Iraq&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 43,
            &quot;name&quot;: &quot;Heaney, Rice and Halvorson&quot;,
            &quot;mapId&quot;: 9,
            &quot;teamName&quot;: &quot;Up-sized attitude-oriented budgetarymanagement&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Iraq&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 44,
            &quot;name&quot;: &quot;West, Volkman and Hessel&quot;,
            &quot;mapId&quot;: 9,
            &quot;teamName&quot;: &quot;Synchronised didactic attitude&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Iraq&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 45,
            &quot;name&quot;: &quot;Gulgowski and Sons&quot;,
            &quot;mapId&quot;: 9,
            &quot;teamName&quot;: &quot;Devolved bottom-line data-warehouse&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Iraq&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 46,
            &quot;name&quot;: &quot;Quigley, Weissnat and Dickinson&quot;,
            &quot;mapId&quot;: 10,
            &quot;teamName&quot;: &quot;Profound non-volatile collaboration&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Tonga&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 47,
            &quot;name&quot;: &quot;Hills, Farrell and Ritchie&quot;,
            &quot;mapId&quot;: 10,
            &quot;teamName&quot;: &quot;Multi-layered client-driven GraphicalUserInterface&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Tonga&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 48,
            &quot;name&quot;: &quot;Schneider-Rau&quot;,
            &quot;mapId&quot;: 10,
            &quot;teamName&quot;: &quot;Sharable multimedia emulation&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Tonga&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 49,
            &quot;name&quot;: &quot;Dach PLC&quot;,
            &quot;mapId&quot;: 10,
            &quot;teamName&quot;: &quot;Quality-focused incremental localareanetwork&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Tonga&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 50,
            &quot;name&quot;: &quot;Jerde Inc&quot;,
            &quot;mapId&quot;: 10,
            &quot;teamName&quot;: &quot;Sharable multi-tasking methodology&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;map&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Tonga&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-campaings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-campaings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-campaings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-campaings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-campaings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-campaings" data-method="GET"
      data-path="api/campaings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-campaings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-campaings"
                    onclick="tryItOut('GETapi-campaings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-campaings"
                    onclick="cancelTryOut('GETapi-campaings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-campaings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/campaings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-campaings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-campaings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-campaings"
               value="consequatur"
               data-component="query">
    <br>
<p>Field to sort by. Defaults to 'id' Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="direction"                data-endpoint="GETapi-campaings"
               value="consequatur"
               data-component="query">
    <br>
<p>Direction of the sorting 'asc'/'desc' Example: <code>consequatur</code></p>
            </div>
                </form>

                    <h2 id="campaigns-POSTapi-campaings">Store a newly created campaign in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-campaings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/campaings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Super awesome campaign\",
    \"team\": \"Power rangers\",
    \"mapId\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/campaings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Super awesome campaign",
    "team": "Power rangers",
    "mapId": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-campaings">
</span>
<span id="execution-results-POSTapi-campaings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-campaings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-campaings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-campaings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-campaings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-campaings" data-method="POST"
      data-path="api/campaings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-campaings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-campaings"
                    onclick="tryItOut('POSTapi-campaings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-campaings"
                    onclick="cancelTryOut('POSTapi-campaings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-campaings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/campaings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-campaings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-campaings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-campaings"
               value="Super awesome campaign"
               data-component="body">
    <br>
<p>The name of the campaign. Example: <code>Super awesome campaign</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>team</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="team"                data-endpoint="POSTapi-campaings"
               value="Power rangers"
               data-component="body">
    <br>
<p>The name of the team that will play on the campaign. Example: <code>Power rangers</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mapId</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="mapId"                data-endpoint="POSTapi-campaings"
               value="2"
               data-component="body">
    <br>
<p>The map in which the campaign will be played. The <code>id</code> of an existing record in the maps table. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="campaigns-GETapi-campaings--id-">Display the specified campaign.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-campaings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/campaings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/campaings/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-campaings--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Campaign].&quot;,
    &quot;code&quot;: &quot;UMP-0200-0000&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-campaings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-campaings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-campaings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-campaings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-campaings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-campaings--id-" data-method="GET"
      data-path="api/campaings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-campaings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-campaings--id-"
                    onclick="tryItOut('GETapi-campaings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-campaings--id-"
                    onclick="cancelTryOut('GETapi-campaings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-campaings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/campaings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-campaings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the campaing. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="campaigns-PUTapi-campaings--id-">Update the specified campaign in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-campaings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/campaings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Super awesome campaign\",
    \"team\": \"Power rangers\",
    \"mapId\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/campaings/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Super awesome campaign",
    "team": "Power rangers",
    "mapId": 2
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-campaings--id-">
</span>
<span id="execution-results-PUTapi-campaings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-campaings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-campaings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-campaings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-campaings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-campaings--id-" data-method="PUT"
      data-path="api/campaings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-campaings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-campaings--id-"
                    onclick="tryItOut('PUTapi-campaings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-campaings--id-"
                    onclick="cancelTryOut('PUTapi-campaings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-campaings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/campaings/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/campaings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-campaings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the campaing. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-campaings--id-"
               value="Super awesome campaign"
               data-component="body">
    <br>
<p>The name of the campaign. Example: <code>Super awesome campaign</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>team</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="team"                data-endpoint="PUTapi-campaings--id-"
               value="Power rangers"
               data-component="body">
    <br>
<p>The name of the team that will play on the campaign. Example: <code>Power rangers</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mapId</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="mapId"                data-endpoint="PUTapi-campaings--id-"
               value="2"
               data-component="body">
    <br>
<p>The map in which the campaign will be played. The <code>id</code> of an existing record in the maps table. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="campaigns-DELETEapi-campaings--id-">Remove the specified campaign from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-campaings--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/campaings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/campaings/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-campaings--id-">
</span>
<span id="execution-results-DELETEapi-campaings--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-campaings--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-campaings--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-campaings--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-campaings--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-campaings--id-" data-method="DELETE"
      data-path="api/campaings/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-campaings--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-campaings--id-"
                    onclick="tryItOut('DELETEapi-campaings--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-campaings--id-"
                    onclick="cancelTryOut('DELETEapi-campaings--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-campaings--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/campaings/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-campaings--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-campaings--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the campaing. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="equipments">Equipments</h1>

    <p>Endpoints for managing hunters</p>

                                <h2 id="equipments-GETapi-hunters">Display a listing of the hunters.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-hunters">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/hunters" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/hunters"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hunters">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;metadata&quot;: [],
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;playerName&quot;: &quot;Otis Botsford&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 1,
            &quot;helmet&quot;: 85,
            &quot;vest&quot;: 158,
            &quot;trousers&quot;: 128,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Feil-Hansen&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Proactive executive data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;playerName&quot;: &quot;Yesenia Sanford&quot;,
            &quot;hunterName&quot;: &quot;quisquam&quot;,
            &quot;campaignId&quot;: 1,
            &quot;helmet&quot;: 135,
            &quot;vest&quot;: 105,
            &quot;trousers&quot;: 182,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Feil-Hansen&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Proactive executive data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;playerName&quot;: &quot;Dr. Zachary Wuckert MD&quot;,
            &quot;hunterName&quot;: &quot;natus&quot;,
            &quot;campaignId&quot;: 1,
            &quot;helmet&quot;: 13,
            &quot;vest&quot;: 15,
            &quot;trousers&quot;: 49,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Feil-Hansen&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Proactive executive data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;playerName&quot;: &quot;Mr. Jayson Kautzer&quot;,
            &quot;hunterName&quot;: &quot;voluptate&quot;,
            &quot;campaignId&quot;: 2,
            &quot;helmet&quot;: 118,
            &quot;vest&quot;: 22,
            &quot;trousers&quot;: 81,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Ernser and Sons&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Re-engineered asynchronous service-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;playerName&quot;: &quot;Hunter Block Jr.&quot;,
            &quot;hunterName&quot;: &quot;ratione&quot;,
            &quot;campaignId&quot;: 2,
            &quot;helmet&quot;: 148,
            &quot;vest&quot;: 1,
            &quot;trousers&quot;: 153,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Ernser and Sons&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Re-engineered asynchronous service-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;playerName&quot;: &quot;Naomi Hahn&quot;,
            &quot;hunterName&quot;: &quot;occaecati&quot;,
            &quot;campaignId&quot;: 2,
            &quot;helmet&quot;: 88,
            &quot;vest&quot;: 158,
            &quot;trousers&quot;: 16,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Ernser and Sons&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Re-engineered asynchronous service-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;playerName&quot;: &quot;Ezequiel Daniel&quot;,
            &quot;hunterName&quot;: &quot;autem&quot;,
            &quot;campaignId&quot;: 2,
            &quot;helmet&quot;: 152,
            &quot;vest&quot;: 197,
            &quot;trousers&quot;: 113,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Ernser and Sons&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Re-engineered asynchronous service-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;playerName&quot;: &quot;Michelle VonRueden Jr.&quot;,
            &quot;hunterName&quot;: &quot;neque&quot;,
            &quot;campaignId&quot;: 3,
            &quot;helmet&quot;: 40,
            &quot;vest&quot;: 101,
            &quot;trousers&quot;: 179,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Weber-Johns&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Secured homogeneous knowledgeuser&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;playerName&quot;: &quot;Liana Gerhold&quot;,
            &quot;hunterName&quot;: &quot;asperiores&quot;,
            &quot;campaignId&quot;: 3,
            &quot;helmet&quot;: 132,
            &quot;vest&quot;: 154,
            &quot;trousers&quot;: 107,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Weber-Johns&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Secured homogeneous knowledgeuser&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;playerName&quot;: &quot;Mrs. Marisol Beer PhD&quot;,
            &quot;hunterName&quot;: &quot;molestiae&quot;,
            &quot;campaignId&quot;: 3,
            &quot;helmet&quot;: 89,
            &quot;vest&quot;: 64,
            &quot;trousers&quot;: 170,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Weber-Johns&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Secured homogeneous knowledgeuser&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 11,
            &quot;playerName&quot;: &quot;Cyril Beahan III&quot;,
            &quot;hunterName&quot;: &quot;ad&quot;,
            &quot;campaignId&quot;: 4,
            &quot;helmet&quot;: 126,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 11,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Wyman-Walker&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Exclusive uniform toolset&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 12,
            &quot;playerName&quot;: &quot;Mr. Adan Okuneva&quot;,
            &quot;hunterName&quot;: &quot;mollitia&quot;,
            &quot;campaignId&quot;: 5,
            &quot;helmet&quot;: 152,
            &quot;vest&quot;: 104,
            &quot;trousers&quot;: 21,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Auer, Beier and Hermiston&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Programmable radical throughput&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 13,
            &quot;playerName&quot;: &quot;Dr. Sonny Ritchie PhD&quot;,
            &quot;hunterName&quot;: &quot;ex&quot;,
            &quot;campaignId&quot;: 5,
            &quot;helmet&quot;: 111,
            &quot;vest&quot;: 35,
            &quot;trousers&quot;: 172,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Auer, Beier and Hermiston&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Programmable radical throughput&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 14,
            &quot;playerName&quot;: &quot;Francesca Klein IV&quot;,
            &quot;hunterName&quot;: &quot;enim&quot;,
            &quot;campaignId&quot;: 5,
            &quot;helmet&quot;: 126,
            &quot;vest&quot;: 41,
            &quot;trousers&quot;: 6,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Auer, Beier and Hermiston&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Programmable radical throughput&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 15,
            &quot;playerName&quot;: &quot;Earlene Hayes&quot;,
            &quot;hunterName&quot;: &quot;odio&quot;,
            &quot;campaignId&quot;: 5,
            &quot;helmet&quot;: 163,
            &quot;vest&quot;: 34,
            &quot;trousers&quot;: 9,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Auer, Beier and Hermiston&quot;,
                &quot;mapId&quot;: 1,
                &quot;teamName&quot;: &quot;Programmable radical throughput&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 16,
            &quot;playerName&quot;: &quot;Prof. Jacklyn Huels&quot;,
            &quot;hunterName&quot;: &quot;iure&quot;,
            &quot;campaignId&quot;: 6,
            &quot;helmet&quot;: 19,
            &quot;vest&quot;: 196,
            &quot;trousers&quot;: 185,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Emard-Stoltenberg&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Public-key static artificialintelligence&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 17,
            &quot;playerName&quot;: &quot;Adriel Cole PhD&quot;,
            &quot;hunterName&quot;: &quot;placeat&quot;,
            &quot;campaignId&quot;: 6,
            &quot;helmet&quot;: 111,
            &quot;vest&quot;: 158,
            &quot;trousers&quot;: 113,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 6,
                &quot;name&quot;: &quot;Emard-Stoltenberg&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Public-key static artificialintelligence&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 18,
            &quot;playerName&quot;: &quot;Leo Nikolaus&quot;,
            &quot;hunterName&quot;: &quot;amet&quot;,
            &quot;campaignId&quot;: 7,
            &quot;helmet&quot;: 30,
            &quot;vest&quot;: 98,
            &quot;trousers&quot;: 36,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 7,
                &quot;name&quot;: &quot;Jast Inc&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Extended holistic leverage&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 19,
            &quot;playerName&quot;: &quot;Woodrow Zieme I&quot;,
            &quot;hunterName&quot;: &quot;voluptatem&quot;,
            &quot;campaignId&quot;: 8,
            &quot;helmet&quot;: 132,
            &quot;vest&quot;: 90,
            &quot;trousers&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Braun, Simonis and Paucek&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Operative disintermediate adapter&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 20,
            &quot;playerName&quot;: &quot;Miss Dessie Metz DDS&quot;,
            &quot;hunterName&quot;: &quot;tenetur&quot;,
            &quot;campaignId&quot;: 8,
            &quot;helmet&quot;: 89,
            &quot;vest&quot;: 114,
            &quot;trousers&quot;: 17,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Braun, Simonis and Paucek&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Operative disintermediate adapter&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 21,
            &quot;playerName&quot;: &quot;Raymond Kuphal&quot;,
            &quot;hunterName&quot;: &quot;debitis&quot;,
            &quot;campaignId&quot;: 9,
            &quot;helmet&quot;: 30,
            &quot;vest&quot;: 95,
            &quot;trousers&quot;: 93,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 9,
                &quot;name&quot;: &quot;Becker, Olson and Fadel&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Persevering bottom-line product&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 22,
            &quot;playerName&quot;: &quot;Talon McClure&quot;,
            &quot;hunterName&quot;: &quot;eum&quot;,
            &quot;campaignId&quot;: 10,
            &quot;helmet&quot;: 78,
            &quot;vest&quot;: 29,
            &quot;trousers&quot;: 65,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Prosacco and Sons&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Managed optimizing pricingstructure&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 23,
            &quot;playerName&quot;: &quot;Nels Luettgen II&quot;,
            &quot;hunterName&quot;: &quot;animi&quot;,
            &quot;campaignId&quot;: 10,
            &quot;helmet&quot;: 68,
            &quot;vest&quot;: 159,
            &quot;trousers&quot;: 86,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 10,
                &quot;name&quot;: &quot;Prosacco and Sons&quot;,
                &quot;mapId&quot;: 2,
                &quot;teamName&quot;: &quot;Managed optimizing pricingstructure&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 24,
            &quot;playerName&quot;: &quot;Alayna Kessler&quot;,
            &quot;hunterName&quot;: &quot;omnis&quot;,
            &quot;campaignId&quot;: 11,
            &quot;helmet&quot;: 116,
            &quot;vest&quot;: 193,
            &quot;trousers&quot;: 108,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;Kozey-Little&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Reverse-engineered mobile strategy&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 25,
            &quot;playerName&quot;: &quot;Dr. Solon Hand III&quot;,
            &quot;hunterName&quot;: &quot;nam&quot;,
            &quot;campaignId&quot;: 11,
            &quot;helmet&quot;: 45,
            &quot;vest&quot;: 189,
            &quot;trousers&quot;: 7,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;Kozey-Little&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Reverse-engineered mobile strategy&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 26,
            &quot;playerName&quot;: &quot;Maryam Raynor&quot;,
            &quot;hunterName&quot;: &quot;velit&quot;,
            &quot;campaignId&quot;: 11,
            &quot;helmet&quot;: 57,
            &quot;vest&quot;: 12,
            &quot;trousers&quot;: 134,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;Kozey-Little&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Reverse-engineered mobile strategy&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 27,
            &quot;playerName&quot;: &quot;Narciso DuBuque&quot;,
            &quot;hunterName&quot;: &quot;dignissimos&quot;,
            &quot;campaignId&quot;: 11,
            &quot;helmet&quot;: 109,
            &quot;vest&quot;: 12,
            &quot;trousers&quot;: 192,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;Kozey-Little&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Reverse-engineered mobile strategy&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 28,
            &quot;playerName&quot;: &quot;Brock Tremblay&quot;,
            &quot;hunterName&quot;: &quot;nam&quot;,
            &quot;campaignId&quot;: 12,
            &quot;helmet&quot;: 40,
            &quot;vest&quot;: 24,
            &quot;trousers&quot;: 81,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 12,
                &quot;name&quot;: &quot;Fritsch, Schulist and Bode&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Expanded zerodefect installation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 29,
            &quot;playerName&quot;: &quot;Tremayne Hirthe&quot;,
            &quot;hunterName&quot;: &quot;quas&quot;,
            &quot;campaignId&quot;: 12,
            &quot;helmet&quot;: 37,
            &quot;vest&quot;: 79,
            &quot;trousers&quot;: 63,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 12,
                &quot;name&quot;: &quot;Fritsch, Schulist and Bode&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Expanded zerodefect installation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 30,
            &quot;playerName&quot;: &quot;Talia Ebert&quot;,
            &quot;hunterName&quot;: &quot;maxime&quot;,
            &quot;campaignId&quot;: 13,
            &quot;helmet&quot;: 136,
            &quot;vest&quot;: 95,
            &quot;trousers&quot;: 179,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 13,
                &quot;name&quot;: &quot;Flatley, Johnson and Bogan&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Re-contextualized context-sensitive software&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 31,
            &quot;playerName&quot;: &quot;Dr. Tyshawn Crist&quot;,
            &quot;hunterName&quot;: &quot;enim&quot;,
            &quot;campaignId&quot;: 13,
            &quot;helmet&quot;: 47,
            &quot;vest&quot;: 133,
            &quot;trousers&quot;: 52,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 13,
                &quot;name&quot;: &quot;Flatley, Johnson and Bogan&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Re-contextualized context-sensitive software&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 32,
            &quot;playerName&quot;: &quot;Prof. Adelia Berge&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 13,
            &quot;helmet&quot;: 45,
            &quot;vest&quot;: 91,
            &quot;trousers&quot;: 160,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 13,
                &quot;name&quot;: &quot;Flatley, Johnson and Bogan&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Re-contextualized context-sensitive software&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 33,
            &quot;playerName&quot;: &quot;Belle Lynch Sr.&quot;,
            &quot;hunterName&quot;: &quot;aut&quot;,
            &quot;campaignId&quot;: 13,
            &quot;helmet&quot;: 118,
            &quot;vest&quot;: 178,
            &quot;trousers&quot;: 60,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 13,
                &quot;name&quot;: &quot;Flatley, Johnson and Bogan&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Re-contextualized context-sensitive software&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 34,
            &quot;playerName&quot;: &quot;Jenifer Turner&quot;,
            &quot;hunterName&quot;: &quot;unde&quot;,
            &quot;campaignId&quot;: 14,
            &quot;helmet&quot;: 40,
            &quot;vest&quot;: 164,
            &quot;trousers&quot;: 81,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 14,
                &quot;name&quot;: &quot;Mayer-Mann&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Centralized web-enabled GraphicInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 35,
            &quot;playerName&quot;: &quot;Ned Upton&quot;,
            &quot;hunterName&quot;: &quot;rem&quot;,
            &quot;campaignId&quot;: 14,
            &quot;helmet&quot;: 47,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 125,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 14,
                &quot;name&quot;: &quot;Mayer-Mann&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Centralized web-enabled GraphicInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 36,
            &quot;playerName&quot;: &quot;Kailey Streich IV&quot;,
            &quot;hunterName&quot;: &quot;velit&quot;,
            &quot;campaignId&quot;: 14,
            &quot;helmet&quot;: 163,
            &quot;vest&quot;: 102,
            &quot;trousers&quot;: 43,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 14,
                &quot;name&quot;: &quot;Mayer-Mann&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Centralized web-enabled GraphicInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 37,
            &quot;playerName&quot;: &quot;Dr. Cristal Abernathy&quot;,
            &quot;hunterName&quot;: &quot;soluta&quot;,
            &quot;campaignId&quot;: 15,
            &quot;helmet&quot;: 47,
            &quot;vest&quot;: 12,
            &quot;trousers&quot;: 72,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 15,
                &quot;name&quot;: &quot;Nicolas-Witting&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Operative asynchronous functionalities&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 38,
            &quot;playerName&quot;: &quot;Dr. Ariel Aufderhar&quot;,
            &quot;hunterName&quot;: &quot;nulla&quot;,
            &quot;campaignId&quot;: 15,
            &quot;helmet&quot;: 124,
            &quot;vest&quot;: 137,
            &quot;trousers&quot;: 33,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 15,
                &quot;name&quot;: &quot;Nicolas-Witting&quot;,
                &quot;mapId&quot;: 3,
                &quot;teamName&quot;: &quot;Operative asynchronous functionalities&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 39,
            &quot;playerName&quot;: &quot;Merritt Luettgen&quot;,
            &quot;hunterName&quot;: &quot;expedita&quot;,
            &quot;campaignId&quot;: 16,
            &quot;helmet&quot;: 32,
            &quot;vest&quot;: 158,
            &quot;trousers&quot;: 86,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 16,
                &quot;name&quot;: &quot;Graham, Runolfsdottir and Hodkiewicz&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Centralized systemic archive&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 40,
            &quot;playerName&quot;: &quot;Elyssa Howell&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 17,
            &quot;helmet&quot;: 138,
            &quot;vest&quot;: 195,
            &quot;trousers&quot;: 8,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 17,
                &quot;name&quot;: &quot;McKenzie-Pacocha&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Exclusive 4thgeneration data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 41,
            &quot;playerName&quot;: &quot;Noemie Schmitt V&quot;,
            &quot;hunterName&quot;: &quot;commodi&quot;,
            &quot;campaignId&quot;: 17,
            &quot;helmet&quot;: 78,
            &quot;vest&quot;: 48,
            &quot;trousers&quot;: 92,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 17,
                &quot;name&quot;: &quot;McKenzie-Pacocha&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Exclusive 4thgeneration data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 42,
            &quot;playerName&quot;: &quot;Prof. Ashley Toy DVM&quot;,
            &quot;hunterName&quot;: &quot;magnam&quot;,
            &quot;campaignId&quot;: 17,
            &quot;helmet&quot;: 163,
            &quot;vest&quot;: 1,
            &quot;trousers&quot;: 121,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 17,
                &quot;name&quot;: &quot;McKenzie-Pacocha&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Exclusive 4thgeneration data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 43,
            &quot;playerName&quot;: &quot;Darion Boyle Jr.&quot;,
            &quot;hunterName&quot;: &quot;velit&quot;,
            &quot;campaignId&quot;: 18,
            &quot;helmet&quot;: 54,
            &quot;vest&quot;: 123,
            &quot;trousers&quot;: 134,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Marquardt LLC&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Public-key multimedia success&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 44,
            &quot;playerName&quot;: &quot;Louvenia Cremin&quot;,
            &quot;hunterName&quot;: &quot;iure&quot;,
            &quot;campaignId&quot;: 18,
            &quot;helmet&quot;: 13,
            &quot;vest&quot;: 122,
            &quot;trousers&quot;: 86,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Marquardt LLC&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Public-key multimedia success&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 45,
            &quot;playerName&quot;: &quot;Dock Jacobs&quot;,
            &quot;hunterName&quot;: &quot;est&quot;,
            &quot;campaignId&quot;: 18,
            &quot;helmet&quot;: 155,
            &quot;vest&quot;: 97,
            &quot;trousers&quot;: 185,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Marquardt LLC&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Public-key multimedia success&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 46,
            &quot;playerName&quot;: &quot;Modesto Murray&quot;,
            &quot;hunterName&quot;: &quot;qui&quot;,
            &quot;campaignId&quot;: 18,
            &quot;helmet&quot;: 94,
            &quot;vest&quot;: 165,
            &quot;trousers&quot;: 62,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 18,
                &quot;name&quot;: &quot;Marquardt LLC&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Public-key multimedia success&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 47,
            &quot;playerName&quot;: &quot;Mr. Ole Rath PhD&quot;,
            &quot;hunterName&quot;: &quot;dolor&quot;,
            &quot;campaignId&quot;: 19,
            &quot;helmet&quot;: 183,
            &quot;vest&quot;: 10,
            &quot;trousers&quot;: 33,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Hand, McCullough and Carter&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Down-sized multi-state encryption&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 48,
            &quot;playerName&quot;: &quot;Eryn Connelly&quot;,
            &quot;hunterName&quot;: &quot;nisi&quot;,
            &quot;campaignId&quot;: 19,
            &quot;helmet&quot;: 118,
            &quot;vest&quot;: 114,
            &quot;trousers&quot;: 36,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 19,
                &quot;name&quot;: &quot;Hand, McCullough and Carter&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Down-sized multi-state encryption&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 49,
            &quot;playerName&quot;: &quot;Mr. Tre Morissette&quot;,
            &quot;hunterName&quot;: &quot;non&quot;,
            &quot;campaignId&quot;: 20,
            &quot;helmet&quot;: 163,
            &quot;vest&quot;: 139,
            &quot;trousers&quot;: 93,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Bashirian-Mosciski&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Centralized analyzing alliance&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 50,
            &quot;playerName&quot;: &quot;Willie McKenzie&quot;,
            &quot;hunterName&quot;: &quot;aperiam&quot;,
            &quot;campaignId&quot;: 20,
            &quot;helmet&quot;: 191,
            &quot;vest&quot;: 195,
            &quot;trousers&quot;: 86,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Bashirian-Mosciski&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Centralized analyzing alliance&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 51,
            &quot;playerName&quot;: &quot;Ramiro Huel&quot;,
            &quot;hunterName&quot;: &quot;ut&quot;,
            &quot;campaignId&quot;: 20,
            &quot;helmet&quot;: 130,
            &quot;vest&quot;: 101,
            &quot;trousers&quot;: 72,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Bashirian-Mosciski&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Centralized analyzing alliance&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 52,
            &quot;playerName&quot;: &quot;Myriam Welch&quot;,
            &quot;hunterName&quot;: &quot;facilis&quot;,
            &quot;campaignId&quot;: 20,
            &quot;helmet&quot;: 120,
            &quot;vest&quot;: 200,
            &quot;trousers&quot;: 49,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 20,
                &quot;name&quot;: &quot;Bashirian-Mosciski&quot;,
                &quot;mapId&quot;: 4,
                &quot;teamName&quot;: &quot;Centralized analyzing alliance&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 53,
            &quot;playerName&quot;: &quot;Warren Schultz Sr.&quot;,
            &quot;hunterName&quot;: &quot;doloremque&quot;,
            &quot;campaignId&quot;: 21,
            &quot;helmet&quot;: 116,
            &quot;vest&quot;: 195,
            &quot;trousers&quot;: 171,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Schuppe Ltd&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Seamless asynchronous frame&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 54,
            &quot;playerName&quot;: &quot;Prof. Harmony Hudson IV&quot;,
            &quot;hunterName&quot;: &quot;odit&quot;,
            &quot;campaignId&quot;: 21,
            &quot;helmet&quot;: 135,
            &quot;vest&quot;: 48,
            &quot;trousers&quot;: 17,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Schuppe Ltd&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Seamless asynchronous frame&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 55,
            &quot;playerName&quot;: &quot;Madge Pagac&quot;,
            &quot;hunterName&quot;: &quot;rerum&quot;,
            &quot;campaignId&quot;: 21,
            &quot;helmet&quot;: 28,
            &quot;vest&quot;: 35,
            &quot;trousers&quot;: 25,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 21,
                &quot;name&quot;: &quot;Schuppe Ltd&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Seamless asynchronous frame&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 56,
            &quot;playerName&quot;: &quot;Davin Yost&quot;,
            &quot;hunterName&quot;: &quot;doloremque&quot;,
            &quot;campaignId&quot;: 22,
            &quot;helmet&quot;: 19,
            &quot;vest&quot;: 196,
            &quot;trousers&quot;: 92,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 22,
                &quot;name&quot;: &quot;Labadie, Block and Parker&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Visionary hybrid emulation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 57,
            &quot;playerName&quot;: &quot;Miss Marjory VonRueden Jr.&quot;,
            &quot;hunterName&quot;: &quot;nostrum&quot;,
            &quot;campaignId&quot;: 22,
            &quot;helmet&quot;: 28,
            &quot;vest&quot;: 1,
            &quot;trousers&quot;: 43,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 22,
                &quot;name&quot;: &quot;Labadie, Block and Parker&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Visionary hybrid emulation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 58,
            &quot;playerName&quot;: &quot;Dr. Alyson Schimmel III&quot;,
            &quot;hunterName&quot;: &quot;non&quot;,
            &quot;campaignId&quot;: 22,
            &quot;helmet&quot;: 167,
            &quot;vest&quot;: 101,
            &quot;trousers&quot;: 93,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 22,
                &quot;name&quot;: &quot;Labadie, Block and Parker&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Visionary hybrid emulation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 59,
            &quot;playerName&quot;: &quot;Cassandra Stracke&quot;,
            &quot;hunterName&quot;: &quot;labore&quot;,
            &quot;campaignId&quot;: 23,
            &quot;helmet&quot;: 28,
            &quot;vest&quot;: 76,
            &quot;trousers&quot;: 168,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 23,
                &quot;name&quot;: &quot;Emard Group&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Vision-oriented heuristic knowledgebase&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 60,
            &quot;playerName&quot;: &quot;Jay Kirlin&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 24,
            &quot;helmet&quot;: 180,
            &quot;vest&quot;: 95,
            &quot;trousers&quot;: 26,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 24,
                &quot;name&quot;: &quot;Schuppe, Schaefer and Hettinger&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Cross-platform human-resource contingency&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 61,
            &quot;playerName&quot;: &quot;Alexzander Dare&quot;,
            &quot;hunterName&quot;: &quot;iure&quot;,
            &quot;campaignId&quot;: 25,
            &quot;helmet&quot;: 71,
            &quot;vest&quot;: 87,
            &quot;trousers&quot;: 16,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 25,
                &quot;name&quot;: &quot;Willms, Ledner and Torphy&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Operative impactful help-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 62,
            &quot;playerName&quot;: &quot;Felix Wunsch&quot;,
            &quot;hunterName&quot;: &quot;dolores&quot;,
            &quot;campaignId&quot;: 25,
            &quot;helmet&quot;: 161,
            &quot;vest&quot;: 98,
            &quot;trousers&quot;: 172,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 25,
                &quot;name&quot;: &quot;Willms, Ledner and Torphy&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Operative impactful help-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 63,
            &quot;playerName&quot;: &quot;Dr. Amie Sauer&quot;,
            &quot;hunterName&quot;: &quot;libero&quot;,
            &quot;campaignId&quot;: 25,
            &quot;helmet&quot;: 20,
            &quot;vest&quot;: 15,
            &quot;trousers&quot;: 121,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 25,
                &quot;name&quot;: &quot;Willms, Ledner and Torphy&quot;,
                &quot;mapId&quot;: 5,
                &quot;teamName&quot;: &quot;Operative impactful help-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 64,
            &quot;playerName&quot;: &quot;Dallas Yost&quot;,
            &quot;hunterName&quot;: &quot;ut&quot;,
            &quot;campaignId&quot;: 26,
            &quot;helmet&quot;: 96,
            &quot;vest&quot;: 196,
            &quot;trousers&quot;: 179,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 26,
                &quot;name&quot;: &quot;Hansen, Osinski and Glover&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable radical openarchitecture&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 65,
            &quot;playerName&quot;: &quot;Rahsaan White&quot;,
            &quot;hunterName&quot;: &quot;rem&quot;,
            &quot;campaignId&quot;: 26,
            &quot;helmet&quot;: 28,
            &quot;vest&quot;: 137,
            &quot;trousers&quot;: 82,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 26,
                &quot;name&quot;: &quot;Hansen, Osinski and Glover&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable radical openarchitecture&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 66,
            &quot;playerName&quot;: &quot;Camilla Nicolas&quot;,
            &quot;hunterName&quot;: &quot;alias&quot;,
            &quot;campaignId&quot;: 26,
            &quot;helmet&quot;: 136,
            &quot;vest&quot;: 181,
            &quot;trousers&quot;: 169,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 26,
                &quot;name&quot;: &quot;Hansen, Osinski and Glover&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable radical openarchitecture&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 67,
            &quot;playerName&quot;: &quot;Gladys Hane&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 26,
            &quot;helmet&quot;: 4,
            &quot;vest&quot;: 34,
            &quot;trousers&quot;: 39,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 26,
                &quot;name&quot;: &quot;Hansen, Osinski and Glover&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable radical openarchitecture&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 68,
            &quot;playerName&quot;: &quot;Cecelia Champlin&quot;,
            &quot;hunterName&quot;: &quot;totam&quot;,
            &quot;campaignId&quot;: 27,
            &quot;helmet&quot;: 54,
            &quot;vest&quot;: 58,
            &quot;trousers&quot;: 192,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 27,
                &quot;name&quot;: &quot;Daugherty-Stoltenberg&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable static help-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 69,
            &quot;playerName&quot;: &quot;Ms. Catharine Hyatt&quot;,
            &quot;hunterName&quot;: &quot;qui&quot;,
            &quot;campaignId&quot;: 27,
            &quot;helmet&quot;: 148,
            &quot;vest&quot;: 91,
            &quot;trousers&quot;: 125,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 27,
                &quot;name&quot;: &quot;Daugherty-Stoltenberg&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Switchable static help-desk&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 70,
            &quot;playerName&quot;: &quot;Darrick Klocko&quot;,
            &quot;hunterName&quot;: &quot;reiciendis&quot;,
            &quot;campaignId&quot;: 28,
            &quot;helmet&quot;: 47,
            &quot;vest&quot;: 122,
            &quot;trousers&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 28,
                &quot;name&quot;: &quot;Marquardt, Keebler and Schowalter&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Balanced real-time GraphicInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 71,
            &quot;playerName&quot;: &quot;Dante Wiegand&quot;,
            &quot;hunterName&quot;: &quot;cupiditate&quot;,
            &quot;campaignId&quot;: 29,
            &quot;helmet&quot;: 199,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 25,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 29,
                &quot;name&quot;: &quot;Wiza, Schuppe and Murphy&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Re-engineered context-sensitive core&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 72,
            &quot;playerName&quot;: &quot;Raul Huel Jr.&quot;,
            &quot;hunterName&quot;: &quot;tempora&quot;,
            &quot;campaignId&quot;: 29,
            &quot;helmet&quot;: 126,
            &quot;vest&quot;: 189,
            &quot;trousers&quot;: 125,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 29,
                &quot;name&quot;: &quot;Wiza, Schuppe and Murphy&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Re-engineered context-sensitive core&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 73,
            &quot;playerName&quot;: &quot;Mr. Hunter Upton III&quot;,
            &quot;hunterName&quot;: &quot;sed&quot;,
            &quot;campaignId&quot;: 29,
            &quot;helmet&quot;: 71,
            &quot;vest&quot;: 114,
            &quot;trousers&quot;: 50,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 29,
                &quot;name&quot;: &quot;Wiza, Schuppe and Murphy&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Re-engineered context-sensitive core&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 74,
            &quot;playerName&quot;: &quot;Dr. Kadin Braun&quot;,
            &quot;hunterName&quot;: &quot;eum&quot;,
            &quot;campaignId&quot;: 30,
            &quot;helmet&quot;: 138,
            &quot;vest&quot;: 158,
            &quot;trousers&quot;: 185,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 30,
                &quot;name&quot;: &quot;Oberbrunner-Mayert&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Facetoface transitional array&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 75,
            &quot;playerName&quot;: &quot;Garfield Grant IV&quot;,
            &quot;hunterName&quot;: &quot;architecto&quot;,
            &quot;campaignId&quot;: 30,
            &quot;helmet&quot;: 111,
            &quot;vest&quot;: 105,
            &quot;trousers&quot;: 56,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 30,
                &quot;name&quot;: &quot;Oberbrunner-Mayert&quot;,
                &quot;mapId&quot;: 6,
                &quot;teamName&quot;: &quot;Facetoface transitional array&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 76,
            &quot;playerName&quot;: &quot;Sabryna Daniel Sr.&quot;,
            &quot;hunterName&quot;: &quot;non&quot;,
            &quot;campaignId&quot;: 31,
            &quot;helmet&quot;: 42,
            &quot;vest&quot;: 41,
            &quot;trousers&quot;: 160,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 31,
                &quot;name&quot;: &quot;Casper LLC&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Virtual real-time throughput&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 77,
            &quot;playerName&quot;: &quot;Abigail Lockman&quot;,
            &quot;hunterName&quot;: &quot;sit&quot;,
            &quot;campaignId&quot;: 32,
            &quot;helmet&quot;: 71,
            &quot;vest&quot;: 12,
            &quot;trousers&quot;: 108,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 32,
                &quot;name&quot;: &quot;Denesik, Reinger and Ledner&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Business-focused background access&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 78,
            &quot;playerName&quot;: &quot;Ms. Suzanne Feeney&quot;,
            &quot;hunterName&quot;: &quot;perferendis&quot;,
            &quot;campaignId&quot;: 32,
            &quot;helmet&quot;: 20,
            &quot;vest&quot;: 112,
            &quot;trousers&quot;: 60,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 32,
                &quot;name&quot;: &quot;Denesik, Reinger and Ledner&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Business-focused background access&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 79,
            &quot;playerName&quot;: &quot;Marian Cummings&quot;,
            &quot;hunterName&quot;: &quot;excepturi&quot;,
            &quot;campaignId&quot;: 32,
            &quot;helmet&quot;: 80,
            &quot;vest&quot;: 10,
            &quot;trousers&quot;: 50,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 32,
                &quot;name&quot;: &quot;Denesik, Reinger and Ledner&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Business-focused background access&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 80,
            &quot;playerName&quot;: &quot;Prof. Victoria Lubowitz&quot;,
            &quot;hunterName&quot;: &quot;fugiat&quot;,
            &quot;campaignId&quot;: 32,
            &quot;helmet&quot;: 111,
            &quot;vest&quot;: 189,
            &quot;trousers&quot;: 25,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 32,
                &quot;name&quot;: &quot;Denesik, Reinger and Ledner&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Business-focused background access&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 81,
            &quot;playerName&quot;: &quot;Sherman Oberbrunner II&quot;,
            &quot;hunterName&quot;: &quot;sit&quot;,
            &quot;campaignId&quot;: 33,
            &quot;helmet&quot;: 163,
            &quot;vest&quot;: 10,
            &quot;trousers&quot;: 171,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 33,
                &quot;name&quot;: &quot;Koch-Funk&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Polarised foreground hierarchy&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 82,
            &quot;playerName&quot;: &quot;Prof. Tiara Huel&quot;,
            &quot;hunterName&quot;: &quot;voluptas&quot;,
            &quot;campaignId&quot;: 34,
            &quot;helmet&quot;: 136,
            &quot;vest&quot;: 29,
            &quot;trousers&quot;: 171,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 34,
                &quot;name&quot;: &quot;Gottlieb and Sons&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Multi-lateral cohesive migration&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 83,
            &quot;playerName&quot;: &quot;Alejandra Okuneva&quot;,
            &quot;hunterName&quot;: &quot;aut&quot;,
            &quot;campaignId&quot;: 34,
            &quot;helmet&quot;: 4,
            &quot;vest&quot;: 87,
            &quot;trousers&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 34,
                &quot;name&quot;: &quot;Gottlieb and Sons&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Multi-lateral cohesive migration&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 84,
            &quot;playerName&quot;: &quot;Prof. Lavern Padberg&quot;,
            &quot;hunterName&quot;: &quot;sunt&quot;,
            &quot;campaignId&quot;: 35,
            &quot;helmet&quot;: 151,
            &quot;vest&quot;: 35,
            &quot;trousers&quot;: 146,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 35,
                &quot;name&quot;: &quot;Ledner-Hegmann&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Extended stable capacity&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 85,
            &quot;playerName&quot;: &quot;Mr. Brennon Wisoky&quot;,
            &quot;hunterName&quot;: &quot;fugiat&quot;,
            &quot;campaignId&quot;: 35,
            &quot;helmet&quot;: 67,
            &quot;vest&quot;: 184,
            &quot;trousers&quot;: 38,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 35,
                &quot;name&quot;: &quot;Ledner-Hegmann&quot;,
                &quot;mapId&quot;: 7,
                &quot;teamName&quot;: &quot;Extended stable capacity&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 86,
            &quot;playerName&quot;: &quot;Bryon Mueller&quot;,
            &quot;hunterName&quot;: &quot;dicta&quot;,
            &quot;campaignId&quot;: 36,
            &quot;helmet&quot;: 152,
            &quot;vest&quot;: 181,
            &quot;trousers&quot;: 7,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 36,
                &quot;name&quot;: &quot;Becker-Monahan&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Focused cohesive protocol&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 87,
            &quot;playerName&quot;: &quot;Jaquan Parisian&quot;,
            &quot;hunterName&quot;: &quot;blanditiis&quot;,
            &quot;campaignId&quot;: 36,
            &quot;helmet&quot;: 166,
            &quot;vest&quot;: 99,
            &quot;trousers&quot;: 113,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 36,
                &quot;name&quot;: &quot;Becker-Monahan&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Focused cohesive protocol&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 88,
            &quot;playerName&quot;: &quot;Laila Rodriguez&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 36,
            &quot;helmet&quot;: 20,
            &quot;vest&quot;: 34,
            &quot;trousers&quot;: 6,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 36,
                &quot;name&quot;: &quot;Becker-Monahan&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Focused cohesive protocol&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 89,
            &quot;playerName&quot;: &quot;Vincenza Hagenes&quot;,
            &quot;hunterName&quot;: &quot;necessitatibus&quot;,
            &quot;campaignId&quot;: 36,
            &quot;helmet&quot;: 30,
            &quot;vest&quot;: 48,
            &quot;trousers&quot;: 182,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 36,
                &quot;name&quot;: &quot;Becker-Monahan&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Focused cohesive protocol&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 90,
            &quot;playerName&quot;: &quot;Mr. Ervin Lubowitz&quot;,
            &quot;hunterName&quot;: &quot;eum&quot;,
            &quot;campaignId&quot;: 37,
            &quot;helmet&quot;: 180,
            &quot;vest&quot;: 22,
            &quot;trousers&quot;: 127,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 37,
                &quot;name&quot;: &quot;Yost-Braun&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Expanded solution-oriented encoding&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 91,
            &quot;playerName&quot;: &quot;Hollie Lehner PhD&quot;,
            &quot;hunterName&quot;: &quot;necessitatibus&quot;,
            &quot;campaignId&quot;: 37,
            &quot;helmet&quot;: 37,
            &quot;vest&quot;: 188,
            &quot;trousers&quot;: 108,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 37,
                &quot;name&quot;: &quot;Yost-Braun&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Expanded solution-oriented encoding&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 92,
            &quot;playerName&quot;: &quot;Wiley Pacocha&quot;,
            &quot;hunterName&quot;: &quot;amet&quot;,
            &quot;campaignId&quot;: 37,
            &quot;helmet&quot;: 19,
            &quot;vest&quot;: 188,
            &quot;trousers&quot;: 115,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 37,
                &quot;name&quot;: &quot;Yost-Braun&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Expanded solution-oriented encoding&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 93,
            &quot;playerName&quot;: &quot;Luciano McClure Jr.&quot;,
            &quot;hunterName&quot;: &quot;odio&quot;,
            &quot;campaignId&quot;: 38,
            &quot;helmet&quot;: 138,
            &quot;vest&quot;: 149,
            &quot;trousers&quot;: 173,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 38,
                &quot;name&quot;: &quot;Wilkinson-Blanda&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organic modular firmware&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 94,
            &quot;playerName&quot;: &quot;Merle Von&quot;,
            &quot;hunterName&quot;: &quot;id&quot;,
            &quot;campaignId&quot;: 38,
            &quot;helmet&quot;: 19,
            &quot;vest&quot;: 48,
            &quot;trousers&quot;: 168,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 38,
                &quot;name&quot;: &quot;Wilkinson-Blanda&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organic modular firmware&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 95,
            &quot;playerName&quot;: &quot;Karelle Olson&quot;,
            &quot;hunterName&quot;: &quot;dolorem&quot;,
            &quot;campaignId&quot;: 38,
            &quot;helmet&quot;: 67,
            &quot;vest&quot;: 83,
            &quot;trousers&quot;: 153,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 38,
                &quot;name&quot;: &quot;Wilkinson-Blanda&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organic modular firmware&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 96,
            &quot;playerName&quot;: &quot;Jaylon Orn&quot;,
            &quot;hunterName&quot;: &quot;explicabo&quot;,
            &quot;campaignId&quot;: 38,
            &quot;helmet&quot;: 57,
            &quot;vest&quot;: 34,
            &quot;trousers&quot;: 23,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 38,
                &quot;name&quot;: &quot;Wilkinson-Blanda&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organic modular firmware&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 97,
            &quot;playerName&quot;: &quot;Mrs. Meda Bailey&quot;,
            &quot;hunterName&quot;: &quot;illum&quot;,
            &quot;campaignId&quot;: 39,
            &quot;helmet&quot;: 18,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 63,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 39,
                &quot;name&quot;: &quot;Witting, Spencer and Ortiz&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Programmable systematic methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 98,
            &quot;playerName&quot;: &quot;Florida Lesch&quot;,
            &quot;hunterName&quot;: &quot;occaecati&quot;,
            &quot;campaignId&quot;: 39,
            &quot;helmet&quot;: 85,
            &quot;vest&quot;: 66,
            &quot;trousers&quot;: 134,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:01.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 39,
                &quot;name&quot;: &quot;Witting, Spencer and Ortiz&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Programmable systematic methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 99,
            &quot;playerName&quot;: &quot;Cordie Kuphal&quot;,
            &quot;hunterName&quot;: &quot;sequi&quot;,
            &quot;campaignId&quot;: 39,
            &quot;helmet&quot;: 109,
            &quot;vest&quot;: 178,
            &quot;trousers&quot;: 119,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 39,
                &quot;name&quot;: &quot;Witting, Spencer and Ortiz&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Programmable systematic methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 100,
            &quot;playerName&quot;: &quot;Annamarie Turner&quot;,
            &quot;hunterName&quot;: &quot;sed&quot;,
            &quot;campaignId&quot;: 40,
            &quot;helmet&quot;: 67,
            &quot;vest&quot;: 64,
            &quot;trousers&quot;: 62,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 40,
                &quot;name&quot;: &quot;Konopelski, Mueller and Carter&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organized optimizing leverage&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 101,
            &quot;playerName&quot;: &quot;Olin Runolfsdottir&quot;,
            &quot;hunterName&quot;: &quot;beatae&quot;,
            &quot;campaignId&quot;: 40,
            &quot;helmet&quot;: 14,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 142,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 40,
                &quot;name&quot;: &quot;Konopelski, Mueller and Carter&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organized optimizing leverage&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 102,
            &quot;playerName&quot;: &quot;Gerard Beer IV&quot;,
            &quot;hunterName&quot;: &quot;dolores&quot;,
            &quot;campaignId&quot;: 40,
            &quot;helmet&quot;: 32,
            &quot;vest&quot;: 34,
            &quot;trousers&quot;: 157,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 40,
                &quot;name&quot;: &quot;Konopelski, Mueller and Carter&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organized optimizing leverage&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 103,
            &quot;playerName&quot;: &quot;Zion Homenick&quot;,
            &quot;hunterName&quot;: &quot;voluptas&quot;,
            &quot;campaignId&quot;: 40,
            &quot;helmet&quot;: 152,
            &quot;vest&quot;: 112,
            &quot;trousers&quot;: 38,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 40,
                &quot;name&quot;: &quot;Konopelski, Mueller and Carter&quot;,
                &quot;mapId&quot;: 8,
                &quot;teamName&quot;: &quot;Organized optimizing leverage&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 104,
            &quot;playerName&quot;: &quot;Maximo Nikolaus&quot;,
            &quot;hunterName&quot;: &quot;et&quot;,
            &quot;campaignId&quot;: 41,
            &quot;helmet&quot;: 69,
            &quot;vest&quot;: 149,
            &quot;trousers&quot;: 49,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 41,
                &quot;name&quot;: &quot;Daugherty, Marquardt and Spinka&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Pre-emptive leadingedge algorithm&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 105,
            &quot;playerName&quot;: &quot;Ms. Gisselle Wilkinson&quot;,
            &quot;hunterName&quot;: &quot;nostrum&quot;,
            &quot;campaignId&quot;: 42,
            &quot;helmet&quot;: 126,
            &quot;vest&quot;: 53,
            &quot;trousers&quot;: 157,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 42,
                &quot;name&quot;: &quot;Beatty, Little and Wisozk&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Enterprise-wide composite product&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 106,
            &quot;playerName&quot;: &quot;Prof. Theodore Quigley V&quot;,
            &quot;hunterName&quot;: &quot;dolorem&quot;,
            &quot;campaignId&quot;: 43,
            &quot;helmet&quot;: 177,
            &quot;vest&quot;: 139,
            &quot;trousers&quot;: 169,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 43,
                &quot;name&quot;: &quot;Heaney, Rice and Halvorson&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Up-sized attitude-oriented budgetarymanagement&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 107,
            &quot;playerName&quot;: &quot;Barney Wisozk&quot;,
            &quot;hunterName&quot;: &quot;ut&quot;,
            &quot;campaignId&quot;: 44,
            &quot;helmet&quot;: 40,
            &quot;vest&quot;: 133,
            &quot;trousers&quot;: 33,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 44,
                &quot;name&quot;: &quot;West, Volkman and Hessel&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Synchronised didactic attitude&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 108,
            &quot;playerName&quot;: &quot;Ms. Mellie Eichmann II&quot;,
            &quot;hunterName&quot;: &quot;nihil&quot;,
            &quot;campaignId&quot;: 44,
            &quot;helmet&quot;: 57,
            &quot;vest&quot;: 181,
            &quot;trousers&quot;: 107,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 44,
                &quot;name&quot;: &quot;West, Volkman and Hessel&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Synchronised didactic attitude&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 109,
            &quot;playerName&quot;: &quot;Filiberto Mayer&quot;,
            &quot;hunterName&quot;: &quot;labore&quot;,
            &quot;campaignId&quot;: 45,
            &quot;helmet&quot;: 109,
            &quot;vest&quot;: 106,
            &quot;trousers&quot;: 21,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 45,
                &quot;name&quot;: &quot;Gulgowski and Sons&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Devolved bottom-line data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 110,
            &quot;playerName&quot;: &quot;Madie O&#039;Connell&quot;,
            &quot;hunterName&quot;: &quot;molestiae&quot;,
            &quot;campaignId&quot;: 45,
            &quot;helmet&quot;: 28,
            &quot;vest&quot;: 15,
            &quot;trousers&quot;: 147,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 45,
                &quot;name&quot;: &quot;Gulgowski and Sons&quot;,
                &quot;mapId&quot;: 9,
                &quot;teamName&quot;: &quot;Devolved bottom-line data-warehouse&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 111,
            &quot;playerName&quot;: &quot;Muhammad Prohaska&quot;,
            &quot;hunterName&quot;: &quot;doloribus&quot;,
            &quot;campaignId&quot;: 46,
            &quot;helmet&quot;: 20,
            &quot;vest&quot;: 48,
            &quot;trousers&quot;: 156,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 46,
                &quot;name&quot;: &quot;Quigley, Weissnat and Dickinson&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Profound non-volatile collaboration&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 112,
            &quot;playerName&quot;: &quot;Dr. Curtis Ortiz MD&quot;,
            &quot;hunterName&quot;: &quot;laudantium&quot;,
            &quot;campaignId&quot;: 46,
            &quot;helmet&quot;: 130,
            &quot;vest&quot;: 122,
            &quot;trousers&quot;: 110,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 46,
                &quot;name&quot;: &quot;Quigley, Weissnat and Dickinson&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Profound non-volatile collaboration&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 113,
            &quot;playerName&quot;: &quot;Tom Weber&quot;,
            &quot;hunterName&quot;: &quot;tempora&quot;,
            &quot;campaignId&quot;: 47,
            &quot;helmet&quot;: 3,
            &quot;vest&quot;: 84,
            &quot;trousers&quot;: 110,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 47,
                &quot;name&quot;: &quot;Hills, Farrell and Ritchie&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Multi-layered client-driven GraphicalUserInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 114,
            &quot;playerName&quot;: &quot;Brody Rutherford Jr.&quot;,
            &quot;hunterName&quot;: &quot;nihil&quot;,
            &quot;campaignId&quot;: 47,
            &quot;helmet&quot;: 75,
            &quot;vest&quot;: 84,
            &quot;trousers&quot;: 121,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 47,
                &quot;name&quot;: &quot;Hills, Farrell and Ritchie&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Multi-layered client-driven GraphicalUserInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 115,
            &quot;playerName&quot;: &quot;Frida Bednar&quot;,
            &quot;hunterName&quot;: &quot;rem&quot;,
            &quot;campaignId&quot;: 47,
            &quot;helmet&quot;: 151,
            &quot;vest&quot;: 58,
            &quot;trousers&quot;: 125,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 47,
                &quot;name&quot;: &quot;Hills, Farrell and Ritchie&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Multi-layered client-driven GraphicalUserInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 116,
            &quot;playerName&quot;: &quot;Martina Skiles Jr.&quot;,
            &quot;hunterName&quot;: &quot;ut&quot;,
            &quot;campaignId&quot;: 47,
            &quot;helmet&quot;: 174,
            &quot;vest&quot;: 22,
            &quot;trousers&quot;: 168,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 47,
                &quot;name&quot;: &quot;Hills, Farrell and Ritchie&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Multi-layered client-driven GraphicalUserInterface&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 117,
            &quot;playerName&quot;: &quot;Rowena Reynolds I&quot;,
            &quot;hunterName&quot;: &quot;veritatis&quot;,
            &quot;campaignId&quot;: 48,
            &quot;helmet&quot;: 14,
            &quot;vest&quot;: 61,
            &quot;trousers&quot;: 21,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 48,
                &quot;name&quot;: &quot;Schneider-Rau&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Sharable multimedia emulation&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 118,
            &quot;playerName&quot;: &quot;Ms. Jenifer Parisian&quot;,
            &quot;hunterName&quot;: &quot;labore&quot;,
            &quot;campaignId&quot;: 49,
            &quot;helmet&quot;: 126,
            &quot;vest&quot;: 53,
            &quot;trousers&quot;: 60,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 49,
                &quot;name&quot;: &quot;Dach PLC&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Quality-focused incremental localareanetwork&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 119,
            &quot;playerName&quot;: &quot;Mr. Brice Crona Jr.&quot;,
            &quot;hunterName&quot;: &quot;earum&quot;,
            &quot;campaignId&quot;: 50,
            &quot;helmet&quot;: 116,
            &quot;vest&quot;: 112,
            &quot;trousers&quot;: 157,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 50,
                &quot;name&quot;: &quot;Jerde Inc&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Sharable multi-tasking methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 120,
            &quot;playerName&quot;: &quot;Mr. Stefan Rath IV&quot;,
            &quot;hunterName&quot;: &quot;optio&quot;,
            &quot;campaignId&quot;: 50,
            &quot;helmet&quot;: 100,
            &quot;vest&quot;: 22,
            &quot;trousers&quot;: 23,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 50,
                &quot;name&quot;: &quot;Jerde Inc&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Sharable multi-tasking methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 121,
            &quot;playerName&quot;: &quot;Vincent Paucek&quot;,
            &quot;hunterName&quot;: &quot;provident&quot;,
            &quot;campaignId&quot;: 50,
            &quot;helmet&quot;: 130,
            &quot;vest&quot;: 137,
            &quot;trousers&quot;: 169,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 50,
                &quot;name&quot;: &quot;Jerde Inc&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Sharable multi-tasking methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 122,
            &quot;playerName&quot;: &quot;Arden Waters&quot;,
            &quot;hunterName&quot;: &quot;doloribus&quot;,
            &quot;campaignId&quot;: 50,
            &quot;helmet&quot;: 177,
            &quot;vest&quot;: 102,
            &quot;trousers&quot;: 39,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:18:02.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;campaign&quot;: {
                &quot;id&quot;: 50,
                &quot;name&quot;: &quot;Jerde Inc&quot;,
                &quot;mapId&quot;: 10,
                &quot;teamName&quot;: &quot;Sharable multi-tasking methodology&quot;,
                &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hunters" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hunters"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hunters"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hunters" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hunters">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hunters" data-method="GET"
      data-path="api/hunters"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hunters', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hunters"
                    onclick="tryItOut('GETapi-hunters');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hunters"
                    onclick="cancelTryOut('GETapi-hunters');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hunters"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hunters</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hunters"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-hunters"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="equipments-POSTapi-hunters">Store a newly created hunter in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-hunters">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/hunters" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"playerName\": \"Volovin Volovan\",
    \"hunterName\": \"Geralt of Rivia\",
    \"campaignId\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/hunters"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "playerName": "Volovin Volovan",
    "hunterName": "Geralt of Rivia",
    "campaignId": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-hunters">
</span>
<span id="execution-results-POSTapi-hunters" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-hunters"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-hunters"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-hunters" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-hunters">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-hunters" data-method="POST"
      data-path="api/hunters"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-hunters', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-hunters"
                    onclick="tryItOut('POSTapi-hunters');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-hunters"
                    onclick="cancelTryOut('POSTapi-hunters');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-hunters"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/hunters</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-hunters"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-hunters"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>playerName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="playerName"                data-endpoint="POSTapi-hunters"
               value="Volovin Volovan"
               data-component="body">
    <br>
<p>The name of the player controlling the hunter. Must not be greater than 255 characters. Example: <code>Volovin Volovan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hunterName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hunterName"                data-endpoint="POSTapi-hunters"
               value="Geralt of Rivia"
               data-component="body">
    <br>
<p>The name of the hunter. Must not be greater than 255 characters. Example: <code>Geralt of Rivia</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>campaignId</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="campaignId"                data-endpoint="POSTapi-hunters"
               value="1"
               data-component="body">
    <br>
<p>The ID of the campaign the hunter belongs to. The <code>id</code> of an existing record in the campaigns table. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="equipments-GETapi-hunters--id-">Display the specified hunter.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-hunters--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/hunters/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/hunters/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hunters--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;metadata&quot;: [],
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;playerName&quot;: &quot;Otis Botsford&quot;,
        &quot;hunterName&quot;: &quot;et&quot;,
        &quot;campaignId&quot;: 1,
        &quot;helmet&quot;: 85,
        &quot;vest&quot;: 158,
        &quot;trousers&quot;: 128,
        &quot;created_at&quot;: &quot;2025-09-25T06:17:56.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-25T06:18:00.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;campaign&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Feil-Hansen&quot;,
            &quot;mapId&quot;: 1,
            &quot;teamName&quot;: &quot;Proactive executive data-warehouse&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hunters--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hunters--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hunters--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hunters--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hunters--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hunters--id-" data-method="GET"
      data-path="api/hunters/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hunters--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hunters--id-"
                    onclick="tryItOut('GETapi-hunters--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hunters--id-"
                    onclick="cancelTryOut('GETapi-hunters--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hunters--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hunters/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-hunters--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the hunter. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="equipments-PUTapi-hunters--id-">Update the specified hunter in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-hunters--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/hunters/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"playerName\": \"Volovin Volovan\",
    \"hunterName\": \"Geralt of Rivia\",
    \"campaignId\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/hunters/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "playerName": "Volovin Volovan",
    "hunterName": "Geralt of Rivia",
    "campaignId": 1
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-hunters--id-">
</span>
<span id="execution-results-PUTapi-hunters--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-hunters--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-hunters--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-hunters--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-hunters--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-hunters--id-" data-method="PUT"
      data-path="api/hunters/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-hunters--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-hunters--id-"
                    onclick="tryItOut('PUTapi-hunters--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-hunters--id-"
                    onclick="cancelTryOut('PUTapi-hunters--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-hunters--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/hunters/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/hunters/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-hunters--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the hunter. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>playerName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="playerName"                data-endpoint="PUTapi-hunters--id-"
               value="Volovin Volovan"
               data-component="body">
    <br>
<p>The name of the player controlling the hunter. Must not be greater than 255 characters. Example: <code>Volovin Volovan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hunterName</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hunterName"                data-endpoint="PUTapi-hunters--id-"
               value="Geralt of Rivia"
               data-component="body">
    <br>
<p>The name of the hunter. Must not be greater than 255 characters. Example: <code>Geralt of Rivia</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>campaignId</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="campaignId"                data-endpoint="PUTapi-hunters--id-"
               value="1"
               data-component="body">
    <br>
<p>The ID of the campaign the hunter belongs to. The <code>id</code> of an existing record in the campaigns table. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="equipments-DELETEapi-hunters--id-">Remove the specified hunter from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-hunters--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/hunters/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/hunters/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-hunters--id-">
</span>
<span id="execution-results-DELETEapi-hunters--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-hunters--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-hunters--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-hunters--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-hunters--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-hunters--id-" data-method="DELETE"
      data-path="api/hunters/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-hunters--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-hunters--id-"
                    onclick="tryItOut('DELETEapi-hunters--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-hunters--id-"
                    onclick="cancelTryOut('DELETEapi-hunters--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-hunters--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/hunters/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-hunters--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-hunters--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the hunter. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="equipments-GETapi-equipment">Display a listing of the equipments.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-equipment">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/equipment" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/equipment"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-equipment">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-equipment" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-equipment"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-equipment"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-equipment" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-equipment">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-equipment" data-method="GET"
      data-path="api/equipment"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-equipment', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-equipment"
                    onclick="tryItOut('GETapi-equipment');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-equipment"
                    onclick="cancelTryOut('GETapi-equipment');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-equipment"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/equipment</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-equipment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-equipment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="equipments-POSTapi-equipment">Store a newly created equipment in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-equipment">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/equipment" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Great Jagras Helm\",
    \"effect\": \"A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.\",
    \"type\": \"Helmet\",
    \"armor\": 3,
    \"elementalResistance\": \"fire\",
    \"elementalResistanceValue\": 2,
    \"class\": \"Sword and Shield, Great Sword, Dual Blades\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/equipment"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Great Jagras Helm",
    "effect": "A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.",
    "type": "Helmet",
    "armor": 3,
    "elementalResistance": "fire",
    "elementalResistanceValue": 2,
    "class": "Sword and Shield, Great Sword, Dual Blades"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-equipment">
</span>
<span id="execution-results-POSTapi-equipment" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-equipment"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-equipment"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-equipment" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-equipment">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-equipment" data-method="POST"
      data-path="api/equipment"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-equipment', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-equipment"
                    onclick="tryItOut('POSTapi-equipment');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-equipment"
                    onclick="cancelTryOut('POSTapi-equipment');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-equipment"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/equipment</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-equipment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-equipment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-equipment"
               value="Great Jagras Helm"
               data-component="body">
    <br>
<p>Name for the given equipment. Must not be greater than 255 characters. Example: <code>Great Jagras Helm</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>effect</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="effect"                data-endpoint="POSTapi-equipment"
               value="A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn."
               data-component="body">
    <br>
<p>Brief description of the equipment and its effect in case theres any. Example: <code>A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-equipment"
               value="Helmet"
               data-component="body">
    <br>
<p>What type of equipment is it. Helmet, Vest, Trousers. Must not be greater than 50 characters. Example: <code>Helmet</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>armor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="armor"                data-endpoint="POSTapi-equipment"
               value="3"
               data-component="body">
    <br>
<p>Armor value provided by the equipment. Must be at least 0. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>elementalResistance</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="elementalResistance"                data-endpoint="POSTapi-equipment"
               value="fire"
               data-component="body">
    <br>
<p>Elemental resistance provided by the equipment. Must not be greater than 50 characters. Example: <code>fire</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>elementalResistanceValue</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="elementalResistanceValue"                data-endpoint="POSTapi-equipment"
               value="2"
               data-component="body">
    <br>
<p>Amount of elemental resistance provided by the equipment. Must be at least 1. Must not be greater than 5. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>class</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="class"                data-endpoint="POSTapi-equipment"
               value="Sword and Shield, Great Sword, Dual Blades"
               data-component="body">
    <br>
<p>What class can use this equipment. Must not be greater than 50 characters. Example: <code>Sword and Shield, Great Sword, Dual Blades</code></p>
        </div>
        </form>

                    <h2 id="equipments-GETapi-equipment--id-">Display the specified equipment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-equipment--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/equipment/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/equipment/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-equipment--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-equipment--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-equipment--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-equipment--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-equipment--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-equipment--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-equipment--id-" data-method="GET"
      data-path="api/equipment/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-equipment--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-equipment--id-"
                    onclick="tryItOut('GETapi-equipment--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-equipment--id-"
                    onclick="cancelTryOut('GETapi-equipment--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-equipment--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/equipment/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-equipment--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the equipment. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="equipments-PUTapi-equipment--id-">Update the specified equipment in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-equipment--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/equipment/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Great Jagras Helm\",
    \"effect\": \"A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.\",
    \"type\": \"Helmet\",
    \"armor\": 3,
    \"elementalResistance\": \"fire\",
    \"elementalResistanceValue\": 2,
    \"class\": \"Sword and Shield, Great Sword, Dual Blades\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/equipment/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Great Jagras Helm",
    "effect": "A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.",
    "type": "Helmet",
    "armor": 3,
    "elementalResistance": "fire",
    "elementalResistanceValue": 2,
    "class": "Sword and Shield, Great Sword, Dual Blades"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-equipment--id-">
</span>
<span id="execution-results-PUTapi-equipment--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-equipment--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-equipment--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-equipment--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-equipment--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-equipment--id-" data-method="PUT"
      data-path="api/equipment/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-equipment--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-equipment--id-"
                    onclick="tryItOut('PUTapi-equipment--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-equipment--id-"
                    onclick="cancelTryOut('PUTapi-equipment--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-equipment--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/equipment/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/equipment/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-equipment--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the equipment. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-equipment--id-"
               value="Great Jagras Helm"
               data-component="body">
    <br>
<p>Name for the given equipment. Must be at least 3 characters. Must not be greater than 255 characters. Example: <code>Great Jagras Helm</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>effect</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="effect"                data-endpoint="PUTapi-equipment--id-"
               value="A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn."
               data-component="body">
    <br>
<p>Brief description of the equipment and its effect in case theres any. Example: <code>A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-equipment--id-"
               value="Helmet"
               data-component="body">
    <br>
<p>What type of equipment is it. Helmet, Vest, Trousers. Must be at least 1 character. Must not be greater than 1 character. Example: <code>Helmet</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>armor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="armor"                data-endpoint="PUTapi-equipment--id-"
               value="3"
               data-component="body">
    <br>
<p>Armor value provided by the equipment. Must be at least 0. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>elementalResistance</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="elementalResistance"                data-endpoint="PUTapi-equipment--id-"
               value="fire"
               data-component="body">
    <br>
<p>Elemental resistance provided by the equipment. Must not be greater than 50 characters. Example: <code>fire</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>elementalResistanceValue</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="elementalResistanceValue"                data-endpoint="PUTapi-equipment--id-"
               value="2"
               data-component="body">
    <br>
<p>Amount of elemental resistance provided by the equipment. Must be at least 1. Must not be greater than 5. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>class</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="class"                data-endpoint="PUTapi-equipment--id-"
               value="Sword and Shield, Great Sword, Dual Blades"
               data-component="body">
    <br>
<p>What class can use this equipment. Must not be greater than 50 characters. Example: <code>Sword and Shield, Great Sword, Dual Blades</code></p>
        </div>
        </form>

                    <h2 id="equipments-DELETEapi-equipment--id-">Remove the specified equipment from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-equipment--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/equipment/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/equipment/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-equipment--id-">
</span>
<span id="execution-results-DELETEapi-equipment--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-equipment--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-equipment--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-equipment--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-equipment--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-equipment--id-" data-method="DELETE"
      data-path="api/equipment/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-equipment--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-equipment--id-"
                    onclick="tryItOut('DELETEapi-equipment--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-equipment--id-"
                    onclick="cancelTryOut('DELETEapi-equipment--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-equipment--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/equipment/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-equipment--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-equipment--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the equipment. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="maps">Maps</h1>

    <p>Endpoints for managing maps</p>

                                <h2 id="maps-GETapi-maps">Display a listing of maps.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-maps">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/maps?sort=consequatur&amp;direction=consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/maps"
);

const params = {
    "sort": "consequatur",
    "direction": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-maps">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;metadata&quot;: [],
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Azerbaijan&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Israel&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Germany&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Zimbabwe&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Bolivia&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Mauritius&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Angola&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Morocco&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Iraq&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Tonga&quot;,
            &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
            &quot;deleted_at&quot;: null
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-maps" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-maps"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-maps"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-maps" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-maps">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-maps" data-method="GET"
      data-path="api/maps"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-maps', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-maps"
                    onclick="tryItOut('GETapi-maps');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-maps"
                    onclick="cancelTryOut('GETapi-maps');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-maps"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/maps</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-maps"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-maps"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-maps"
               value="consequatur"
               data-component="query">
    <br>
<p>Field to sort by. Defaults to 'id' Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="direction"                data-endpoint="GETapi-maps"
               value="consequatur"
               data-component="query">
    <br>
<p>Direction of the sorting 'asc'/'desc' Example: <code>consequatur</code></p>
            </div>
                </form>

                    <h2 id="maps-POSTapi-maps">Store a newly created map in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-maps">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/maps" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Ancient Forest\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/maps"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Ancient Forest"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-maps">
</span>
<span id="execution-results-POSTapi-maps" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-maps"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-maps"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-maps" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-maps">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-maps" data-method="POST"
      data-path="api/maps"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-maps', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-maps"
                    onclick="tryItOut('POSTapi-maps');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-maps"
                    onclick="cancelTryOut('POSTapi-maps');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-maps"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/maps</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-maps"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-maps"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-maps"
               value="Ancient Forest"
               data-component="body">
    <br>
<p>The name of the map. Example: <code>Ancient Forest</code></p>
        </div>
        </form>

                    <h2 id="maps-GETapi-maps--id-">Display the specified map.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-maps--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/maps/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/maps/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-maps--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;metadata&quot;: [],
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Azerbaijan&quot;,
        &quot;created_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-25T06:17:55.000000Z&quot;,
        &quot;deleted_at&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-maps--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-maps--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-maps--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-maps--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-maps--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-maps--id-" data-method="GET"
      data-path="api/maps/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-maps--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-maps--id-"
                    onclick="tryItOut('GETapi-maps--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-maps--id-"
                    onclick="cancelTryOut('GETapi-maps--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-maps--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/maps/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-maps--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the map. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="maps-PUTapi-maps--id-">Update the specified map in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-maps--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/maps/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Ancient Forest\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/maps/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Ancient Forest"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-maps--id-">
</span>
<span id="execution-results-PUTapi-maps--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-maps--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-maps--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-maps--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-maps--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-maps--id-" data-method="PUT"
      data-path="api/maps/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-maps--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-maps--id-"
                    onclick="tryItOut('PUTapi-maps--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-maps--id-"
                    onclick="cancelTryOut('PUTapi-maps--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-maps--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/maps/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/maps/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-maps--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the map. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-maps--id-"
               value="Ancient Forest"
               data-component="body">
    <br>
<p>The name of the map. Example: <code>Ancient Forest</code></p>
        </div>
        </form>

                    <h2 id="maps-DELETEapi-maps--id-">Remove the specified map from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-maps--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/maps/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/maps/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-maps--id-">
</span>
<span id="execution-results-DELETEapi-maps--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-maps--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-maps--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-maps--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-maps--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-maps--id-" data-method="DELETE"
      data-path="api/maps/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-maps--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-maps--id-"
                    onclick="tryItOut('DELETEapi-maps--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-maps--id-"
                    onclick="cancelTryOut('DELETEapi-maps--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-maps--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/maps/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-maps--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-maps--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the map. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
