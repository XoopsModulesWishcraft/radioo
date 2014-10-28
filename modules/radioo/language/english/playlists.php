<?php
/*
 * Chronolabs XOOPS Life Streaming Radio Module - Radioo
 * 
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 
 * @copyright 		Chronolabs Cooperative http://labs.coop
 * @license 		General Software Licence (https://web.labs.coop/public/legal/general-software-license/10,3.html)
 * @package 		radioo
 * @since 			1.02
 * @author 			Antony Cipher <cipher@labs.coop>
 * @author 			Simon Roberts <meshy@labs.coop>
 * @subpackage		language
 * @description		Chronolabs XOOPS Module for Chat and Walky Talky Services
 * 
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');


// Preset Configurations
define('_RADIOO_PLAYLIST_TYPES', 'PLS|M3U|ASX|XSPF|B4S|RDF|KAPSULE|KPL|MAGMA|RAM|SMIL');

// HTML Titles for Playlists
define('_RADIOO_TITLE_PLS', 'QuickTime etc. Media');
define('_RADIOO_TITLE_M3U', 'Winamp Media');
define('_RADIOO_TITLE_ASX', 'Microsoft Media');
define('_RADIOO_TITLE_XSPF', 'Shareable for Media');
define('_RADIOO_TITLE_B4S', 'Winamp 3+ Media');
define('_RADIOO_TITLE_RDF', '(cc) Playlist for Media');
define('_RADIOO_TITLE_KAPSULE', 'Kapsule(Kazaa) Media');
define('_RADIOO_TITLE_KPL', 'Kazaa Media');
define('_RADIOO_TITLE_MAGMA', 'Magnetic Media');
define('_RADIOO_TITLE_RAM', 'Real Players Media');
define('_RADIOO_TITLE_SMIL', 'Various Media Players');

// HTML Descriptions for Playlists
define('_RADIOO_DESCRIPTION_PLS', 'A proprietary format used for playing Shoutcast and Icecast streams. The syntax of a PLS file is the same syntax as a Windows .ini file and was probably chosen because of support in the Windows API.');
define('_RADIOO_DESCRIPTION_M3U', 'Every line in an M3U file is either a comment, a blank, or a resource to render. A comment line begins with the pound sign, #. Blanks are ignored. A resource is the address of a media file.<br /><br />A resource address can be anything the M3U reader is capable of understanding. These include absolute filesystem paths, relative filesystem paths (with the base undefined by the file format), and URLs.<br /><br />A resource can be anything the M3U reader is capable of rendering. To my knowledge these are always audio files, but there is no set reason for that to be true. However, it may not be wise to point to proprietary media formats like Real streaming audio in an M3U file, since many players will throw a user-visible error for media they cannot render.<br /><br />The design philosophy of M3U is to let resource data types do the work. Players that don\'t understand an address or resource type usually skip the entry. The ability to reference URLs, in addition to filesystem paths, was added this way; some players (Winamp and XMMS, notably) simply added the ability to handle URLs to their M3U readers.<br /><br />Support for M3U features varies wildly. iTunes, for example, will only render the first entry in an M3U file.<br /><br />M3U is by far the most popular playlist format, probably due to its simplicity. It is an ad-hoc standard with no formal definition, no canonical source, and no owner.');
define('_RADIOO_DESCRIPTION_ASX', 'One of the three Windows Media metafile formats. The three are ASX, WAX, and WVX. These formats are identical except for the type of content they may point to. ASX may only point to .asf content.<br /><br />The ASX family of formats are somewhat a moving target, however, since they are defined by implementation in the windows Media Player and related APIs, which is changing rapidly at this time. I suspect but haven\'t confirmed that just about any kind of media can be pointed to within a playlist as long as the playlist is correctly handed off from the browser to Windows Media Player.');
define('_RADIOO_DESCRIPTION_XSPF', 'XSPF is a data format for sharing the kind of playlist that can be played on a personal computer or portable device. In the same way that any user on any computer can open any web page, XSPF is intended to provide portability for playlists.<br /><br />Traditionally playlists have been composed of file paths that pointed to individual titles. This allowed a playlist to be played locally on one machine or shared if the listed file paths were URLs accessible to more than one machine (e.g., on the web). XSPF\'s meta-data rich open format has permitted a new kind of playlist sharing called content resolution.<br /><br />A simple form of content resolution is the localisation of a playlist based on metadata. A content resolver[clarification needed] will open XSPF playlists and search a catalog[which?] for every title with <creator>, <album> and <title> tags, then localise the playlist to reference the available matching tracks. A catalog may reference a collection of media files on a local disk, a music subscription service like Yahoo! Music Unlimited, or some other searchable archive. The end result is shareable playlists that are not tied to a specific collection or service.');
define('_RADIOO_DESCRIPTION_B4S', 'A proprietary XML-based format introduced in Winamp version 3.');
define('_RADIOO_DESCRIPTION_RDF', 'The Creative Commons licensing project includes a template for RDF metadata to be embedded in XML or XML-like environments. It happens that when the syntax and semantics of this template are applied to an collection of audio works, the result is indistinguishable from a playlist. As an example, Mike Linksvayer of Creative Commons used an XSLT stylesheet to create a SMIL playlist from the embedded license RDF in the web page for the Creative Commons CD release "Copy Me Remix Me" at http://creativecommons.org/extras/copyremix. This work is included here because it is provocative and original.');
define('_RADIOO_DESCRIPTION_KAPSULE', 'XML manifest used by Kazaa.');
define('_RADIOO_DESCRIPTION_KPL', 'Kazaa Playlist Format. Like PLS, it is in Windows .ini format.');
define('_RADIOO_DESCRIPTION_MAGMA', 'MAGMA is a manifest format proposed informally by Gordon Mohr on the Magnet-URI mailing list. The purpose is to allow Magnet URI types to be used in playlists. Like KPL, these would allow files to be identified by hash. Like M3U and RAM, these would be one-dimensional. Like the ASX family and RAM, the MAGMA format would be used to flag the need for a special handler.<br /><br />MAGMA makes two improvements to M3U syntax. First, the header line contains a magic number (the "MAGMA" string) to identify the file type, as well as a URI to identify the web source of the file. Second, an entry can span multiple lines if trailing parts begin with whitespace.');
define('_RADIOO_DESCRIPTION_RAM', 'A RAM file is a flat file containing a list of media URLs, with one URL per line. It is almost identical to an M3U playlist, except that it may contain URLs of proprietary RealAudio media types, and URLs can be tweaked to affect the Real player startup mode.<br /><br />Notice that this difference between M3U and RAM is similar to the way that Microsoft playlist formats like ASX, WMV and WAX have the same syntax but are constrained to point towards different kinds of remote resources.<br /><br />Startup mode of the Real client can be specified by adding a query string after the resource. RAM embeds parameters for the local player in URLs of remote resources; this practice can be described as bizarre.<br /><br />RAM is a loosely defined proprietary format whose purpose can be summed up as launching one of the various Real clients and having it figure out what to do.');
define('_RADIOO_DESCRIPTION_SMIL', 'An XML format with a fair amount of overlap with HTML. Alone among playlist types, SMIL is an open standard, in this case from the W3C. According to the W3C, SMIL "is typically used for rich media/multimedia presentations which integrate streaming audio and video with images, text or any other media type".');

// Content-type Mimetype for Playlists
define('_RADIOO_MIMETYPE_PLS', 'audio/x-scpls');
define('_RADIOO_MIMETYPE_M3U', 'application/x-mpegurl');
define('_RADIOO_MIMETYPE_ASX', 'video/x-ms-asf');
define('_RADIOO_MIMETYPE_XSPF', 'application/xspf+xml');
define('_RADIOO_MIMETYPE_B4S', 'application/octet-stream');
define('_RADIOO_MIMETYPE_RDF', 'application/rdf+xml');
define('_RADIOO_MIMETYPE_KAPSULE', 'application/xml');
define('_RADIOO_MIMETYPE_KPL', 'application/octet-stream');
define('_RADIOO_MIMETYPE_MAGMA', 'text/html');
define('_RADIOO_MIMETYPE_RAM', 'audio/vnd.rn-realaudio');
define('_RADIOO_MIMETYPE_SMIL', 'application/smil');

// Transport method A0: 'push' (File Download)
// Transport method A1: 'render' (HTML Display of Template)
//
// Method of Transport to the end client
define('_RADIOO_TRANSPORT_PLS', 'push');
define('_RADIOO_TRANSPORT_M3U', 'push');
define('_RADIOO_TRANSPORT_ASX', 'push');
define('_RADIOO_TRANSPORT_XSPF', 'push');
define('_RADIOO_TRANSPORT_B4S', 'push');
define('_RADIOO_TRANSPORT_RDF', 'push');
define('_RADIOO_TRANSPORT_KAPSULE', 'push');
define('_RADIOO_TRANSPORT_KPL', 'push');
define('_RADIOO_TRANSPORT_MAGMA', 'render');
define('_RADIOO_TRANSPORT_RAM', 'push');
define('_RADIOO_TRANSPORT_SMIL', 'push');

?>