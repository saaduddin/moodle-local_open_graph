<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace local_open_graph;

/**
 * Hook callbacks for Open Graph implementation for Moodle
 *
 * @package   local_open_graph
 * @copyright 2025 Saad Uddin
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 */
class callbacks {
    /**
     * Add Open Graph meta tags to the page head
     *
     * @param \core\hook\output\before_http_headers $hook
     */
    public static function before_http_headers(\core\hook\output\before_http_headers $hook): void {
        global $PAGE, $SITE, $COURSE, $CFG;

        if (!$PAGE->has_set_url()) {
            return;
        }

        // Cache setup.
        $cache = \cache::make('local_open_graph', 'opengraphtags');
        $cachekey = 'og_' . sha1($PAGE->url->out_as_local_url(false));

        if ($cachedtags = $cache->get($cachekey)) {
            $CFG->additionalhtmlhead .= $cachedtags;
            return;
        }

        // Defaults.
        $url = $PAGE->url->out(false);
        $sitename = format_string($SITE->fullname);
        $title = format_string($PAGE->title);
        $description = get_config('local_open_graph', 'defaultdescription') ?: format_string($SITE->fullname);
        $defaultimageurl = new \moodle_url('/local/open_graph/default-image.png');
        $imageurl = $defaultimageurl;
        $ogtype = 'website';

        // Course-specific logic.
        if ($PAGE->context->contextlevel == CONTEXT_COURSE
            || ($PAGE->context->contextlevel == CONTEXT_MODULE && isset($COURSE->id) && $COURSE->id > 1)
        ) {

            $title = format_string($COURSE->fullname);
            $context = \context_course::instance($COURSE->id);

            if (!empty($COURSE->summary)) {
                $rawsummary = format_text($COURSE->summary, FORMAT_HTML, ['context' => $context]);
                $strippedsummary = trim(strip_tags($rawsummary));
                $shortdesc = shorten_text($strippedsummary, 200);
                $description = $shortdesc . (strlen($shortdesc) < strlen($strippedsummary) ? '...' : '');
            }

            $img = self::get_course_image($context, 'overviewfiles');
            if ($img) {
                $imageurl = $img;
            } else if ($img = self::get_course_image($context, 'summary')) {
                $imageurl = $img;
            }

            if (isset($PAGE->cm)) {
                $modname = $PAGE->cm->modname ?? '';
                if (in_array($modname, ['forum', 'glossary', 'page', 'book'])) {
                    $ogtype = 'article';
                } else if ($modname === 'url' && strpos($PAGE->cm->url, 'youtube.com') !== false) {
                    $ogtype = 'video';
                } else if ($modname === 'media') {
                    $ogtype = 'video';
                }
            } else if (!empty($COURSE->summary) && preg_match('/<iframe.*youtube\.com/', $COURSE->summary)) {
                $ogtype = 'video';
            }
        }

        // Sanitize.
        $title = s($title);
        $description = s($description);
        $url = s($url);
        $imageurl = s($imageurl->out(false));
        $sitename = s($sitename);
        $ogtype = s($ogtype);

        // Build Open Graph meta.
        $ogmeta = "<meta property=\"og:title\" content=\"$title\" />\n";
        $ogmeta .= "<meta property=\"og:description\" content=\"$description\" />\n";
        $ogmeta .= "<meta property=\"og:url\" content=\"$url\" />\n";
        $ogmeta .= "<meta property=\"og:image\" content=\"$imageurl\" />\n";
        $ogmeta .= "<meta property=\"og:site_name\" content=\"$sitename\" />\n";
        $ogmeta .= "<meta property=\"og:type\" content=\"$ogtype\" />\n";

        // Add optional Twitter tags.
        $ogmeta .= "\n<meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
        $ogmeta .= "<meta name=\"twitter:title\" content=\"$title\" />\n";
        $ogmeta .= "<meta name=\"twitter:description\" content=\"$description\" />\n";
        $ogmeta .= "<meta name=\"twitter:image\" content=\"$imageurl\" />\n";

        // Cache it.
        $cache->set($cachekey, $ogmeta);

        // Add to page head.
        $CFG->additionalhtmlhead .= $ogmeta;
    }

    /**
     * Get course image URL from file areas
     *
     * @param  \context $context  The context object
     * @param  string   $filearea The file area to search in
     * @return \moodle_url|null URL to the image or null if none found
     */
    private static function get_course_image($context, $filearea) {
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'course', $filearea, 0, 'filename', false);

        foreach ($files as $file) {
            if ($file->is_valid_image()) {
                return \moodle_url::make_pluginfile_url(
                    $file->get_contextid(),
                    $file->get_component(),
                    $file->get_filearea(),
                    null,
                    $file->get_filepath(),
                    $file->get_filename()
                );
            }
        }

        return null;
    }
}
