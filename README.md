# Cache Buster plugin for Craft CMS 4.x and 5.x

## Requirements

This plugin requires both Craft CMS 4.0.0-beta.23 or later and 5.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Add the following code to `composer.json`

        "repositories": {
           "cachebuster": {
              "type": "vcs",
              "url": "https://github.com/flowsa/cache-buster.git"
           },
        }

3. Then tell Composer to load the plugin:

        composer require flowsa/cachebuster

4. In the Control Panel, go to Settings → Plugins and click the “Install” button for cache-buster.

## Cache Buster Overview

-Insert text here-

## Configuring Cache Buster

The Cache busting plugin is meant to ensure effective resource availability.

## Using Cache Buster

find the twig template which has your styles.css and app.js references and modify it as follows:

```
for css:

{% set pluginHandle = 'flowsa-cachebuster' %}
{% set plugin = craft.app.plugins.getPlugin(pluginHandle, false) %}

{% if plugin and plugin.isInstalled %}
    {% set cssCacheBuster = craft.cachebustervariable.getModificationTime() %}
{% else %}
    {% set cssCacheBuster = '' %}
{% endif %}
<link rel="stylesheet" href="{{'/path/to/your/styles.css' ~ '?v=' ~ cssCacheBuster}}">

```

```
for js:

{{% set pluginHandle = 'flowsa-cachebuster' %}
{% set plugin = craft.app.plugins.getPlugin(pluginHandle, false) %}

{% if plugin and plugin.isInstalled %}
    {% set jsCacheBuster = craft.cachebustervariable.getModificationTime() %}
{% else %}
    {% set jsCacheBuster = '' %}
{% endif %}
<script src="{{'/path/to/your/app.js' ~ '?v=' ~ jsCacheBuster}}"></script>

```

Note: make sure $directoryPath points to the dist folder or where your compiled assets are:
This can be located in cachebuster/src/variables/CachebusterVariable line 18. current implementation is $directoryPath = CRAFT_BASE_PATH . '/web/dist';

## Cache Buster Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [Flow Communications](https://www.flowsa.com)
