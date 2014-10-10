<?php namespace Phphub\Markdown;

use HTML_To_Markdown;
use GrahamCampbell\Markdown\Markdown as GMarkdown;

use Purifier;
use ParsedownExtra;

class Markdown
{
    protected $htmlParser;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlParser = new HTML_To_markdown;
        $this->htmlParser->set_option('header_style', 'atx');

        $this->markdownParser = new GMarkdown(new ParsedownExtra());
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = $this->markdownParser->render($markdown);
        return Purifier::clean($convertedHmtl, 'user_topic_body');
    }
}
