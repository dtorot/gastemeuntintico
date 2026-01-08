<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgContentTintico extends CMSPlugin
{
    protected $autoloadLanguage = true;

    public function onContentPrepare($context, &$article, &$params, $limit)
    {
        // Only apply to articles
        /*if ($context !== 'com_content.article') {
            return;
    }*/

        // Check if article has a category ID
        if (empty($article->catid)) {
            return;
        }        

        // Get allowed categories from plugin params
        $allowedCategories = (array) $this->params->get('categories', []);

        // If current article category not in allowed list, skip
        if (!in_array($article->catid, $allowedCategories)) {
            return;
        }
        
        // Get the custom HTML + JS from the plugin parameters
        $customCode = $this->params->get('custom_code', '');

        // Append the custom code at the end of the article
        if (!empty($customCode)) {
            $article->text .= "\n<div class='custom-analytics-block'>{$customCode}</div>";
        }
    }
}
