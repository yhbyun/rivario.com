// # Ghost Editor
//
// Ghost Editor contains a set of modules which make up the editor component
// It manages the left and right panes, and all of the communication between them
// Including scrolling,

/*global document, $, _, Ghost */
(function () {
    'use strict';

    var Editor = function () {
        var self = this,
            $document = $(document),
        // Create all the needed editor components, passing them what they need to function
            markdown = document.getElementsByClassName('markdown-editor')[0],
            preview = new Ghost.Editor.HTMLPreview(markdown);

         // Initialise
        preview.update();
    };

    Ghost.Editor = Ghost.Editor || {};
    Ghost.Editor.Main = Editor;
}());
