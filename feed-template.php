<?php
header('Content-Type: application/json; charset=' . get_option('blog_charset'));

$feed_items = array();
$limitCount = 0;
while (have_posts()) : the_post();
	$item = array(
		"id" => get_permalink(),
		"url" => get_permalink(),
		"title" => get_the_title(),
		"content_html" => get_the_content(),
		"date_published" => get_the_date("c"),
		"date_modified" => get_the_modified_date("c"),
	);

	array_push($feed_items, $item);

	if (--$limitCount == 0) break;
endwhile;

$feed_json = array(
	"version" => "http://jsonfeed.org/version/1",
	"home_page_url" => get_home_url(),
	"feed_url" => get_feed_link("json"),
	"title" => get_bloginfo("name"),
	"description" => get_bloginfo("description"),
	"items" => $feed_items
);

echo json_encode($feed_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>