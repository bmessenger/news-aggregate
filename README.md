# WordPress & Medium News Feed Aggregate

This WordPress ACF/Gutenburg Block displays news feeds from two sources:

1. **Medium RSS Feed** – Pulls and displays the latest articles from several Medium publications using a WordPress shortcode. **(/inc/medium-rss-shortcode.php)**
2. **Local News Feed** – Periodically polls a local endpoint (on the same server) for news via a `getJSON` jQuery call and updates the content on the page dynamically. **(/blocks/js/news-press-tabbed.js)**

## Features

- Easily add a Gutenburg Block to any page or Widget Area
- Simple WordPress shortcode to embed Medium articles.
- Automatically updates local news feed using AJAX and an interval.
- Bootstrap integration for responsiveness.
- Lightweight and customizable.

## Shortcode Usage

Use the `[medium]` shortcode in any post, page, or widget to display Medium articles.

Using a Shortcode provides a clean and reusable way to pull Medium feeds from multiple sources.  It can be used directly in a theme file, as seen here, or added directly to a page using the editor.

### Sample Usage

**Template File** - **(/blocks/news-press-tabbed.php)**

**Shortcode Example** - [medium handle="atmosxyz" num_posts="9" interval="21600"]