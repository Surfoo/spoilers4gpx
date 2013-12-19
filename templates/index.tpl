<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
        <title>Spoilers4gpx</title>
        <meta name="description" content="Spoilers4gpx is a tool to provide spoilers into GPX files.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/{{ constant('BOOTSTRAP_VERSION') }}/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="design/design.css?{{ constant('SUFFIX_CSS_JS') }}" media="all" />
    </head>
    <body>
        <div class="container">

            <div class="page-header">
                <p class="pull-right">
                    <a href="#applications" data-toggle="modal" class="btn btn-default">List of compatibles applications</a>
                </p>
                <h1>Spoilers for GPX</h1>
            </div>

            <div class="pull-right">
                <a id="glyphicon-help" href="#help" data-toggle="modal" title="About Spoilers4Gpx" class="glyphicon glyphicon-question-sign"></a>
            </div>

            <form role="form" action="#" method="post">
                <div class="form-group">
                    <span class="help-block">Provide a list of your GC codes published below:</span>
                    <textarea class="form-control" rows="5" cols="50" id="gccodelist" required="required"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submit" data-loading-text="Loading...">Submit</button>
                </div>
            </form>

            <div id="instructions" class="alert alert-info clearfix">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                <h3>Instructions for each of your caches</h3>
                <ol>
                    <li>Check the list of spoilers for each of caches below. In many cases, images are not a spoiler, so you can remove the line,</li>
                    <li>Copy the code in the textarea,</li>
                    <li>Click on the title to go to the edit page,</li>
                    <li>Tick the checkbox “The descriptions below are in HTML” in your listing,</li>
                    <li>Paste the code at the end of the "Long Description" and submit the form.</li>
                </ol>
            </div>

            <div id="snippets"></div>

        </div>

        <div id="help" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">About Spoilers4Gpx</h4>
                    </div>
                    <div class="modal-body">
                        <p>Spoilers4Gpx is a tool to include geocache's spoilers in GPX files.</p>

                        <h3>For geocache owners</h3>
                        <p>The only way to include spoilers into GPX is to put the spoiler's links into the description.<br/>
                        Fill the text box with the list of your caches, and Spoilers4Gpx will return a HTML code to put into each of your caches.
                        It's completely invisible on the listing! In this manner, spoilers will be inserted into the GPX file and softwares about geocaching could download spoilers without having to fetch caches on geocaching.com.
                        <p>There are two ways to use this web app: </p>
                        <h5><strong>1st method:</strong></h5>
                        <div class="method">Copy/paste a list a GC code in the text box to obtain the list of pictures included on listing.</div>

                        <h5><strong>2nd method:</strong></h5>
                        <div class="method">You can use the <a href="https://addons.mozilla.org/fr/firefox/addon/greasemonkey/">greasemonkey addon</a> (For Firefox) and install the <a href="spoilers4gpx.user.js">Spoilers4Gpx script</a> to obtain the code cache by cache.
                        </div>

                        <h3>For developers</h3>
                        <p>For information, <a href="https://en.wikipedia.org/wiki/Markdown" onclick="window.open(this.href);return false;">Markdown</a> is used here, it's simple to write and parse. Links are written in this way:</p>
                        <pre>{{ demo_spoiler }}</pre>
                        <p>But the only thing you need is the regex to retrieve titles and URLs:</p>
                        <pre>{{ demo_regex }}</pre>
                    </div>
                </div>
            </div>
        </div>

        <div id="applications" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">List of compatibles applications</h4>
                    </div>
                    <div class="modal-body">
                        <p>Applications should be a slightly modified to be compatible with Spoilers4Gpx. Here is a list of compatible applications:</p>
                        <ul id="applications-list">
                            <li><a href="http://georoadbook.vaguelibre.net/">Georoadbook</a></li>
                            <li><a href="http://mgmgeo.free.fr/">MyGeocachingManager</a> (>= 1.6.0.0)</li>
                            <li><a href="http://www.anode.plus.com/spoilersync/">SpoilerSync</a> (In a future release, after 1.0.33)</li>
                        </ul>
                        <p>If you have a compatible application, send an email to <strong>surfooo at gmail dot com</strong>, and I will add your application to the list!</p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/{{ constant('JQUERY_VERSION') }}/jquery.min.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/{{ constant('BOOTSTRAP_VERSION') }}/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/spoilers.min.js?{{ constant('SUFFIX_CSS_JS') }}"></script>
    </body>
</html>
