<?php

/**
 * Class ShortCodeParser
 * https://stackoverflow.com/a/32525179/405758
 */
final class ShortCodeParser {

    // Regex101 reference: https://regex101.com/r/pJ7lO1
    const SHORTOCODE_REGEXP = "/(?P<shortcode>(?:(?:\\s?\\[))(?P<name>[\\w\\-]{3,})(?:\\s(?P<attrs>[\\w\\d,\\s=\\\"\\'\\-\\+\\#\\%\\!\\~\\`\\&\\.\\s\\:\\/\\?\\|]+))?(?:\\])(?:(?P<content>[\\w\\d\\,\\!\\@\\#\\$\\%\\^\\&\\*\\(\\\\)\\s\\=\\\"\\'\\-\\+\\&\\.\\s\\:\\/\\?\\|\\<\\>]+)(?:\\[\\/[\\w\\-\\_]+\\]))?)/u";

    // Regex101 reference: https://regex101.com/r/sZ7wP0
    const ATTRIBUTE_REGEXP = "/(?<name>\\S+)=[\"']?(?P<value>(?:.(?![\"']?\\s+(?:\\S+)=|[>\"']))+.)[\"']?/u";

    /**
     * @param $text
     * @return array
     */
    public static function parseShortCodes($text) {
        preg_match_all(self::SHORTOCODE_REGEXP, $text, $matches, PREG_SET_ORDER);
        $shortcodes = array();
        foreach ($matches as $i => $value) {
            $shortcodes[$i]['shortcode'] = $value['shortcode'];
            $shortcodes[$i]['name'] = $value['name'];
            if (isset($value['attrs'])) {
                $attrs = self::parseAttributes($value['attrs']);
                $shortcodes[$i]['attrs'] = $attrs;
            }
            if (isset($value['content'])) {
                $shortcodes[$i]['content'] = $value['content'];
            }
        }

        return $shortcodes;
    }

    /**
     * @param $attrs
     * @return array
     */
    private static function parseAttributes($attrs) {
        preg_match_all(self::ATTRIBUTE_REGEXP, $attrs, $matches, PREG_SET_ORDER);
        $attributes = array();
        foreach ($matches as $i => $value) {
            $key = $value['name'];
            $attributes[$i][$key] = trim($value['value'], '"');
        }
        return $attributes;
    }

    /**
     * @param $shortcode
     * @return mixed
     *
     */
    public static function formatOutput($shortcode)
    {
        $parsedShortcode = ShortCodeParser::parseShortCodes($shortcode);

        // Flatten the attrs array
        if(isset($parsedShortcode[0]['attrs'])) {
            $attrs = [];
            for($i=0, $iCount=count($parsedShortcode[0]['attrs']); $i < $iCount; $i++) {
                foreach ($parsedShortcode[0]['attrs'][$i] as $key => $val) {
                    $attrs[$key] = $val;
                }
            }
            $parsedShortcode[0]['attrs'] = $attrs;
        }

        // make sure there's a tag attribute
        if(!isset($parsedShortcode[0]['attrs']['tag'])) {
            $parsedShortcode[0]['attrs']['tag'] = 'build-form';
        }

        // make sure there's a name attribute
        if(!isset($parsedShortcode[0]['attrs']['name'])) {
            $parsedShortcode[0]['attrs']['name'] = $parsedShortcode[0]['attrs']['tag'];
        }
        
        // make sure there's a action attribute
        if(!isset($parsedShortcode[0]['attrs']['action'])) {
            $parsedShortcode[0]['attrs']['action'] = $parsedShortcode[0]['attrs']['tag'];
        }
        
        // make sure there's a new line
        if(!isset($parsedShortcode[0]['attrs']['new_line'])) {
            $parsedShortcode[0]['attrs']['new_line'] = ',';
        }
        // make sure there's a delimiter
        if(!isset($parsedShortcode[0]['attrs']['delimiter'])) {
            $parsedShortcode[0]['attrs']['delimiter'] = '|';
        }

        // Parse the questions and headings lists
        foreach (['questions', 'headings'] as $item) {
            if(isset($parsedShortcode[0]['attrs'][$item]) && is_string($parsedShortcode[0]['attrs'][$item])) {
                $items = [];
                $itemList = explode($parsedShortcode[0]['attrs']['new_line'], $parsedShortcode[0]['attrs'][$item]);
                for($i=0, $iCount=count($itemList); $i < $iCount; $i++) {
                    $itemParts = explode($parsedShortcode[0]['attrs']['delimiter'], $itemList[$i]);
                    $items[$i]['label'] =   isset($itemParts[0]) ? $itemParts[0] : null;
                    $items[$i]['name'] =    isset($itemParts[1]) ? $itemParts[1] : null;
                    $items[$i]['type'] =    isset($itemParts[2]) ? $itemParts[2] : null;
                    $items[$i]['value'] =   isset($itemParts[3]) ? $itemParts[3] : null;
                    $items[$i]['comment'] = isset($itemParts[4]) ? $itemParts[4] : null;
                }

                $parsedShortcode[0]['attrs'][$item] = $items;
            }
        }
        // remove all keys from 'attrs' that are not 'questions' or 'headers'
        foreach (array_keys($parsedShortcode[0]['attrs']) as $array_key) {
            if(!in_array($array_key, ['questions','headings'])) {
                $parsedShortcode[0][$array_key] = $parsedShortcode[0]['attrs'][$array_key];
                unset($parsedShortcode[0]['attrs'][$array_key]);
            }
        }


        // Rename 'attrs' to 'attributes' to match the Vue app
        $parsedShortcode[0]['attributes'] = $parsedShortcode[0]['attrs'];
        unset($parsedShortcode[0]['attrs']);

        return $parsedShortcode[0];

    }
}
