# Open Graph for Moodle

## Overview

**Open Graph for Moodle** is a simple and efficient plugin that integrates Open Graph meta tags into your Moodle site. It allows you to control and customize Open Graph (OG) metadata for course pages, course modules, and other content, improving how your site’s pages appear when shared on social media platforms like Facebook, Twitter, LinkedIn, and more. This enhances social sharing and SEO performance.

## Features

* Automatically generates Open Graph meta tags for course pages, course modules, and other content.
* Customizable meta tags for **title**, **description**, and **image**.
* Supports **default Open Graph tags** for the homepage and other general pages.
* **Twitter Card** support for richer content previews.
* **Caching** for optimized performance and reduced server load.
* Integration with **Moodle’s file storage system** for dynamically fetching course images.

## Installation

1. Download or clone the plugin from the repository.
2. Place the `local_open_graph` folder in the `local` directory of your Moodle installation.
3. Navigate to **Site administration > Notifications** to complete the installation.
4. Configure the plugin settings under **Site administration > Plugins > Local plugins > Open Graph**.

## Configuration

You can customize the default values for the Open Graph tags in the plugin’s settings. This includes options for:

* Default **description** if none is provided.
* Default **image** (e.g., a fallback image if no course-specific image is available).
* Enabling **Twitter Card** meta tags.

### Cache Settings

By default, Open Graph meta tags are cached for **1 hour** to improve performance. Cache will automatically refresh when content is updated (e.g., course summary changes).

## Usage

Once the plugin is installed and configured, Open Graph meta tags will be automatically added to the `<head>` section of your Moodle pages:

* **Course pages**: Title, description, and image based on course settings.
* **Module pages**: Optimized for modules like forums, pages, and books.
* **Other pages**: General meta tags based on the site’s homepage or specific page content.

## Customization

You can extend or modify the behavior of the plugin by editing the `local_open_graph/lib.php` file. For advanced users, the plugin supports hooks to customize how the meta tags are generated, or add additional data like language (`og:locale`) or custom Open Graph types.

## Support

For help or support, please visit the **Moodle community forums** or contact the plugin maintainers.

---

## License

This plugin is released under the [Moodle Plugin License](https://www.gnu.org/licenses/agpl-3.0.html).