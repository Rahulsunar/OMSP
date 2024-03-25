<?php
if (IS_LOGGED == false ) {
	header("Location: $site_url/404");
	exit();
}

if ($music->user->upload_import == 0) {
    header("Location: $site_url");
    exit();
}

$page_to_load = 'content';
if (!IsAdmin()) {
	if ($music->config->go_pro == 'on') {
	    if (($user->uploads >= ($music->config->pro_upload_limit * 1000)) && $user->is_pro == 0) {
	        $page_to_load = 'limit-reached';
	    }
	}
	if ($music->config->who_can_upload == 'admin' && !IsAdmin()) {
		header("Location: $site_url/404");
		exit();
	}
	if ($music->config->who_can_upload == 'artist' && ($user->artist == 0 && !IsAdmin())) {
		header("Location: $site_url/404");
		exit();
	}
}
	

$music->site_title = lang("Upload");
$music->site_description = $music->config->description;
$music->site_pagename = "upload-song";
$music->site_content = loadPage("upload-song/$page_to_load");