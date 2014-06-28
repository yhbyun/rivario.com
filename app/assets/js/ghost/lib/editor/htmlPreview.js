// # Ghost Editor HTML Preview
//
// HTML Preview is the right pane in the split view editor.
// It is effectively just a scrolling container for the HTML output from showdown
// It knows how to update itself, and that's pretty much it.

/*global Ghost, Showdown, Countable, _, $ */
(function () {
    'use strict';

    var HTMLPreview = function (markdown) {
        //var converter = new Showdown.converter({extensions: ['ghostgfm']}),
        var converter = new Showdown.converter(),
            preview = document.getElementsByClassName('rendered-markdown')[0],
            update;

        // Update the preview
        // Includes replacing all the HTML, intialising upload dropzones, and updating the counter
        update = function () {
            preview.innerHTML = converter.makeHtml(markdown.innerHTML);
        };

        // Public API
        _.extend(this, {
            update: update
        });
    };

    Ghost.Editor = Ghost.Editor || {};
    Ghost.Editor.HTMLPreview = HTMLPreview;
} ());
