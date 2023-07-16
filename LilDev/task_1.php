<?php
header('Content-Type:text/html; charset =itf-8');

/*
 * Flips the text
 * @return string
 */
function textConverse(string $text): string{

        $result = null;
        $i = 1;
        while(mb_strlen($text) !== mb_strlen($result)){
            $result .= mb_substr($text, -$i, 1);
            $i++;
        }
        return $result;
}

$text = 'PHP (рекурсивный акроним словосочетания PHP: Hypertext Preprocessor).';

$result = textConverse($text);

echo $result;

