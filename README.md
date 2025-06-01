# WordPress & Medium News Feed Aggregate

This WordPress plugin/shortcode allows you to display news feeds from two sources:

1. **Medium RSS Feed** – Pulls and displays the latest articles from several Medium publications using a WordPress shortcode. (/shortcodes/medium-rss-shortcode.php)
2. **Local News Feed** – Periodically polls a local endpoint (on the same server) for news via a `getJSON` jQuery call and updates the content on the page dynamically.

## Features

- Simple WordPress shortcode to embed Medium articles.
- Automatically updates local news feed using AJAX and an interval.
- Lightweight and customizable.

## Shortcode Usage

Use the `[medium]` shortcode in any post, page, or widget to display Medium articles.

Shortcodes provide a clean and reusable way to pull Medium feeds from multiple sources across your site. By using a shortcode, you can easily embed different Medium publications or user feeds without duplicating code or creating separate templates.

### Example

[medium handle="atmosxyz" num_posts="9" interval="21600"]