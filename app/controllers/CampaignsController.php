<?php

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class CampaignsController extends BaseController {

    public function getIndex()
    {
        $this->view('campaigns.index');
    }

    public function postInline()
    {
        $converter = new CssToInlineStyles();
        $converter->setEncoding('utf-8');
        $converter->setUseInlineStylesBlock();
        $converter->setStripOriginalStyleTags(Input::get('stripOriginCSS'));
        $converter->setCleanup();

        $converter->setHTML(Input::get('html'));
        $inlineHtml = $converter->convert();

        $this->view('campaigns.inline', compact('inlineHtml'));
    }
}
